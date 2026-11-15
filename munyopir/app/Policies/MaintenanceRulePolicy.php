<?php

namespace App\Policies;

use App\Models\MaintenanceRule;
use App\Models\User;

class MaintenanceRulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->vehicle()->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->vehicle()->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MaintenanceRule $maintenanceRule): bool
    {
        return $maintenanceRule->vehicle()->whereBelongsTo($user)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MaintenanceRule $maintenanceRule): bool
    {
        return $maintenanceRule->vehicle()->whereBelongsTo($user)->exists();
    }
}
