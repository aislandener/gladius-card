<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WarriorResource\Pages;
use App\Models\Warrior;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WarriorResource extends Resource
{
    protected static ?string $model = Warrior::class;

    protected static ?string $slug = 'warriors';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),

                Forms\Components\Select::make('clan_id')
                    ->relationship('clan', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('xp')
                    ->integer()
                    ->required(),

                Forms\Components\TextInput::make('hp')
                    ->integer()
                    ->required(),

                Forms\Components\FileUpload::make('photo')
                    ->maxSize(4096)
                    ->disk('public')
                    ->imageEditor()
                    ->required(),

                Forms\Components\Checkbox::make('is_leader'),

                Forms\Components\Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Warrior $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Forms\Components\Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Warrior $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('photo'),

                Tables\Columns\TextColumn::make('xp'),

                Tables\Columns\TextColumn::make('hp'),

                Tables\Columns\IconColumn::make('is_leader')
                    ->boolean()
                ,

                Tables\Columns\TextColumn::make('clan.name')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListWarriors::route('/'),
            'create' => Pages\CreateWarrior::route('/create'),
            'edit' => Pages\EditWarrior::route('/{record}/edit'),
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
        return parent::getGlobalSearchEloquentQuery()->with(['clan']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'clan.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->clan) {
            $details['Clan'] = $record->clan->name;
        }

        return $details;
    }
}
