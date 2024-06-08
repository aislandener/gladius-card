<?php

namespace App\Filament\Resources\InsigniaResource\Pages;

use App\Filament\Resources\InsigniaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInsignias extends ListRecords
{
    protected static string $resource = InsigniaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
