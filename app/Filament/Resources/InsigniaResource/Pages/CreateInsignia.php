<?php

namespace App\Filament\Resources\InsigniaResource\Pages;

use App\Filament\Resources\InsigniaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInsignia extends CreateRecord
{
    protected static string $resource = InsigniaResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
