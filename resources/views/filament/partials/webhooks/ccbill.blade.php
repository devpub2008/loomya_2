<div
    x-data="{ open: true }"
    x-show="open"
    class="alert-info relative flex justify-between items-start gap-4"
>
    <div class="flex gap-3 pr-4">
        <x-heroicon-o-information-circle class="icon mt-1.5" />

        <div class="space-y-2">
            <p class="font-semibold">
                CCBill requires these URLs:
            </p>

            <ul class="list-disc list-inside text-sm">
                <li>
                    Webhook: <code>{{ route('ccBill.payment.update') }}</code>
                </li>
                <li>
                    Approval/Denial: <code>{{ route('payment.checkCCBillPaymentStatus') }}</code>
                </li>
            </ul>

            <p class="text-sm">
                Learn more in the
                <a href="https://docs.qdev.tech/justfans/documentation.html#ccbill"
                   class="underline text-inherit hover:opacity-80"
                   target="_blank"
                >CCBill integration guide</a>.
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
