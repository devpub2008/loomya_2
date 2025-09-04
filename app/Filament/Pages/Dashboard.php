<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
//                Section::make(__('Filters'))
//                    ->collapsible()
//                    ->collapsed() // This keeps the section hidden by default
//                    ->schema([
//                        DatePicker::make('startDate')
//                            ->label(__('admin.filters.start_date'))
//                            ->maxDate(fn (Get $get) => $get('endDate') ?: now()),
//                        DatePicker::make('endDate')
//                            ->label(__('admin.filters.end_date'))
//                            ->minDate(fn (Get $get) => $get('startDate') ?: now())
//                            ->maxDate(now()),
//                    ]),
            ]);
    }
}
