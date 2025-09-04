<?php

namespace App\Filament\Resources\FeaturedUserResource\Pages;

use App\Filament\Resources\FeaturedUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFeaturedUser extends CreateRecord
{
    protected static string $resource = FeaturedUserResource::class;
}
