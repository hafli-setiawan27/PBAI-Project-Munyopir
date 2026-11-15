<?php

namespace App\Services;

use App\Models\MaintenanceRule;
use App\Models\Trip;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReminderService
{
    public function sendDueReminders(?CarbonImmutable $now = null): int
    {
        $now ??= CarbonImmutable::now();
        $created = 0;

        MaintenanceRule::query()->with('vehicle.user')->each(function (MaintenanceRule $rule) use ($now, &$created): void {
            $vehicle = $rule->vehicle;
            $user = $vehicle->user;

            if ($rule->interval_km !== null && $rule->last_service_odometer !== null
                && $vehicle->current_odometer >= $rule->last_service_odometer + $rule->interval_km - 500) {
                $created += $this->createNotification($user->notifications(), [
                    'maintenance_rule_id' => $rule->id,
                    'trip_id' => null,
                    'type' => 'maintenance_km',
                    'title' => 'Jadwal perawatan mendekat',
                    'message' => $rule->name.' perlu dijadwalkan pada atau sebelum '.number_format($rule->dueOdometer(), 0, ',', '.').' km.',
                    'reminder_key' => 'maintenance:'.$rule->id.':km:'.$rule->last_service_odometer.':'.$rule->interval_km,
                ]);
            }

            if ($rule->dueDate() !== null) {
                $dueDate = CarbonImmutable::instance($rule->dueDate());
                if ($now->startOfDay()->greaterThanOrEqualTo($dueDate->subDays(14)->startOfDay())) {
                    $created += $this->createNotification($user->notifications(), [
                        'maintenance_rule_id' => $rule->id,
                        'trip_id' => null,
                        'type' => 'maintenance_date',
                        'title' => 'Jadwal perawatan mendekat',
                        'message' => $rule->name.' dijadwalkan pada '.$dueDate->translatedFormat('d F Y').'.',
                        'reminder_key' => 'maintenance:'.$rule->id.':date:'.$rule->last_service_date->toDateString().':'.$rule->interval_days,
                    ]);
                }
            }

            if ($rule->expires_at !== null) {
                $expiresAt = CarbonImmutable::instance($rule->expires_at);
                $daysRemaining = (int) $now->startOfDay()->diffInDays($expiresAt->startOfDay(), false);

                if (in_array($daysRemaining, [30, 7, 1], true)) {
                    $created += $this->createNotification($user->notifications(), [
                        'maintenance_rule_id' => $rule->id,
                        'trip_id' => null,
                        'type' => 'document_expiry',
                        'title' => 'Masa berlaku dokumen akan habis',
                        'message' => $rule->name.' berlaku sampai '.$expiresAt->translatedFormat('d F Y').'.',
                        'reminder_key' => 'document:'.$rule->id.':'.$expiresAt->toDateString().':'.$daysRemaining,
                    ]);
                }
            }
        });

        $minute = $now->startOfMinute();
        $pickupWindowEnd = $minute->addMinute();
        Trip::query()
            ->with('user')
            ->whereIn('status', ['scheduled', 'changed'])
            ->whereBetween('pickup_at', [$minute->addMinutes(15), $minute->addMinutes(61)])
            ->each(function (Trip $trip) use ($minute, $pickupWindowEnd, &$created): void {
                foreach ([60, 15] as $minutesBeforePickup) {
                    $reminderMinute = CarbonImmutable::instance($trip->pickup_at)
                        ->subMinutes($minutesBeforePickup)
                        ->startOfMinute();
                    if ($reminderMinute->lt($minute) || $reminderMinute->gte($pickupWindowEnd)) {
                        continue;
                    }

                    $created += $this->createNotification($trip->user->notifications(), [
                        'maintenance_rule_id' => null,
                        'trip_id' => $trip->id,
                        'type' => 'trip_pickup',
                        'title' => 'Waktu penjemputan semakin dekat',
                        'message' => 'Persiapkan perjalanan menuju '.$trip->pickup_location.' untuk tujuan '.$trip->destination.'.',
                        'reminder_key' => 'trip:'.$trip->id.':pickup:'.$minutesBeforePickup.':'.$trip->pickup_at->timestamp,
                    ]);
                }
            });

        return $created;
    }

    /** @param array<string, int|null|string> $attributes */
    private function createNotification(HasMany $notifications, array $attributes): int
    {
        $notification = $notifications->firstOrCreate(
            ['reminder_key' => $attributes['reminder_key']],
            $attributes,
        );

        return $notification->wasRecentlyCreated ? 1 : 0;
    }
}
