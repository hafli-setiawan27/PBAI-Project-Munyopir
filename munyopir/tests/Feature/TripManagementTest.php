<?php

namespace Tests\Feature;

use App\Enums\TripStatus;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_driver_can_create_a_trip_and_see_upcoming_trips_on_dashboard(): void
    {
        $this->travelTo(now()->setDate(2026, 11, 14)->setTime(8, 0));
        $driver = User::factory()->create();
        $driver->vehicle()->create([
            'name' => 'Toyota Avanza',
            'plate_number' => 'B 1234 XYZ',
            'current_odometer' => 50000,
        ]);

        $this->actingAs($driver)
            ->post(route('trips.store'), [
                'destination' => 'Bandara Soekarno-Hatta',
                'pickup_location' => 'Jl. Merdeka No. 10',
                'pickup_at' => '2026-11-15T10:30',
            ])
            ->assertRedirect(route('trips.index'))
            ->assertSessionHas('status', 'Jadwal perjalanan berhasil ditambahkan.');

        $this->assertDatabaseHas('trips', [
            'user_id' => $driver->id,
            'destination' => 'Bandara Soekarno-Hatta',
            'pickup_location' => 'Jl. Merdeka No. 10',
            'pickup_at' => '2026-11-15 10:30:00',
            'status' => TripStatus::Scheduled->value,
        ]);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Bandara Soekarno-Hatta')
            ->assertSee('Jl. Merdeka No. 10')
            ->assertSee('Terjadwal');
    }

    public function test_trip_creation_requires_valid_trip_details(): void
    {
        $driver = User::factory()->create();

        $this->actingAs($driver)
            ->from(route('trips.create'))
            ->post(route('trips.store'), [
                'destination' => '',
                'pickup_location' => '',
                'pickup_at' => 'not-a-date',
            ])
            ->assertRedirect(route('trips.create'))
            ->assertSessionHasErrors([
                'destination',
                'pickup_location',
                'pickup_at',
            ]);

        $this->assertDatabaseCount('trips', 0);
    }

    public function test_driver_can_view_their_trip_list_and_trip_forms(): void
    {
        $driver = User::factory()->create();
        $trip = Trip::factory()->for($driver)->create([
            'destination' => 'Stasiun Gambir',
        ]);
        $otherDriver = User::factory()->create();
        Trip::factory()->for($otherDriver)->create([
            'destination' => 'Perjalanan Sopir Lain',
        ]);

        $this->actingAs($driver)
            ->get(route('trips.index'))
            ->assertOk()
            ->assertSee('Stasiun Gambir')
            ->assertDontSee('Perjalanan Sopir Lain');

        $this->get(route('trips.create'))
            ->assertOk()
            ->assertSee('Tujuan perjalanan');

        $this->get(route('trips.edit', $trip))
            ->assertOk()
            ->assertSee('Stasiun Gambir')
            ->assertDontSee('name="status"', false);
    }

    public function test_driver_can_update_trip_details_and_delete_a_trip(): void
    {
        $driver = User::factory()->create();
        $trip = Trip::factory()->for($driver)->create();

        $this->actingAs($driver)
            ->put(route('trips.update', $trip), [
                'destination' => 'Stasiun Gambir',
                'pickup_location' => 'Rumah',
                'pickup_at' => '2026-11-16T08:15',
            ])
            ->assertRedirect(route('trips.index'))
            ->assertSessionHas('status', 'Jadwal perjalanan berhasil diperbarui.');

        $this->patch(route('trips.status', $trip), ['status' => TripStatus::Changed->value])
            ->assertRedirect(route('trips.index'))
            ->assertSessionHas('status', 'Status perjalanan berhasil diperbarui.');

        $this->assertDatabaseHas('trips', [
            'id' => $trip->id,
            'user_id' => $driver->id,
            'destination' => 'Stasiun Gambir',
            'pickup_location' => 'Rumah',
            'pickup_at' => '2026-11-16 08:15:00',
            'status' => TripStatus::Changed->value,
        ]);

        $this->delete(route('trips.destroy', $trip))
            ->assertRedirect(route('trips.index'))
            ->assertSessionHas('status', 'Jadwal perjalanan berhasil dihapus.');

        $this->assertDatabaseMissing('trips', ['id' => $trip->id]);
    }

    public function test_driver_cannot_edit_or_delete_another_drivers_trip(): void
    {
        $driver = User::factory()->create();
        $otherDriver = User::factory()->create();
        $trip = Trip::factory()->for($otherDriver)->create();

        $this->actingAs($driver);

        $this->get(route('trips.edit', $trip))->assertForbidden();
        $this->put(route('trips.update', $trip), [
            'destination' => 'Perubahan tidak sah',
            'pickup_location' => 'Perubahan tidak sah',
            'pickup_at' => '2026-11-16T08:15',
        ])->assertForbidden();
        $this->delete(route('trips.destroy', $trip))->assertForbidden();

        $this->assertDatabaseHas('trips', [
            'id' => $trip->id,
            'user_id' => $otherDriver->id,
            'destination' => $trip->destination,
            'status' => TripStatus::Scheduled->value,
        ]);
    }

    public function test_trip_status_update_rejects_unknown_and_invalid_transitions(): void
    {
        $driver = User::factory()->create();
        $trip = Trip::factory()->for($driver)->create();

        $this->actingAs($driver)
            ->from(route('trips.index'))
            ->patch(route('trips.status', $trip), ['status' => 'unknown'])
            ->assertRedirect(route('trips.index'))
            ->assertSessionHasErrors('status');

        $this->from(route('trips.index'))
            ->patch(route('trips.status', $trip), ['status' => TripStatus::Completed->value])
            ->assertRedirect(route('trips.index'))
            ->assertSessionHasErrors('status', 'Perubahan status perjalanan tidak diizinkan.');

        $this->patch(route('trips.status', $trip), ['status' => TripStatus::Changed->value])->assertRedirect(route('trips.index'));
        $this->patch(route('trips.status', $trip), ['status' => TripStatus::Completed->value])->assertRedirect(route('trips.index'));
        $this->from(route('trips.index'))
            ->patch(route('trips.status', $trip), ['status' => TripStatus::Cancelled->value])
            ->assertRedirect(route('trips.index'))
            ->assertSessionHasErrors('status');

        $this->assertDatabaseHas('trips', [
            'id' => $trip->id,
            'status' => TripStatus::Completed->value,
        ]);
    }

    public function test_dashboard_lists_only_this_drivers_future_active_trips_in_time_order(): void
    {
        $this->travelTo(now()->setDate(2026, 11, 14)->setTime(8, 0));
        $driver = User::factory()->create();
        $driver->vehicle()->create([
            'name' => 'Toyota Avanza',
            'plate_number' => 'B 1234 XYZ',
            'current_odometer' => 50000,
        ]);

        Trip::factory()->for($driver)->create([
            'destination' => 'Tujuan Lebih Jauh',
            'pickup_at' => '2026-11-16 10:00:00',
            'status' => TripStatus::Scheduled,
        ]);
        Trip::factory()->for($driver)->create([
            'destination' => 'Tujuan Terdekat',
            'pickup_at' => '2026-11-15 10:00:00',
            'status' => TripStatus::Changed,
        ]);
        Trip::factory()->for($driver)->create([
            'destination' => 'Perjalanan Selesai',
            'pickup_at' => '2026-11-15 09:00:00',
            'status' => TripStatus::Completed,
        ]);
        Trip::factory()->for($driver)->create([
            'destination' => 'Perjalanan Batal',
            'pickup_at' => '2026-11-15 08:00:00',
            'status' => TripStatus::Cancelled,
        ]);
        Trip::factory()->for($driver)->create([
            'destination' => 'Perjalanan Lampau',
            'pickup_at' => '2026-11-13 08:00:00',
            'status' => TripStatus::Scheduled,
        ]);

        $otherDriver = User::factory()->create();
        Trip::factory()->for($otherDriver)->create([
            'destination' => 'Perjalanan Sopir Lain',
        ]);

        $this->actingAs($driver)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSeeInOrder(['Tujuan Terdekat', 'Tujuan Lebih Jauh'])
            ->assertDontSee('Perjalanan Selesai')
            ->assertDontSee('Perjalanan Batal')
            ->assertDontSee('Perjalanan Lampau')
            ->assertDontSee('Perjalanan Sopir Lain');
    }

    public function test_guest_is_redirected_to_login_from_trip_routes(): void
    {
        $this->get(route('trips.index'))->assertRedirect(route('login'));
        $this->get(route('trips.create'))->assertRedirect(route('login'));
        $this->patch(route('trips.status', Trip::factory()->create()))->assertRedirect(route('login'));
    }
}
