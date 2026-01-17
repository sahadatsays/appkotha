<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductFileResource\Pages;
use App\Models\ProductFile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductFileResource extends Resource
{
    protected static ?string $model = ProductFile::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';

    protected static ?string $navigationGroup = 'E-Commerce';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Product Files';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('File Information')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\FileUpload::make('file_path')
                            ->label('Upload File')
                            ->directory('product-files')
                            ->disk('local')
                            ->required()
                            ->visibility('private')
                            ->acceptedFileTypes(['application/zip', 'application/x-zip-compressed', 'application/pdf', 'application/x-rar-compressed'])
                            ->maxSize(512000), // 500MB max
                        Forms\Components\TextInput::make('file_name')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Display name for the file'),
                        Forms\Components\Select::make('file_type')
                            ->options([
                                'zip' => 'ZIP Archive',
                                'pdf' => 'PDF Document',
                                'rar' => 'RAR Archive',
                                'other' => 'Other',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('file_size')
                            ->numeric()
                            ->suffix('bytes')
                            ->disabled()
                            ->dehydrated(false),
                    ])->columns(2),

                Forms\Components\Section::make('Version Information')
                    ->schema([
                        Forms\Components\TextInput::make('version')
                            ->maxLength(50)
                            ->placeholder('1.0.0'),
                        Forms\Components\Textarea::make('changelog')
                            ->maxLength(65535)
                            ->rows(3)
                            ->placeholder('What\'s new in this version...'),
                        Forms\Components\Toggle::make('is_main')
                            ->label('Main Download File')
                            ->helperText('This will be the default download for the product'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'zip' => 'success',
                        'pdf' => 'danger',
                        'rar' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('version')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('formatted_file_size')
                    ->label('Size'),
                Tables\Columns\IconColumn::make('is_main')
                    ->boolean()
                    ->label('Main'),
                Tables\Columns\TextColumn::make('download_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('product')
                    ->relationship('product', 'name'),
                Tables\Filters\SelectFilter::make('file_type')
                    ->options([
                        'zip' => 'ZIP',
                        'pdf' => 'PDF',
                        'rar' => 'RAR',
                        'other' => 'Other',
                    ]),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductFiles::route('/'),
            'create' => Pages\CreateProductFile::route('/create'),
            'edit' => Pages\EditProductFile::route('/{record}/edit'),
        ];
    }
}
