<?php

namespace App\Filament\Traits;

trait HasShieldWidgetAccess
{
    public static function canView(): bool
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }

        // Permission pattern: widget_<WidgetClassName>
        $permission = 'widget_'.class_basename(static::class);

        return $user->can($permission);
    }
}
