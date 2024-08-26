<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Filament\Resources\BankResource\RelationManagers;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nome do banco')
                    ->required()
                    ->columnSpan(2),
                Forms\Components\FileUpload::make('logo')
                ->imageEditor()
                    ->required()
                    ->label('Logotipo')
                    ->columnSpan(2),
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->columnSpan(2)
                    ->relationship('user','name',
                    modifyQueryUsing: fn (Builder $query) => $query->where('perfil','admin_bank'),)
                    ->label('Gestor do Banco')
                    ,
                Forms\Components\FileUpload::make('img')
                ->required()
                ->imageEditor()
                ->label('Imagem destacada')
                    ->required()
                    ->columnSpan(2),
                Forms\Components\Textarea::make('location')
                    ->label('Localização')
                    ->required()
                    ->columnSpanFull(),
          
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('img')
                ->circular(),
                Tables\Columns\TextColumn::make('unicode','Teste')
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
            'index' => Pages\ManageBanks::route('/'),
        ];
    }
}
