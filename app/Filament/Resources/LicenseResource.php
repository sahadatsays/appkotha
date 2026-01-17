<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LicenseResource\Pages;
use App\Models\License;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LicenseResource extends Resource
{
    protected static ?string $model = License::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationGroup = 'E-Commerce';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('License Information')
                    ->schema([
                        Forms\Components\TextInput::make('license_key')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\Select::make('order_item_id')
                            ->relationship('orderItem', 'id')
                            ->required()
                            ->disabled(),
                        Forms\Components\Select::make('license_type')
                            ->options([
                                'one-time' => 'One-time',
                                'monthly' => 'Monthly',
                                'yearly' => 'Yearly',
                                'lifetime' => 'Lifetime',
                            ])
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'expired' => 'Expired',
                                'revoked' => 'Revoked',
                                'suspended' => 'Suspended',
                            ])
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Activation Settings')
                    ->schema([
                        Forms\Components\TextInput::make('max_activations')
                            ->numeric()
                            ->minValue(1)
                            ->default(3),
                        Forms\Components\TextInput::make('current_activations')
                            ->numeric()
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('expires_at')
                            ->nullable(),
                        Forms\Components\TextInput::make('download_count')
                            ->numeric()
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Activations Log')
                    ->schema([
                        Forms\Components\Textarea::make('activations')
                            ->disabled()
                            ->rows(4)
                            ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state, JSON_PRETTY_PRINT) : $state),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('license_key')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->limit(20),
                Tables\Columns\TextColumn::make('orderItem.order.order_number')
                    ->label('Order')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('orderItem.product_name')
                    ->label('Product')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('license_type')
                    ->colors([
                        'primary' => 'one-time',
                        'info' => 'monthly',
                        'warning' => 'yearly',
                        'success' => 'lifetime',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => fn ($state) => in_array($state, ['expired', 'revoked']),
                        'warning' => 'suspended',
                    ]),
                Tables\Columns\TextColumn::make('current_activations')
                    ->label('Activations')
                    ->formatStateUsing(fn ($state, License $record) => "{$state}/{$record->max_activations}"),
                Tables\Columns\TextColumn::make('expires_at')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Never'),
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
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'expired' => 'Expired',
                        'revoked' => 'Revoked',
                        'suspended' => 'Suspended',
                    ]),
                Tables\Filters\SelectFilter::make('license_type')
                    ->options([
                        'one-time' => 'One-time',
                        'monthly' => 'Monthly',
                        'yearly' => 'Yearly',
                        'lifetime' => 'Lifetime',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('revoke')
                    ->label('Revoke')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (License $record) => $record->status === 'active')
                    ->action(fn (License $record) => $record->update(['status' => 'revoked'])),
                Tables\Actions\Action::make('activate')
                    ->label('Activate')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (License $record) => in_array($record->status, ['suspended', 'revoked']))
                    ->action(fn (License $record) => $record->update(['status' => 'active'])),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListLicenses::route('/'),
            'view' => Pages\ViewLicense::route('/{record}'),
            'edit' => Pages\EditLicense::route('/{record}/edit'),
        ];
    }
}
