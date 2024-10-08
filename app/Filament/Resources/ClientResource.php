<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                     ->label('Nome')
                    ->required(),
                Forms\Components\Select::make('user_id')
                ->label('Usuário')
                   ->relationship('user','name',
                   modifyQueryUsing: fn(Builder $query)=> $query->where('perfil','=','client'))
                    ->required(),
                    Forms\Components\Select::make('bank_id')
                    ->label('Selecione o banco')
                          ->Relationship('bank','name')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Select::make('countrie_id')
                    ->label('País')
                   ->relationship('countrie','name',
                   modifyQueryUsing: fn (Builder $query) => $query->where('name','Angola'))
                    ->required(),

                    Forms\Components\Select::make('state_id')
                    ->label('Estado')
                   ->relationship('state','name')
                    ->required(),
                    Forms\Components\TextInput::make('bairro')
                    ->label('Bairro')
                    ->required(),
                    Forms\Components\TextInput::make('phone')
                    ->label('Telefone')
                    ->unique()
                    ->tel()
                    ->required(),
                Forms\Components\FileUpload::make('bi')
                     ->label('Bilhete de Identidade')
                    ->required()
                    ->columnSpanFull(),
                    Forms\Components\FileUpload::make('foto')
                    ->required()
                    ->imageEditor()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('declaration')
                    ->label('Declaração')
                    ->columnSpanFull()
                    ->required(),
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')     
                ->circular(),         
                Tables\Columns\TextColumn::make('user.name')
                ->label('Cliente')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('bi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('countrie.name')
                    ->label('País')
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bairro')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefone')
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
            'index' => Pages\ManageClients::route('/'),
        ];
    }
}
