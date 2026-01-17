<?php

namespace App\Filament\Resources\ProductFileResource\Pages;

use App\Filament\Resources\ProductFileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateProductFile extends CreateRecord
{
    protected static string $resource = ProductFileResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Calculate file size if file was uploaded
        if (!empty($data['file_path'])) {
            $data['file_size'] = Storage::disk('local')->size($data['file_path']);
        }

        return $data;
    }
}
