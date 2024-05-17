<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;
use Illuminate\Support\Str;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['identifier'] = (string) Str::uuid();

        return $data;
    }
}
