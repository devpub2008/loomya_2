<div
    x-data="{ open: true }"
    x-show="open"
    class="alert-info relative flex justify-between items-start gap-4"
>
    <div class="flex gap-3 pr-4">
        <x-heroicon-o-information-circle class="icon mt-1.5" />
        <div class="space-y-2">
            <p class="font-semibold">
                Few general notes about generating themes:
            </p>

            <ul class="list-disc list-inside text-sm space-y-1">
                <li>The themes are generated on a remote server. Timings may vary but it might take between 20–40s for a run.</li>
                <li>Regular license holders can generate 5 themes per day.</li>
                <li>If <code>zip</code> extension is available on the server, the theme will be updated automatically.</li>
                <li>If the extension is not available, you will need to upload the archive you'll be getting into: <code>public/css/theme</code>.</li>
                <li>When updating your site, remember to back up your <code>public/css/theme</code> folder and restore it after the update.</li>
            </ul>
        </div>
    </div>

    <button
        type="button"
        @click="open = false"
        class="text-blue-500 hover:text-blue-700 dark:text-blue-300 text-lg leading-none"
        aria-label="Dismiss"
    >
        &times;
    </button>
</div>
