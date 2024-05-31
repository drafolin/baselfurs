<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Enums\RegistrationLocation;
use App\Models\Attendance;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class AttendancesRelationManager extends RelationManager
{
    protected static string $relationship = 'attendances';

    public function isReadOnly(): bool
    {
        return false;
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        if ($ownerRecord instanceof Event)
            return $ownerRecord->registration_location != RegistrationLocation::Remote;

        return true;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount_of_people')
                    ->required()
                    ->default(1)
                    ->numeric(),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email(),
                Forms\Components\TextInput::make('contact')
                    ->required(),
                Forms\Components\Textarea::make('more_info')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle(fn(Attendance $record) => "$record->name's attendance")
            ->columns([
                Tables\Columns\TextColumn::make('amount_of_people'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email')
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
            ]);
    }
}
