<?php

namespace App\Filament\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasShieldPermissions
{
    public static function resolveRecordUrl(Model $record): string
    {
        return static::canEdit($record)
            ? static::getUrl('edit', ['record' => $record])
            : static::getUrl('view', ['record' => $record]);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can(static::getPermissionName('view_any')) ?? false;
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()?->can(static::getPermissionName('view')) ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can(static::getPermissionName('create')) ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can(static::getPermissionName('update')) ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can(static::getPermissionName('delete')) ?? false;
    }

    public static function canBulkDelete(): bool
    {
        return auth()->user()?->can(static::getPermissionName('delete_any')) ?? false;
    }

    protected static function getPermissionName(string $action): string
    {
        $resourceName = str(static::class)
            ->classBasename()
            ->beforeLast('Resource')
            ->kebab()
            ->replace('-', '::')

            // Optional: fix double colons in weird cases like 'user::verify' if needed
            ->replace('::', '::');

        return "{$action}_{$resourceName}";
    }
}
