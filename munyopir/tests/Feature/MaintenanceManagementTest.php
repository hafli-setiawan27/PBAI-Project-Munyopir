<?php

namespace Tests\Feature;

use App\Models\MaintenanceRule;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaintenanceManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_driver_can_manage_maintenance_reminders_and_update_odometer(): void
    {
        $driver = User::factory()->create();
        $vehicle = Vehicle::factory()->for($driver)->create(['current_odometer' => 50000]);

        $this->actingAs($driver)
            ->get(route('maintenance.index'))
            ->assertOk()
            ->assertSeeText('Jadwal perawatan')
            ->assertSee('value="50000"', false);

        $this->get(route('maintenance.create'))->assertOk();
        $this->post(route('maintenance.store'), [
            'name' => 'Ganti oli',
            'interval_km' => 5000,
            'last_service_odometer' => 48000,
        ])->assertRedirect(route('maintenance.index'));

        $rule = MaintenanceRule::query()->sole();
        $this->assertSame($vehicle->id, $rule->vehicle_id);
        $this->assertSame(53000, $rule->dueOdometer());
        $this->get(route('maintenance.edit', $rule))->assertOk()->assertSee('value="Ganti oli"', false);

        $this->put(route('maintenance.update', $rule), [
            'name' => 'Ganti oli mesin',
            'interval_km' => 6000,
            'last_service_odometer' => 50000,
        ])->assertRedirect(route('maintenance.index'));
        $this->assertSame('Ganti oli mesin', $rule->refresh()->name);

        $this->patch(route('vehicles.odometer.update'), ['current_odometer' => 52000])
            ->assertRedirect(route('maintenance.index'));
        $this->assertSame(52000, $vehicle->refresh()->current_odometer);

        $this->delete(route('maintenance.destroy', $rule))->assertRedirect(route('maintenance.index'));
        $this->assertDatabaseMissing('maintenance_rules', ['id' => $rule->id]);
    }

    public function test_driver_cannot_access_another_vehicles_maintenance_rule_or_lower_odometer(): void
    {
        $driver = User::factory()->create();
        Vehicle::factory()->for($driver)->create(['current_odometer' => 50000]);
        $otherDriver = User::factory()->create();
        $rule = MaintenanceRule::factory()->for(Vehicle::factory()->for($otherDriver))->create();

        $this->actingAs($driver)
            ->get(route('maintenance.edit', $rule))
            ->assertForbidden();

        $this->put(route('maintenance.update', $rule), [
            'name' => 'Ubah milik orang lain',
            'expires_at' => '2027-01-01',
        ])->assertForbidden();

        $this->delete(route('maintenance.destroy', $rule))->assertForbidden();

        $this->from(route('maintenance.index'))
            ->patch(route('vehicles.odometer.update'), ['current_odometer' => 49999])
            ->assertRedirect(route('maintenance.index'))
            ->assertSessionHasErrors('current_odometer');

        $this->assertSame(50000, $driver->vehicle->current_odometer);
    }

    public function test_maintenance_rule_requires_a_reminder_basis_and_corresponding_last_service_value(): void
    {
        $driver = User::factory()->create();
        Vehicle::factory()->for($driver)->create();

        $this->actingAs($driver)
            ->from(route('maintenance.create'))
            ->post(route('maintenance.store'), ['name' => 'Ganti oli', 'interval_km' => 5000])
            ->assertRedirect(route('maintenance.create'))
            ->assertSessionHasErrors(['last_service_odometer']);

        $this->from(route('maintenance.create'))
            ->post(route('maintenance.store'), ['name' => 'Catatan kosong'])
            ->assertRedirect(route('maintenance.create'))
            ->assertSessionHasErrors(['interval_km']);

        $this->assertDatabaseCount('maintenance_rules', 0);
    }
}
