<?php

namespace App\Filament\Resources\ClanResource\Pages;

use App\Filament\Resources\ClanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClan extends CreateRecord
{
    protected static string $resource = ClanResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
