<?php

namespace App\Filament\Traits;

trait HasShieldPageAccess
{
    public static function canAccess(): bool
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }

        // Generate permission name based on class name, e.g., page_ManageGeneralSettings
        $permission = 'page_'.class_basename(static::class);

        return $user->can($permission);
    }
}
