<?php

namespace App\Filament\Widgets;

use App\Filament\Traits\HasShieldWidgetAccess;
use Filament\Widgets\Widget;

class ProductLinksWidget extends Widget
{
    use HasShieldWidgetAccess;

    protected static ?int $sort = 10;

    protected static string $view = 'filament.widgets.product-info';

    protected int|string|array $columnSpan = 'full'; // Take full width
}
