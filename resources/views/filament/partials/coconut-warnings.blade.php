{{-- Local Storage Warning --}}
@if(getSetting('storage.driver') === 'public')
    <div
        x-data="{ open: true }"
        x-show="open"
        class="alert-warning relative flex justify-between items-start gap-4 mb-4"
    >
        <div class="flex gap-3 pr-4">
            <x-heroicon-o-exclamation-triangle class="icon mt-1.5" />
            <div class="space-y-1 text-sm">
                <p class="font-semibold">Warning</p>
                <p>Coconut transcoding can only be used with a remote storage option. Local storage is not supported.</p>
            </div>
        </div>

        <button
            @click="open = false"
            class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-300 text-lg leading-none"
            aria-label="Dismiss"
        >
            &times;
        </button>
    </div>
@endif

{{-- Websockets Not Configured Warning --}}
@if(!getSetting('websockets.pusher_app_id') && !getSetting('websockets.soketi_host_address'))
    <div
        x-data="{ open: true }"
        x-show="open"
        class="alert-warning relative flex justify-between items-start gap-4 mb-4"
    >
        <div class="flex gap-3 pr-4">
            <x-heroicon-o-exclamation-triangle class="icon mt-1.5" />
            <div class="space-y-1 text-sm">
                <p class="font-semibold">Warning</p>
                <p>Coconut transcoding requires Websockets to be enabled. Please configure the Websockets settings.</p>
            </div>
        </div>

        <button
            @click="open = false"
            class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-300 text-lg leading-none"
            aria-label="Dismiss"
        >
            &times;
        </button>
    </div>
@endif

{{-- CloudFront Pre-signed URL Conflict --}}
@if(
    getSetting('storage.driver') === 's3' &&
    getSetting('storage.aws_cdn_enabled') &&
    getSetting('storage.aws_cdn_presigned_urls_enabled')
)
    <div
        x-data="{ open: true }"
        x-show="open"
        class="alert-warning relative flex justify-between items-start gap-4 mb-4"
    >
        <div class="flex gap-3 pr-4">
            <x-heroicon-o-exclamation-triangle class="icon mt-1.5" />
            <div class="space-y-1 text-sm">
                <p class="font-semibold">Warning</p>
                <p>Coconut transcoding cannot be used with CloudFront Pre-Signed URLs. You can still use it with S3 and CloudFront (without pre-signed URLs).</p>
            </div>
        </div>

        <button
            @click="open = false"
            class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-300 text-lg leading-none"
            aria-label="Dismiss"
        >
            &times;
        </button>
    </div>
@endif
