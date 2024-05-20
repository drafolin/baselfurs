<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\ToggleButtons::make('featured')
                    ->boolean()
                    ->grouped(),
                Forms\Components\DateTimePicker::make('start_date')
                    ->seconds(false)
                    ->columnStart(1),
                Forms\Components\DateTimePicker::make('end_date')
                    ->seconds(false)
                    ->columnStart(2),
                Forms\Components\RichEditor::make('short_description')
                    ->maxLength(300)
                    ->helperText('Will be displayed in the event popout.')
                    ->columnSpan(2),
                Forms\Components\RichEditor::make('description')
                    ->helperText('Will be displayed in the event details page.')
                    ->columnSpan(2),
                Forms\Components\TextInput::make('address'),
                Map::make('location')
                    ->columnSpanFull()
                    ->autocomplete(
                        fieldName: 'address',
                        countries: ['CH', 'FR', 'DE']
                    )
                    ->reverseGeocode([
                        'street' => '%n %S',
                        'city' => '%L',
                        'state' => '%A1',
                        'zip' => '%z',
                    ])
                    ->autocompleteReverse(true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('featured')
                    ->boolean()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->grow(),
            ])
            ->filters([
                Filter::make('is_future')
                    ->query(fn(Builder $query): Builder => $query
                        ->where('end_date', '>', date('Y-m-d')))
                    ->default(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            EventResource\RelationManagers\AttendancesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
            'view' => Pages\ViewEvent::route('/{record}')
        ];
    }
}
