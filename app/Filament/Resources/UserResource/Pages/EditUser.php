<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Clear the file upload state to avoid stale "loading" preview
//        $this->form->fill([
//            'avatar' => null,
//        ]);
//        $this->form['avatar'] = null;
//        $this->form->getComponent('avatar')?->state(null);
//        $this->form->getComponent('cover')?->state(null);

    }

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
