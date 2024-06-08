<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InsigniaResource\Pages;
use App\Models\Insignia;
use Filament\Forms;
use Filament\Forms\Form;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),

                Forms\Components\Select::make('group_id')
                    ->relationship('group', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\FileUpload::make('path')
                    ->required()
                    ->image()
                    ->avatar()
                    ->disk('public')
                    ->maxSize(1024)
                ,

                Forms\Components\TextInput::make('requirement'),

                Forms\Components\Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Insignia $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Forms\Components\Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Insignia $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('group.name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('path'),

                Tables\Columns\TextColumn::make('requirement'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInsignias::route('/'),
            'create' => Pages\CreateInsignia::route('/create'),
            'edit' => Pages\EditInsignia::route('/{record}/edit'),
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
