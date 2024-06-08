<?php

namespace App\Filament\Resources\WarriorResource\Pages;

use App\Filament\Resources\WarriorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWarrior extends CreateRecord
{
    protected static string $resource = WarriorResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
