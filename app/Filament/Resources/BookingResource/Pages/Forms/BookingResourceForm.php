<?php

namespace App\Filament\Resources\BookingResource\Pages\Forms;

use Filament\Forms;
use App\Filament\Contracts\ResourceFieldContract;
use App\Filament\Resources\UserResource\Pages\Forms\UserResourceForm;

final class BookingResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Forms\Components\Section::make('Booking Details')
                ->description('Enter the booking information')
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Customer')
                        ->placeholder('Select a customer')
                        ->createOptionForm(UserResourceForm::getFields()),

                    Forms\Components\Select::make('showtime_id')
                        ->relationship('showtime', 'id')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Showtime')
                        ->placeholder('Select a showtime')
                        ->options(function () {
                            return \App\Models\Showtime::with('movie')
                                ->get()
                                ->mapWithKeys(function ($showtime) {
                                    return [$showtime->id => sprintf(
                                        '%s - %s (%s)',
                                        $showtime->movie->title,
                                        $showtime->start_time->format('F j, Y h:i A'),
                                        $showtime->screen->name
                                    )];
                                });
                        }),

                    Forms\Components\Select::make('coupon_id')
                        ->relationship('coupon', 'code')
                        ->searchable()
                        ->preload()
                        ->label('Coupon')
                        ->placeholder('Select a coupon (optional)')
                        ->helperText('Apply a discount coupon if available'),

                    Forms\Components\Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'confirmed' => 'Confirmed',
                            'cancelled' => 'Cancelled',
                        ])
                        ->required()
                        ->default('pending')
                        ->label('Booking Status')
                        ->helperText('Current status of the booking'),

                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('total_price')
                                ->required()
                                ->numeric()
                                ->prefix('NPR')
                                ->label('Total Price')
                                ->helperText('Total amount before discount'),

                            Forms\Components\TextInput::make('discounted_price')
                                ->numeric()
                                ->prefix('NPR')
                                ->label('Discounted Price')
                                ->helperText('Final amount after discount')
                                ->visible(fn(Forms\Get $get) => filled($get('coupon_id'))),
                        ]),
                ])
                ->columns(2),

            Forms\Components\Section::make('Seat Selection')
                ->description('Select seats for this booking')
                ->schema([
                    Forms\Components\Select::make('seats')
                        ->relationship('seats', 'id')
                        ->multiple()
                        ->preload()
                        ->searchable()
                        ->label('Select Seats')
                        ->placeholder('Choose seats')
                        ->options(function (Forms\Get $get) {
                            if (!$get('showtime_id')) {
                                return [];
                            }

                            $showtime = \App\Models\Showtime::with(['screen.seats', 'bookings.seats'])
                                ->find($get('showtime_id'));

                            if (!$showtime) {
                                return [];
                            }

                            $bookedSeats = $showtime->bookings
                                ->pluck('seats.*.id')
                                ->flatten()
                                ->toArray();

                            return $showtime->screen->seats
                                ->whereNotIn('id', $bookedSeats)
                                ->mapWithKeys(function ($seat) {
                                    return [$seat->id => "Row {$seat->row}, Seat {$seat->number}"];
                                });
                        })
                        ->required()
                        ->helperText('Select available seats for this booking'),
                ])
                ->collapsible(),
        ];
    }
}
