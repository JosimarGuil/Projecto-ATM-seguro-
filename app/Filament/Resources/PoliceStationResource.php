<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PoliceStationResource\Pages;
use App\Filament\Resources\PoliceStationResource\RelationManagers;
use App\Models\PoliceStation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PoliceStationResource extends Resource
{
    protected static ?string $model = PoliceStation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('atm_id')
                ->label('Associar atm')
                    ->Relationship('atm','id')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('phone1')
                    ->tel()
                    ->label('Telefone 1')
                    ->required(),
                Forms\Components\TextInput::make('phone2')
                ->label('Telefone 2')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('responsavel')
                ->label('Responsável da Esquadra')
                    ->required(),
                Forms\Components\TextInput::make('Localização')
                ->label('Localização')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('atm.id')
                ->label('Atm associado')
                ->searchable(),
                Tables\Columns\TextColumn::make('phone1')
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone2')
                    ->sortable(),
                    Tables\Columns\TextColumn::make('responsavel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Localização')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePoliceStations::route('/'),
        ];
    }
}
