<?php

namespace App\Filament\Resources\ProductFileResource\Pages;

use App\Filament\Resources\ProductFileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditProductFile extends EditRecord
{
    protected static string $resource = ProductFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Calculate file size if file was changed
        if (!empty($data['file_path'])) {
            $data['file_size'] = Storage::disk('local')->size($data['file_path']);
        }

        return $data;
    }
}
