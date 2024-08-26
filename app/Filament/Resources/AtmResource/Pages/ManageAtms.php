<?php

namespace App\Filament\Resources\AtmResource\Pages;

use App\Filament\Resources\AtmResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAtms extends ManageRecords
{
    protected static string $resource = AtmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
