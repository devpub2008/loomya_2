<x-filament::widget>
    @if (!$symlinkFixed)
        <div class="rounded-lg alert-warning border border-yellow-300 dark:border-yellow-700 p-4">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-start gap-3">
                    <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-yellow-600 mt-1" />
                    <div>
                        <p class="font-semibold text-yellow-800 dark:text-yellow-300">
                            {{ __('Warning!') }}
                        </p>
                        <p class="text-sm text-yellow-700 dark:text-yellow-400 mt-1">
                            {{ __('The public/storage symlink is missing. This may cause images or files to be inaccessible.') }}
                        </p>
                    </div>
                </div>

                <div class="self-center">
                    <x-filament::button
                        wire:click="createSymlink"
                        color="warning"
                        size="sm"
                    >
                        {{ __('Fix it') }}
                    </x-filament::button>
                </div>
            </div>
        </div>
    @endif
</x-filament::widget>
