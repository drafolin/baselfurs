<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LinkCategoryResource\Pages;
use App\Filament\Resources\LinkCategoryResource\RelationManagers;
use App\Models\LinkCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LinkCategoryResource extends Resource
{
    protected static ?string $model = LinkCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('child_count')
                ->getStateUsing(function (LinkCategory $record) {
                    return $record->links()->count();
                })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->reorderable('position')
            ->defaultSort('position')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LinksRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLinkCategories::route('/'),
            'create' => Pages\CreateLinkCategory::route('/create'),
            'edit' => Pages\EditLinkCategory::route('/{record}/edit'),
        ];
    }
}