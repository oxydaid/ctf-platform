<?php

namespace App\Filament\Resources\ChallengeResource\Pages;

use App\Filament\Resources\ChallengeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChallenge extends CreateRecord
{
    protected static string $resource = ChallengeResource::class;

    
    protected function getRedirectUrl() : string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Tambahkan ID user yang sedang login ke dalam data
        $data['user_id'] = auth()->id();

        return $data;
    }
}
