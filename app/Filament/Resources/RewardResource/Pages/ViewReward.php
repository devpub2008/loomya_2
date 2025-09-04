<?php

namespace App\Filament\Resources\RewardResource\Pages;

use App\Filament\Resources\RewardResource;
use App\Model\ReferralCodeUsage;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewReward extends ViewRecord
{
    protected static string $resource = RewardResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var ReferralCodeUsage $record */
        $record = $this->getRecord();

        return $record->id;
    }

    protected function getActions(): array
    {
        return [];
    }
}
