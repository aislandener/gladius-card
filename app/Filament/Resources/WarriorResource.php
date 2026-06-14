<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WarriorResource\Pages\CreateWarrior;
use App\Filament\Resources\WarriorResource\Pages\EditWarrior;
use App\Filament\Resources\WarriorResource\Pages\ListWarriors;
use App\Models\Clan;
use App\Models\Warrior;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WarriorResource extends Resource
{
    protected static ?string $model = Warrior::class;

    protected static ?string $slug = 'warriors';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                Select::make('clan_id')
                    ->relationship('clan', 'name')
                    ->default(Clan::where('is_default', true)->first()?->id)
                    ->preload()
                    ->searchable()
                    ->required(),

                TextInput::make('xp')
                    ->integer()
                    ->required(),

                TextInput::make('hp')
                    ->integer()
                    ->required(),

                FileUpload::make('photo')
                    ->maxSize(4096)
                    ->disk('public')
                    ->imageEditor()
                    ->required(),

                Checkbox::make('is_leader'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn (?Warrior $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn (?Warrior $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('photo'),

                TextColumn::make('xp'),

                TextColumn::make('hp'),

                IconColumn::make('is_leader')
                    ->boolean(),

                TextColumn::make('clan.name')
                    ->searchable()
                    ->sortable(),
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
            'index' => ListWarriors::route('/'),
            'create' => CreateWarrior::route('/create'),
            'edit' => EditWarrior::route('/{record}/edit'),
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
