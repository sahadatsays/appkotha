<?php

namespace App\Filament\Resources\ProductFileResource\Pages;

use App\Filament\Resources\ProductFileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductFiles extends ListRecords
{
    protected static string $resource = ProductFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
