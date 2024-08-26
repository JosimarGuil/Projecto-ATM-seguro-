<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AtmResource\Pages;
use App\Filament\Resources\AtmResource\RelationManagers;
use App\Models\Atm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class AtmResource extends Resource
{
    protected static ?string $model = Atm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('serialNumber')
                ->default(mt_rand('1',100))
                    ->required()
                    ->label('Numero de Série')
                    ->unique()
                    ->columnSpanFull(),
                Forms\Components\Select::make('bank_id')
                ->label('Selecione o banco')
                      ->Relationship('bank','name')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('countrie_id')
                    ->label('País')
                     ->relationship('countrie','name',
                     modifyQueryUsing: fn (Builder $query) => $query->where('name','Angola'),
                     )
                    ->required(),
                Forms\Components\Select::make('state_id')
                ->label('Província')
                ->Relationship('state','name')
                    ->required(),
                Forms\Components\TextInput::make('bairro')
                   ->label('Bairro / Rua...')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('bank.logo')
                ->circular()
                ->label('Banco'),
                Tables\Columns\TextColumn::make('bank.name')
                ->label('Banco')
                ->sortable(),
                Tables\Columns\TextColumn::make('serialNumber')
                    ->numeric()
                    ->label('N Série')
                    ->sortable(),
                Tables\Columns\TextColumn::make('countrie.name')
                ->label('País')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                     ->label('Província')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bairro')
                    ->label('Bairro / Outros')
                    ->searchable(),
               
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ManageAtms::route('/'),
        ];
    }
}
