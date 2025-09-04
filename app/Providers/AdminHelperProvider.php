<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class AdminHelperProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        FileUpload::macro('asNullableImageField', function (string $label = null, array $types = [], int $previewHeight = 80) {
            /* @var \Filament\Forms\Components\FileUpload $this */
            return $this
                ->label($label)
                ->directory('assets')
                ->image()
                ->imagePreviewHeight($previewHeight)
                ->acceptedFileTypes($types)
                /*TODO: Review this one*/
                ->maxSize(getSetting('media.max_logo_file_size') ? (int) getSetting('media.max_logo_file_size') * 1024 : 2048)
                ->nullable()
                ->dehydrated()
                ->dehydrateStateUsing(fn ($state) => is_array($state) ? reset($state) : ($state ?: null))
                ->deleteUploadedFileUsing(fn (?string $file) => $file && Storage::exists($file) ? Storage::delete($file) : null);
        });
    }

    /**
     * Checks if user has access to a resources page via navigation.
     * @param string|object $permissionOrResource
     * @param string|null $resource
     * @return array
     */
    public static function resourceNavIfCan(string|object $permissionOrResource, ?string $resource = null): array
    {
        $user = auth()->user();

        if (!$user) {
            return []; // no logged-in user, no navigation items
        }

        // Handle explicit permission
        if (is_string($permissionOrResource) && $resource !== null) {
            return $user->can($permissionOrResource)
                ? $resource::getNavigationItems()
                : [];
        }

        $resourceClass = is_string($permissionOrResource) ? $permissionOrResource : get_class($permissionOrResource);
        $modelClass = $resourceClass::getModel();
        $modelName = Str::of(class_basename($modelClass))
            ->replaceMatches('/([a-z])([A-Z])/', '$1_$2')
            ->lower()
            ->replace('_', '::');

        $guessed = "view_any_{$modelName}";

        if ($user->can($guessed)) {
            return $resourceClass::getNavigationItems();
        }

        $permissions = Permission::pluck('name')->all();
        $match = collect($permissions)
            ->first(fn ($perm) => Str::endsWith($perm, $modelName) && Str::startsWith($perm, 'view_any_'));

        if ($match && $user->can($match)) {
            return $resourceClass::getNavigationItems();
        }

        return [];
    }

    /**
     * Checks if user has access to a settings page via navigation.
     * @param string $label
     * @param string $icon
     * @param string $permission
     * @param string $url
     * @param string $route
     * @return NavigationItem|null
     */
    public static function settingsNavItem(string $label, string $icon, string $permission, string $url, string $route): ?NavigationItem
    {
        $user = Filament::auth()->user();

        if (!$user) {
            return null;
        }

        return $user->can($permission)
            ? NavigationItem::make($label)
                ->icon($icon)
                ->url($url)
                ->isActiveWhen(fn () => request()->routeIs($route))
            : null;
    }
}
