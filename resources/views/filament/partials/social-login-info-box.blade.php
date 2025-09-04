<div
    x-data="{ open: true }"
    x-show="open"
    class="alert-info relative flex justify-between items-start gap-4"
>
    <div class="flex gap-3 pr-4">
        <x-heroicon-o-information-circle class="icon mt-1.5" />

        <div class="space-y-2">
            <p class="font-semibold">
                Each provider requires a <em>Callback URL</em>.
            </p>

            <p class="text-sm">
                Use the following values when configuring your social login apps:
            </p>

            <ul class="list-disc list-inside text-sm">
                <li><code>{{ route('social.login.callback', ['provider' => 'facebook']) }}</code></li>
                <li><code>{{ route('social.login.callback', ['provider' => 'twitter']) }}</code></li>
                <li><code>{{ route('social.login.callback', ['provider' => 'google']) }}</code></li>
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
