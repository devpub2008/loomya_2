@php
    $licensePath = storage_path('app/installed');
    $license = null;

    if (file_exists($licensePath)) {
        $contents = file_get_contents($licensePath);
        $json = json_decode($contents, true);

        if (json_last_error() === JSON_ERROR_NONE && isset($json['data']) && is_array($json['data'])) {
            $license = $json['data'];
            $license['code'] = $json['code'] ?? null;
        }
    }
@endphp

@if ($license)
    <div class="alert-info relative flex justify-between items-start gap-4 mb-4">
        <div class="flex gap-3 pr-4">
            <x-heroicon-o-check-circle class="icon mt-1.5 text-green-600 dark:text-green-300" />
            <div class="space-y-2">
                <p class="font-semibold">
                    License Details
                </p>

                <ul class="list-disc list-inside text-sm space-y-1">
                    <li><strong>Item:</strong> {{ $license['item'] ?? '—' }}</li>
                    <li><strong>License:</strong> {{ $license['license'] ?? '—' }}</li>
                    <li><strong>Username:</strong> {{ $license['buyer'] ?? '—' }}</li>
                    <li>
                        <strong>Support:</strong>
                        @if (($license['supported_now'] ?? 'No') === 'Yes')
                            Active until {{ \Carbon\Carbon::parse($license['supported_unil'])->toFormattedDateString() }}
                        @else
                            <span class="text-red-600 dark:text-red-400 font-semibold">Expired</span>
                            —
                            <a href="https://codecanyon.net/downloads" target="_blank" class="underline text-inherit hover:opacity-80">
                                Renew support
                            </a>
                        @endif
                    </li>
                    <li><strong>License Code:</strong> <code>{{ $license['code'] ?? '—' }}</code></li>
                </ul>
            </div>
        </div>
    </div>
@else
    <div class="alert-warning relative flex justify-between items-start gap-4 mb-4">
        <div class="flex gap-3 pr-4">
            <x-heroicon-o-exclamation-triangle class="icon mt-1.5" />
            <div class="space-y-1">
                <p class="font-semibold">
                    No valid license found.
                </p>
                <p class="text-sm">
                    Please enter your product license key to activate your installation. You can find it in your
                    <a href="https://codecanyon.net/downloads" class="underline text-inherit hover:opacity-80" target="_blank">Codecanyon Downloads</a>.
                </p>
            </div>
        </div>
    </div>
@endif
