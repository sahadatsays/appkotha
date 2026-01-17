<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Site Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Setting Information')
                    ->schema([
                        Forms\Components\Select::make('group')
                            ->options(Setting::getGroups())
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('key')
                            ->required()
                            ->maxLength(255)
                            ->alphaDash()
                            ->helperText('Use lowercase with underscores (e.g., company_name)'),
                        Forms\Components\TextInput::make('label')
                            ->maxLength(255)
                            ->helperText('Human readable label'),
                        Forms\Components\Select::make('type')
                            ->options(Setting::getTypes())
                            ->default('text')
                            ->required()
                            ->reactive(),
                    ])->columns(2),

                Forms\Components\Section::make('Value')
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->maxLength(65535)
                            ->visible(fn (Forms\Get $get): bool => in_array($get('type'), ['text', 'url', 'number']))
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('value')
                            ->rows(4)
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'textarea')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('value')
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'richtext')
                            ->columnSpanFull(),
                        Forms\Components\ColorPicker::make('value')
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'color'),
                        Forms\Components\FileUpload::make('value')
                            ->image()
                            ->directory('settings')
                            ->visibility('public')
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'image'),
                        Forms\Components\Toggle::make('value')
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'boolean')
                            ->dehydrateStateUsing(fn ($state) => $state ? '1' : '0'),
                        Forms\Components\Textarea::make('value')
                            ->rows(6)
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'json')
                            ->helperText('Enter valid JSON')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->rows(2)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Options')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('group')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => Setting::getGroups()[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        'company' => 'success',
                        'hero' => 'primary',
                        'colors' => 'warning',
                        'social' => 'info',
                        'seo' => 'danger',
                        'contact' => 'gray',
                        'stats' => 'secondary',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('value')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('group')
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options(Setting::getGroups()),
                Tables\Filters\SelectFilter::make('type')
                    ->options(Setting::getTypes()),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
