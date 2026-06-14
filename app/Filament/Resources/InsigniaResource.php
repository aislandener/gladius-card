<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use App\Filament\Resources\InsigniaResource\Pages\ListInsignias;
use App\Filament\Resources\InsigniaResource\Pages\CreateInsignia;
use App\Filament\Resources\InsigniaResource\Pages\EditInsignia;
use App\Filament\Resources\InsigniaResource\Pages;
use App\Models\Insignia;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InsigniaResource extends Resource
{
    protected static ?string $model = Insignia::class;

    protected static ?string $slug = 'insignias';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                Select::make('group_id')
                    ->relationship('group', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                FileUpload::make('path')
                    ->required()
                    ->image()
                    ->directory('Insignia')
                    ->disk('public')
                    ->maxSize(1024)
                ,

                TextInput::make('requirement'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Insignia $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Insignia $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('group.name')
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('path'),

                TextColumn::make('requirement'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInsignias::route('/'),
            'create' => CreateInsignia::route('/create'),
            'edit' => EditInsignia::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['group']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'group.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->group) {
            $details['Group'] = $record->group->name;
        }

        return $details;
    }
}
