<x-filament::widget>
    <x-filament::card>
        <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white pb-6">{{ __('admin.widgets.product_info.title') }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Website Link --}}
            <div class="mb-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <a href="https://codecanyon.net/item/justfans-premium-content-creators-saas-platform/35154898" target="_blank" class="flex items-center gap-x-2 hover:text-primary-600 dark:hover:text-primary-500 transition">
                        <div class="flex items-center justify-center w-14 h-14 bg-gray-100 dark:bg-gray-700 rounded-lg p-2">
                            <x-heroicon-o-globe-alt class="w-8 h-8 text-primary-600 dark:text-primary-500" />
                        </div>
                        <div>
                            <div class="text-base font-semibold text-gray-900 dark:text-white">{{ __('admin.widgets.product_info.website.title') }}</div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 m-0">{{ __('admin.widgets.product_info.website.description') }}</p>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Documentation Link --}}
            <div class="mb-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <a href="https://docs.qdev.tech/justfans/" target="_blank" class="flex items-center gap-x-2 hover:text-primary-600 dark:hover:text-primary-500 transition">
                        <div class="flex items-center justify-center w-14 h-14 bg-gray-100 dark:bg-gray-700 rounded-lg p-2">
                            <x-heroicon-o-book-open class="w-8 h-8 text-primary-600 dark:text-primary-500" />
                        </div>
                        <div>
                            <div class="text-base font-semibold text-gray-900 dark:text-white">{{ __('admin.widgets.product_info.documentation.title') }}</div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 m-0">{{ __('admin.widgets.product_info.documentation.description') }}</p>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Changelog Link --}}
            <div class="mb-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <a href="https://changelogs.qdev.tech/products/fans" target="_blank" class="flex items-center gap-x-2 hover:text-primary-600 dark:hover:text-primary-500 transition">
                        <div class="flex items-center justify-center w-14 h-14 bg-gray-100 dark:bg-gray-700 rounded-lg p-2">
                            <x-heroicon-o-document-text class="w-8 h-8 text-primary-600 dark:text-primary-500" />
                        </div>
                        <div>
                            <div class="text-base font-semibold text-gray-900 dark:text-white">{{ __('admin.widgets.product_info.changelog.title') }}</div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 m-0">{{ __('admin.widgets.product_info.changelog.description') }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
