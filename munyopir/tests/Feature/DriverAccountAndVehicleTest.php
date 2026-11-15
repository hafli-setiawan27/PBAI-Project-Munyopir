<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DriverAccountAndVehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_driver_can_register_login_and_logout(): void
    {
        $registrationResponse = $this->post(route('register.store'), [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.test',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ]);

        $registrationResponse->assertRedirect(route('vehicles.create'));
        $this->assertAuthenticated();

        $user = User::where('email', 'budi@example.test')->firstOrFail();
        $this->assertTrue(Hash::check('rahasia123', $user->password));

        $this->post(route('logout'))->assertRedirect(route('login'));
        $this->assertGuest();

        $this->post(route('login.store'), [
            'email' => 'budi@example.test',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();

        $this->post(route('login.store'), [
            'email' => 'budi@example.test',
            'password' => 'rahasia123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_guest_is_redirected_to_login_for_private_pages(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
        $this->get(route('vehicles.show'))->assertRedirect(route('login'));
        $this->get(route('vehicles.create'))->assertRedirect(route('login'));
        $this->get(route('settings'))->assertRedirect(route('login'));
        $this->get(route('about-developer'))->assertRedirect(route('login'));
    }

    public function test_settings_page_shows_logout_with_confirmation(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('settings'));

        $response->assertOk()
            ->assertSeeText('Pengaturan')
            ->assertSeeText($user->name)
            ->assertSee('aria-label="Menu lainnya"', false)
            ->assertSee('href="'.route('settings').'"', false)
            ->assertSee('action="'.route('logout').'"', false)
            ->assertSee('onsubmit="return confirm(\'Apakah kamu yakin ingin keluar ?\')"', false);
    }

    public function test_developer_information_is_available_from_overflow_menu(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('about-developer'));

        $response->assertOk()
            ->assertSeeText('Tentang Munyopir')
            ->assertSeeText('Contoh tampilan demo Munyopir')
            ->assertSeeText('Hafli Setiawan')
            ->assertSeeText('Mahasiswa / Pengembang Munyopir')
            ->assertSee('href="'.route('about-developer').'"', false)
            ->assertSee('href="https://github.com/hafli-setiawan27"', false);
    }

    public function test_landing_page_keeps_developer_information(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSeeText('Hafli Setiawan')
            ->assertSeeText('Catatan pengeluaran')
            ->assertDontSeeText('Arsip bukti pengeluaran')
            ->assertSee('id="tentang"', false);
    }

    public function test_registration_rejects_invalid_email_and_unconfirmed_password(): void
    {
        $response = $this->from(route('register'))->post(route('register.store'), [
            'name' => 'Budi Santoso',
            'email' => 'not-an-email',
            'password' => 'rahasia123',
            'password_confirmation' => 'different',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors([
            'email' => 'Masukkan alamat email yang valid.',
            'password' => 'Konfirmasi kata sandi tidak cocok.',
        ]);
        $this->assertDatabaseCount('users', 0);
    }

    public function test_driver_can_create_and_update_their_vehicle(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertRedirect(route('vehicles.create'));

        $this->from(route('vehicles.create'))
            ->post(route('vehicles.store'), [
                'name' => 'Toyota Avanza',
                'plate_number' => 'B 1234 XYZ',
                'current_odometer' => -1,
            ])
            ->assertRedirect(route('vehicles.create'))
            ->assertSessionHasErrors([
                'current_odometer' => 'Odometer tidak boleh kurang dari 0.',
            ]);

        $this->assertDatabaseCount('vehicles', 0);

        $this->post(route('vehicles.store'), [
            'name' => 'Toyota Avanza',
            'plate_number' => 'B 1234 XYZ',
            'current_odometer' => 54210,
        ])->assertRedirect(route('dashboard'));

        $vehicle = $user->vehicle()->firstOrFail();
        $this->assertModelExists($vehicle);

        $this->put(route('vehicles.update'), [
            'name' => 'Toyota Avanza Veloz',
            'plate_number' => 'B 5678 XYZ',
            'current_odometer' => 54800,
        ])->assertRedirect(route('vehicles.show'));

        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'user_id' => $user->id,
            'name' => 'Toyota Avanza Veloz',
            'plate_number' => 'B 5678 XYZ',
            'current_odometer' => 54800,
        ]);

        $this->from(route('vehicles.edit'))
            ->put(route('vehicles.update'), [
                'name' => 'Toyota Avanza Veloz',
                'plate_number' => 'B 5678 XYZ',
                'current_odometer' => 54799,
            ])
            ->assertRedirect(route('vehicles.edit'))
            ->assertSessionHasErrors('current_odometer');

        $this->assertSame(54800, $vehicle->refresh()->current_odometer);
    }

    public function test_dashboard_displays_vehicle_details_and_profile_link(): void
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->for($user)->create([
            'name' => 'Toyota Avanza',
            'plate_number' => 'B 1234 XYZ',
            'current_odometer' => 54210,
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response
            ->assertOk()
            ->assertSeeText('Informasi kendaraan')
            ->assertSeeText($vehicle->name)
            ->assertSeeText($vehicle->plate_number)
            ->assertSeeText('54.210')
            ->assertDontSeeText('Ruang kerja sopir pribadi')
            ->assertDontSeeText('Halo,')
            ->assertSeeText('Atur jadwal perjalanan')
            ->assertSeeText('Catat biaya operasional')
            ->assertSeeText('Pantau informasi kendaraan')
            ->assertSeeText('Pantau perubahan jadwal')
            ->assertSee('aria-label="Informasi fitur Munyopir"', false)
            ->assertDontSee('data-carousel-next', false)
            ->assertSee('Ilustrasi mobil minivan modern')
            ->assertSeeText('Lihat profil')
            ->assertSee(route('vehicles.show'));

        $this->assertSame(4, substr_count($response->getContent(), 'data-carousel-slide'));
    }

    public function test_vehicle_profile_shows_details_and_an_edit_action(): void
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->for($user)->create([
            'name' => 'Toyota Avanza',
            'plate_number' => 'B 1234 XYZ',
            'current_odometer' => 54210,
        ]);

        $this->actingAs($user)
            ->get(route('vehicles.show'))
            ->assertOk()
            ->assertSeeText('Profil kendaraan')
            ->assertSeeText($vehicle->name)
            ->assertSeeText($vehicle->plate_number)
            ->assertSeeText('54.210')
            ->assertSee('Ilustrasi mobil minivan modern')
            ->assertSeeText('Ubah informasi kendaraan')
            ->assertSee(route('vehicles.edit'));
    }

    public function test_vehicle_profile_redirects_to_creation_when_driver_has_no_vehicle(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('vehicles.show'))
            ->assertRedirect(route('vehicles.create'));
    }

    public function test_vehicle_edit_screen_shows_the_update_form_without_profile_details(): void
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->for($user)->create([
            'name' => 'Toyota Avanza',
            'plate_number' => 'B 1234 XYZ',
            'current_odometer' => 54210,
        ]);

        $this->actingAs($user)
            ->get(route('vehicles.edit'))
            ->assertOk()
            ->assertSeeText('Ubah informasi kendaraan')
            ->assertSee('value="Toyota Avanza"', false)
            ->assertSee('value="B 1234 XYZ"', false)
            ->assertSeeText('Simpan perubahan')
            ->assertDontSeeText('Ringkasan kendaraan');
    }

    public function test_each_driver_can_only_have_one_vehicle_and_updates_their_own(): void
    {
        $driver = User::factory()->create();
        $otherDriver = User::factory()->create();
        $vehicle = Vehicle::factory()->for($driver)->create(['current_odometer' => 20000]);
        $otherVehicle = Vehicle::factory()->for($otherDriver)->create();

        $this->actingAs($driver)
            ->post(route('vehicles.store'), [
                'name' => 'Mobil Kedua',
                'plate_number' => 'B 9999 ABC',
                'current_odometer' => 1000,
            ])
            ->assertRedirect(route('vehicles.show'));

        $this->put(route('vehicles.update'), [
            'name' => 'Mobil Saya',
            'plate_number' => $vehicle->plate_number,
            'current_odometer' => 30000,
        ])->assertRedirect(route('vehicles.show'));

        $this->assertDatabaseCount('vehicles', 2);
        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'user_id' => $driver->id,
            'name' => 'Mobil Saya',
            'current_odometer' => 30000,
        ]);
        $this->assertDatabaseHas('vehicles', [
            'id' => $otherVehicle->id,
            'user_id' => $otherDriver->id,
            'name' => $otherVehicle->name,
            'current_odometer' => $otherVehicle->current_odometer,
        ]);
    }

    public function test_login_attempts_are_limited_per_email_and_ip(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('login.store'), [
                'email' => 'unknown@example.test',
                'password' => 'wrong-password',
            ])->assertRedirect();
        }

        $this->post(route('login.store'), [
            'email' => 'unknown@example.test',
            'password' => 'wrong-password',
        ])->assertTooManyRequests();
    }
}
