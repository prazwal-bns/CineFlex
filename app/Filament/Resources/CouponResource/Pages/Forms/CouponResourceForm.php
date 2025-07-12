<?php

namespace App\Filament\Resources\CouponResource\Pages\Forms;

use App\Filament\Contracts\ResourceFieldContract;
use App\Support\Helper;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;

final class CouponResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Grid::make(12)
                ->schema([
                    Grid::make(1)
                        ->schema([
                            Section::make('Coupon Information')
                                ->description('Enter the basic details of the coupon')
                                ->icon('heroicon-o-ticket')
                                ->collapsible()
                                ->schema([
                                    Forms\Components\TextInput::make('code')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(50)
                                        ->label('Coupon Code')
                                        ->placeholder('Enter coupon code')
                                        ->prefixIcon('heroicon-o-tag')
                                        ->columnSpanFull()
                                        ->dehydrateStateUsing(fn (string $state) => Helper::upperString($state)),

                                    RichEditor::make('description')
                                        ->required()
                                        ->maxLength(255)
                                        ->label('Description')
                                        ->placeholder('Enter coupon description')
                                        ->toolbarButtons([
                                            'bold',
                                            'italic',
                                            'bulletList',
                                            'orderedList',
                                        ])
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Discount Settings')
                                ->description('Configure the discount type and value')
                                ->icon('heroicon-o-currency-dollar')
                                ->collapsible()
                                ->schema([
                                    Forms\Components\Select::make('discount_type')
                                        ->required()
                                        ->selectablePlaceholder(false)
                                        ->options([
                                            'percentage' => 'Percentage',
                                            'fixed' => 'Fixed Amount',
                                        ])
                                        ->default('percentage')
                                        ->label('Discount Type')
                                        ->live()
                                        ->columnSpanFull(),

                                    Forms\Components\TextInput::make('percentage_discount')
                                        ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->step(0.01)
                                        ->label('Percentage Discount')
                                        ->placeholder('Enter percentage (0-100)')
                                        ->suffix('%')
                                        ->prefixIcon('heroicon-o-percent-badge')
                                        ->columnSpanFull()
                                        ->visible(fn (Get $get) => $get('discount_type') === 'percentage'),

                                    Forms\Components\TextInput::make('fixed_discount')
                                        ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->step(0.01)
                                        ->label('Fixed Amount Discount')
                                        ->placeholder('Enter fixed amount')
                                        ->prefixIcon('heroicon-o-currency-dollar')
                                        ->columnSpanFull()
                                        ->visible(fn (Get $get) => $get('discount_type') === 'fixed'),

                                ]),
                        ])
                        ->columnSpan(8),

                    Grid::make(1)
                        ->schema([
                            Section::make('Usage Limits')
                                ->description('Set the usage restrictions')
                                ->icon('heroicon-o-user-group')
                                ->collapsible()
                                ->schema([
                                    Forms\Components\TextInput::make('usage_limit')
                                        ->numeric()
                                        ->minValue(1)
                                        ->label('Usage Limit')
                                        ->placeholder('Leave empty for unlimited usage')
                                        ->prefixIcon('heroicon-o-user-group')
                                        ->columnSpanFull(),
                                    Forms\Components\TextInput::make('times_used')
                                        ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->default(0)
                                        ->label('Times Used')
                                        ->disabled()
                                        ->prefixIcon('heroicon-o-chart-bar')
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Validity Period')
                                ->description('Set the active period for the coupon')
                                ->icon('heroicon-o-calendar')
                                ->collapsible()
                                ->schema([
                                    Forms\Components\DatePicker::make('valid_from')
                                        ->required()
                                        ->label('Valid From')
                                        ->minDate(now())
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-calendar')
                                        ->columnSpanFull(),
                                    Forms\Components\DatePicker::make('valid_until')
                                        ->required()
                                        ->label('Valid Until')
                                        ->minDate(fn (Forms\Get $get) => $get('valid_from') ?? now())
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-calendar')
                                        ->columnSpanFull(),
                                    Forms\Components\Toggle::make('is_active')
                                        ->required()
                                        ->label('Active Status')
                                        ->default(true)
                                        ->inline(false)
                                        ->helperText('Enable or disable this coupon')
                                        ->columnSpanFull(),
                                ]),
                        ])
                        ->columnSpan(4),
                ]),
        ];
    }
}
