<?php

namespace Tests\Feature;

use App\Enums\ExpenseCategory;
use App\Models\Expense;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExpenseManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_driver_can_create_and_download_a_private_expense_receipt(): void
    {
        Storage::fake('local');
        $driver = User::factory()->create();
        $otherDriver = User::factory()->create();
        $trip = Trip::factory()->for($driver)->create();

        $this->actingAs($driver)
            ->post(route('expenses.store'), [
                'category' => ExpenseCategory::Fuel->value,
                'amount' => 150000,
                'expense_date' => '2026-06-15',
                'description' => 'Isi bahan bakar sebelum berangkat',
                'trip_id' => $trip->id,
                'user_id' => $otherDriver->id,
                'receipt_path' => 'receipts/forged.png',
                'receipt' => $this->receiptImage(),
            ])
            ->assertRedirect();

        $expense = Expense::query()->sole();

        $this->assertSame($driver->id, $expense->user_id);
        $this->assertNotSame('receipts/forged.png', $expense->receipt_path);
        $this->assertSame($trip->id, $expense->trip_id);
        $this->assertSame(ExpenseCategory::Fuel, $expense->category);
        $this->assertSame(150000, $expense->amount);
        $this->assertDatabaseHas('expenses', [
            'id' => $expense->id,
            'description' => 'Isi bahan bakar sebelum berangkat',
            'receipt_path' => $expense->receipt_path,
        ]);
        Storage::disk('local')->assertExists($expense->receipt_path);

        $this->get(route('expenses.receipt', $expense))
            ->assertOk()
            ->assertDownload();
    }

    public function test_driver_can_edit_and_remove_their_expense_and_replace_its_receipt(): void
    {
        Storage::fake('local');
        $driver = User::factory()->create();
        $expense = Expense::factory()->for($driver)->create([
            'category' => ExpenseCategory::Toll,
            'receipt_path' => 'receipts/old.png',
        ]);
        $otherDriver = User::factory()->create();
        $otherTrip = Trip::factory()->for($otherDriver)->create();
        Storage::disk('local')->put($expense->receipt_path, 'old receipt');

        $this->actingAs($driver)
            ->get(route('expenses.edit', $expense))
            ->assertOk()
            ->assertSeeText('Ubah pengeluaran');

        $this->from(route('expenses.edit', $expense))
            ->put(route('expenses.update', $expense), [
                'category' => ExpenseCategory::Parking->value,
                'amount' => 25000,
                'expense_date' => '2026-06-16',
                'trip_id' => $otherTrip->id,
            ])
            ->assertRedirect(route('expenses.edit', $expense))
            ->assertSessionHasErrors([
                'trip_id' => 'Pilih perjalanan milik Anda sendiri.',
            ]);

        $this->assertSame(ExpenseCategory::Toll, $expense->refresh()->category);

        $this->put(route('expenses.update', $expense), [
            'category' => ExpenseCategory::Parking->value,
            'amount' => 25000,
            'expense_date' => '2026-06-16',
            'description' => 'Parkir perjalanan',
            'trip_id' => '',
            'receipt' => $this->receiptImage(),
        ])
            ->assertRedirect(route('expenses.show', $expense))
            ->assertSessionHas('status', 'Pengeluaran berhasil diperbarui.');

        $expense->refresh();
        $this->assertSame(ExpenseCategory::Parking, $expense->category);
        $this->assertSame(25000, $expense->amount);
        $this->assertNull($expense->trip_id);
        $this->assertNotSame('receipts/old.png', $expense->receipt_path);
        Storage::disk('local')->assertMissing('receipts/old.png');
        Storage::disk('local')->assertExists($expense->receipt_path);

        $this->delete(route('expenses.destroy', $expense))
            ->assertRedirect(route('expenses.index'))
            ->assertSessionHas('status', 'Pengeluaran berhasil dihapus.');

        $this->assertDatabaseMissing('expenses', ['id' => $expense->id]);
        Storage::disk('local')->assertMissing($expense->receipt_path);
    }

    public function test_expense_pages_show_only_the_signed_in_drivers_records(): void
    {
        $driver = User::factory()->create();
        $otherDriver = User::factory()->create();
        $expense = Expense::factory()->for($driver)->create([
            'description' => '<script>alert("xss")</script>',
        ]);
        Expense::factory()->for($otherDriver)->create([
            'description' => 'Biaya pribadi sopir lain',
        ]);

        $this->actingAs($driver)
            ->get(route('expenses.index'))
            ->assertOk()
            ->assertSee('&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert("xss")</script>', false)
            ->assertDontSeeText('Biaya pribadi sopir lain')
            ->assertSee(route('expenses.report'));

        $this->get(route('expenses.create'))
            ->assertOk()
            ->assertSeeText('Catat pengeluaran');

        $this->get(route('expenses.show', $expense))
            ->assertOk()
            ->assertSee('&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert("xss")</script>', false);
    }

    public function test_driver_cannot_view_update_delete_or_download_another_drivers_expense(): void
    {
        Storage::fake('local');
        $driver = User::factory()->create();
        $otherDriver = User::factory()->create();
        $expense = Expense::factory()->for($otherDriver)->create([
            'receipt_path' => 'receipts/another-driver.png',
        ]);
        Storage::disk('local')->put($expense->receipt_path, 'private receipt');

        $this->actingAs($driver);
        $this->get(route('expenses.show', $expense))->assertNotFound();
        $this->get(route('expenses.edit', $expense))->assertNotFound();
        $this->get(route('expenses.receipt', $expense))->assertNotFound();
        $this->put(route('expenses.update', $expense), [
            'category' => ExpenseCategory::Other->value,
            'amount' => 1,
            'expense_date' => '2026-06-16',
        ])->assertNotFound();
        $this->delete(route('expenses.destroy', $expense))->assertNotFound();

        $this->assertModelExists($expense);
        $this->assertSame($otherDriver->id, $expense->refresh()->user_id);
        Storage::disk('local')->assertExists($expense->receipt_path);
    }

    public function test_daily_and_monthly_reports_include_only_expenses_in_the_selected_period_and_owner(): void
    {
        $driver = User::factory()->create();
        $otherDriver = User::factory()->create();
        Expense::factory()->for($driver)->create([
            'category' => ExpenseCategory::Fuel,
            'amount' => 100000,
            'expense_date' => '2026-06-15',
        ]);
        Expense::factory()->for($driver)->create([
            'category' => ExpenseCategory::Toll,
            'amount' => 50000,
            'expense_date' => '2026-06-15',
        ]);
        Expense::factory()->for($driver)->create([
            'amount' => 75000,
            'expense_date' => '2026-07-01',
        ]);
        Expense::factory()->for($otherDriver)->create([
            'amount' => 999999,
            'expense_date' => '2026-06-15',
        ]);

        $this->assertDatabaseCount('expenses', 4);

        $this->actingAs($driver)
            ->get(route('expenses.report', ['periode' => 'bulanan', 'tanggal' => '2026-06-15']))
            ->assertOk()
            ->assertSeeText('Rp150.000')
            ->assertSeeText('Bahan bakar')
            ->assertSeeText('Rp100.000')
            ->assertSeeText('Tol')
            ->assertSeeText('Rp50.000')
            ->assertSeeText('2 catatan')
            ->assertDontSeeText('Rp999.999');

        $this->get(route('expenses.report', ['periode' => 'harian', 'tanggal' => '2026-06-15']))
            ->assertOk()
            ->assertSeeText('Rp150.000')
            ->assertSeeText('2 catatan');
    }

    public function test_report_rejects_unsupported_period_and_invalid_date_filters(): void
    {
        $driver = User::factory()->create();

        $this->actingAs($driver)
            ->from(route('expenses.report'))
            ->get(route('expenses.report', ['periode' => 'tahunan', 'tanggal' => 'not-a-date']))
            ->assertRedirect(route('expenses.report'))
            ->assertSessionHasErrors([
                'periode' => 'Pilih periode rekap harian atau bulanan.',
                'tanggal' => 'Masukkan tanggal rekap yang valid.',
            ]);
    }

    public function test_expense_creation_rejects_missing_details_and_another_drivers_trip(): void
    {
        $driver = User::factory()->create();
        $otherDriver = User::factory()->create();
        $otherTrip = Trip::factory()->for($otherDriver)->create();

        $this->actingAs($driver)
            ->from(route('expenses.create'))
            ->post(route('expenses.store'), [
                'category' => 'unknown',
                'amount' => 0,
                'expense_date' => 'yesterday',
                'trip_id' => $otherTrip->id,
            ])
            ->assertRedirect(route('expenses.create'))
            ->assertSessionHasErrors([
                'category' => 'Pilih kategori pengeluaran yang tersedia.',
                'amount' => 'Nominal pengeluaran minimal Rp1.',
                'expense_date' => 'Masukkan tanggal pengeluaran yang valid.',
                'trip_id' => 'Pilih perjalanan milik Anda sendiri.',
            ]);

        $this->assertDatabaseCount('expenses', 0);

        $this->from(route('expenses.create'))
            ->post(route('expenses.store'), [
                'category' => ExpenseCategory::Other->value,
                'amount' => 'seratus',
                'expense_date' => '2026-06-15',
            ])
            ->assertRedirect(route('expenses.create'))
            ->assertSessionHasErrors([
                'amount' => 'Nominal pengeluaran harus berupa angka bulat.',
            ]);

        $this->assertDatabaseCount('expenses', 0);
    }

    public function test_expense_creation_requires_category_amount_and_date(): void
    {
        $driver = User::factory()->create();

        $this->actingAs($driver)
            ->from(route('expenses.create'))
            ->post(route('expenses.store'), [])
            ->assertRedirect(route('expenses.create'))
            ->assertSessionHasErrors(['category', 'amount', 'expense_date']);

        $this->assertDatabaseCount('expenses', 0);
    }

    public function test_expense_receipt_must_be_an_image_with_a_maximum_size_of_two_megabytes(): void
    {
        $driver = User::factory()->create();

        $this->actingAs($driver)
            ->from(route('expenses.create'))
            ->post(route('expenses.store'), [
                'category' => ExpenseCategory::Other->value,
                'amount' => 10000,
                'expense_date' => '2026-06-15',
                'receipt' => UploadedFile::fake()->create('nota.txt', 10, 'text/plain'),
            ])
            ->assertRedirect(route('expenses.create'))
            ->assertSessionHasErrors([
                'receipt' => 'Bukti pengeluaran harus berupa gambar.',
            ]);

        $this->from(route('expenses.create'))
            ->post(route('expenses.store'), [
                'category' => ExpenseCategory::Other->value,
                'amount' => 10000,
                'expense_date' => '2026-06-15',
                'receipt' => UploadedFile::fake()->createWithContent(
                    'nota.gif',
                    base64_decode('R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='),
                ),
            ])
            ->assertRedirect(route('expenses.create'))
            ->assertSessionHasErrors([
                'receipt' => 'Bukti pengeluaran harus berformat JPG, PNG, atau WebP.',
            ]);

        $oversizedImage = $this->receiptImage(
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/r9sAAAAASUVORK5CYII=').str_repeat('x', 2049 * 1024),
        );

        $this->from(route('expenses.create'))
            ->post(route('expenses.store'), [
                'category' => ExpenseCategory::Other->value,
                'amount' => 10000,
                'expense_date' => '2026-06-15',
                'receipt' => $oversizedImage,
            ])
            ->assertRedirect(route('expenses.create'))
            ->assertSessionHasErrors([
                'receipt' => 'Ukuran bukti pengeluaran maksimal 2 MB.',
            ]);

        $this->assertDatabaseCount('expenses', 0);
    }

    public function test_guest_is_redirected_to_login_from_expense_routes(): void
    {
        $expense = Expense::factory()->create();

        $this->get(route('expenses.index'))->assertRedirect(route('login'));
        $this->get(route('expenses.create'))->assertRedirect(route('login'));
        $this->get(route('expenses.show', $expense))->assertRedirect(route('login'));
        $this->get(route('expenses.report'))->assertRedirect(route('login'));
        $this->get(route('expenses.receipt', $expense))->assertRedirect(route('login'));
    }

    private function receiptImage(?string $content = null): UploadedFile
    {
        $content ??= base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/r9sAAAAASUVORK5CYII=');

        return UploadedFile::fake()->createWithContent('nota.png', $content);
    }
}
