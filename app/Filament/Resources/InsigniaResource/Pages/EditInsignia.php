<?php

namespace App\Filament\Resources\InsigniaResource\Pages;

use App\Filament\Resources\InsigniaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditInsignia extends EditRecord
{
    protected static string $resource = InsigniaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
