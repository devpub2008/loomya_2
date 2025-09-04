<?php

namespace App\Filament\Traits;

trait HasShieldChildResource
{
    protected static function resolvePermissionResource(): string
    {
        return static::$resource ?? static::class;
    }

    protected static function getPermissionName(string $action): string
    {
        $resourceName = str(static::resolvePermissionResource())
            ->classBasename()
            ->beforeLast('Resource')
            ->kebab()
            ->replace('-', '::');

        return "{$action}_{$resourceName}";
    }

    public static function hasPermissionTo(string $action): bool
    {
        return auth()->check()
            && auth()->user()->can(static::getPermissionName($action));
    }
}
