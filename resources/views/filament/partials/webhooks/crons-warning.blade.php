<div
    x-data="{ open: true }"
    x-show="open"
    class="alert-info relative flex justify-between items-start gap-4"
>
    <div class="flex gap-3 pr-4">
        <x-heroicon-o-information-circle class="icon mt-1.5" /> <!-- vertical align -->
        <div class="space-y-2">
            <p class="font-semibold">
                The payment system requires cronjobs to run correctly.
            </p>

            <p class="text-sm">
                Set this up using the following command:
            </p>

            <ul class="list-disc list-inside text-sm">
                <li>
                    <code>* * * * * cd {{ base_path() }} && php artisan schedule:run >> /dev/null 2>&1</code>
                </li>
            </ul>

            <p class="text-sm">
                See the
                <a href="https://docs.qdev.tech/justfans/documentation.html#crons"
                   class="underline text-inherit hover:opacity-80"
                   target="_blank"
                >cron setup guide</a>.
            </p>
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
