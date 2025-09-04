<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if (isset($data['avatar_upload'])) {
            $data['avatar'] = $data['avatar_upload'];
        }
        unset($data['avatar_upload']);

        return $data;
    }

    protected function handleRecordUpdate(Model $user, array $data): Model
    {
        $user->update($data);
        if (!empty($data['role'])) {
            $user->syncRoles([$data['role']]);
        }
        return $user;
    }
}
