<div
    x-data="{ open: true }"
    x-show="open"
    class="alert-info relative flex justify-between items-start gap-4"
>
    <div class="flex gap-3 pr-4">
        <x-heroicon-o-information-circle class="icon mt-1.5" />
        <div class="space-y-2">
            <p class="font-semibold">
                Stripe requires a <em>Webhook URL</em>.
            </p>

            <p class="text-sm">
                Use the following endpoint in your Stripe dashboard:
            </p>

            <ul class="list-disc list-inside text-sm">
                <li>
                    <code>{{ route('stripe.payment.update') }}</code>
                </li>
            </ul>

            {{-- Optional docs link --}}
            <p class="text-sm">
                Learn more in the
                <a href="https://docs.qdev.tech/justfans/documentation.html#stripe"
                   class="underline text-inherit hover:opacity-80"
                   target="_blank"
                >Stripe integration guide</a>.
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
