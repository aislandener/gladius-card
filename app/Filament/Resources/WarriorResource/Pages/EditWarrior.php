<?php

namespace App\Filament\Resources\WarriorResource\Pages;

use App\Filament\Resources\WarriorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditWarrior extends EditRecord
{
    protected static string $resource = WarriorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
