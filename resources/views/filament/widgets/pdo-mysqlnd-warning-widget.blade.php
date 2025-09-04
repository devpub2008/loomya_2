<x-filament::widget>
{{--    <link rel="stylesheet" href="{{asset('css/admin.css')}}">--}}

    <div class="rounded-lg alert-warning border border-yellow-300 dark:border-yellow-700 p-4">
        <div class="flex items-start gap-3">
            <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-yellow-600" />
            <div>
                <p class="font-semibold text-yellow-800 dark:text-yellow-300">
                    {{ __('Warning!') }}
                </p>
                <p class="text-sm text-yellow-700 dark:text-yellow-400 mt-1">
                    {{ __("Your PHP's pdo_mysql extension is not using the mysqlnd driver. This might cause UI issues.") }}
                </p>
                <ul class="mt-2 list-disc list-inside text-sm text-yellow-700 dark:text-yellow-300">
                    <li>{{ __("Mysqlnd loaded:") }} <strong>{{ $hasMysqlnd ? 'True' : 'False' }}</strong></li>
                    <li>{{ __("Mysqlnd for PDO:") }} <strong>{{ $pdoMysqlnd ? 'True' : 'False' }}</strong></li>
                </ul>
            </div>
        </div>
    </div>
</x-filament::widget>
