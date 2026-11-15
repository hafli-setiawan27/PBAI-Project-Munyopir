<?php

namespace Tests\Feature;

use App\Enums\TripStatus;
use App\Models\MaintenanceRule;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReminderAndNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_command_creates_due_service_document_and_pickup_reminders_without_duplicates(): void
    {
        $now = now()->setDate(2026, 11, 15)->setTime(8, 0, 0);
        $this->travelTo($now);

        $driver = User::factory()->create();
        $vehicle = Vehicle::factory()->for($driver)->create(['current_odometer' => 54500]);
        MaintenanceRule::factory()->for($vehicle)->create([
            'name' => 'Ganti oli',
            'interval_km' => 5000,
            'last_service_odometer' => 50000,
        ]);
        MaintenanceRule::factory()->for($vehicle)->create([
            'name' => 'STNK',
            'interval_km' => null,
            'last_service_odometer' => null,
            'expires_at' => '2026-12-15',
        ]);
        MaintenanceRule::factory()->for($vehicle)->create([
            'name' => 'KIR',
            'interval_km' => null,
            'last_service_odometer' => null,
            'expires_at' => '2026-11-22',
        ]);
        MaintenanceRule::factory()->for($vehicle)->create([
            'name' => 'SIM khusus',
            'interval_km' => null,
            'last_service_odometer' => null,
            'expires_at' => '2026-11-16',
        ]);
        MaintenanceRule::factory()->for($vehicle)->create([
            'name' => 'Servis berkala',
            'interval_km' => null,
            'interval_days' => 30,
            'last_service_odometer' => null,
            'last_service_date' => '2026-10-30',
        ]);
        Trip::factory()->for($driver)->create([
            'destination' => 'Bandung',
            'pickup_location' => 'Rumah',
            'pickup_at' => '2026-11-15 09:00:00',
            'status' => TripStatus::Scheduled,
        ]);
        Trip::factory()->for($driver)->create([
            'destination' => 'Stasiun',
            'pickup_location' => 'Kantor',
            'pickup_at' => '2026-11-15 08:15:00',
            'status' => TripStatus::Changed,
        ]);

        $this->artisan('app:cek-pengingat')->assertSuccessful();
        $this->assertDatabaseCount('notifications', 7);
        $this->assertDatabaseHas('notifications', ['type' => 'maintenance_km', 'user_id' => $driver->id]);
        $this->assertDatabaseHas('notifications', ['type' => 'maintenance_date', 'user_id' => $driver->id]);
        $this->assertDatabaseHas('notifications', ['type' => 'document_expiry', 'user_id' => $driver->id]);
        $this->assertDatabaseCount('notifications', 7);

        $this->artisan('app:cek-pengingat')->assertSuccessful();
        $this->assertDatabaseCount('notifications', 7);
    }

    public function test_driver_can_read_their_notifications_but_not_another_drivers_notifications(): void
    {
        $driver = User::factory()->create();
        $otherDriver = User::factory()->create();
        $notification = $driver->notifications()->create([
            'type' => 'trip_pickup',
            'title' => 'Waktu penjemputan semakin dekat',
            'message' => 'Persiapkan perjalanan.',
            'reminder_key' => 'driver:'.$driver->id.':pickup',
        ]);
        $otherNotification = $otherDriver->notifications()->create([
            'type' => 'trip_pickup',
            'title' => 'Rahasia sopir lain',
            'message' => 'Jangan tampilkan.',
            'reminder_key' => 'driver:'.$otherDriver->id.':pickup',
        ]);

        $this->actingAs($driver)
            ->get(route('notifications.index'))
            ->assertOk()
            ->assertSeeText($notification->title)
            ->assertDontSeeText($otherNotification->title);

        $this->patch(route('notifications.read', $notification))
            ->assertRedirect(route('notifications.index'));
        $this->assertNotNull($notification->refresh()->read_at);

        $this->patch(route('notifications.read', $otherNotification))->assertNotFound();
        $this->assertNull($otherNotification->refresh()->read_at);
    }
}
