<?php

namespace App\Filament\Pages;

use App\Models\Seat;
use App\Models\Showtime;
use App\Models\Coupon;
use Filament\Pages\Page;
use Livewire\Attributes\Url;
use Carbon\Carbon;
use Filament\Notifications\Notification;

class SelectSeats extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';

    protected static string $view = 'filament.pages.select-seats';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Select Seats';

    protected static ?string $slug = 'select-seats';

    #[Url]
    public $showtimeId;

    public $movie;

    public $showtime;

    public $screen;

    public $selectedSeats = [];

    public $totalPrice = 0;

    public $originalPrice = 0;

    public $discountAmount = 0;

    public $finalPrice = 0;

    public $seatPrice = 0;

    // Coupon related properties
    public $couponCode = '';

    public $appliedCoupon = null;

    public $couponApplied = false;

    public $couponMessage = '';

    public function mount($showtimeId = null): void
    {
        if (! $showtimeId && request()->has('showtimeId')) {
            $showtimeId = request()->get('showtimeId');
        }

        if ($showtimeId) {
            $this->showtimeId = $showtimeId;
            $this->loadShowtimeData();
        } else {
            $this->addError('showtime', 'No showtime ID provided.');
        }
    }

    public function loadShowtimeData(): void
    {
        $this->showtime = Showtime::with(['movie', 'screen'])->find($this->showtimeId);

        if ($this->showtime) {
            $this->movie = $this->showtime->movie;
            $this->screen = $this->showtime->screen;
            $this->seatPrice = $this->showtime->ticket_price;
        } else {
            // Add more detailed error message
            $this->addError('showtime', "Showtime with ID {$this->showtimeId} not found.");
        }
    }

    public function toggleSeat($seatId): void
    {
        if (in_array($seatId, $this->selectedSeats)) {
            $this->selectedSeats = array_diff($this->selectedSeats, [$seatId]);
        } else {
            $this->selectedSeats[] = $seatId;
        }
        $this->calculateTotal();
    }

    public function calculateTotal(): void
    {
        $this->originalPrice = count($this->selectedSeats) * $this->seatPrice;
        $this->totalPrice = $this->originalPrice;

        // Recalculate discount if coupon is applied
        if ($this->couponApplied && $this->appliedCoupon) {
            $this->applyDiscount();
        } else {
            $this->discountAmount = 0;
            $this->finalPrice = $this->totalPrice;
        }
    }

    public function applyCoupon(): void
    {
        if (empty($this->couponCode)) {
            $this->addError('couponCode', 'Please enter a coupon code.');
            return;
        }

        if (empty($this->selectedSeats)) {
            $this->addError('couponCode', 'Please select seats first before applying a coupon.');
            return;
        }

        $coupon = Coupon::where('code', strtoupper($this->couponCode))->first();

        if (!$coupon) {
            $this->addError('couponCode', 'Invalid coupon code.');
            return;
        }

        // Use the model's validation method
        if (!$coupon->isValidForUse()) {
            $this->addError('couponCode', $coupon->getValidationErrorMessage());
            return;
        }

        // Apply the coupon
        $this->appliedCoupon = $coupon;
        $this->couponApplied = true;
        $this->applyDiscount();

        $this->couponMessage = "Coupon '{$coupon->code}' applied successfully!";

        Notification::make()
            ->title('Coupon Applied!')
            ->body("You saved NPR " . number_format($this->discountAmount, 2) . " with coupon '{$coupon->code}'")
            ->success()
            ->send();
    }

    public function removeCoupon(): void
    {
        $this->appliedCoupon = null;
        $this->couponApplied = false;
        $this->couponCode = '';
        $this->couponMessage = '';
        $this->discountAmount = 0;
        $this->finalPrice = $this->totalPrice;

        Notification::make()
            ->title('Coupon Removed')
            ->body('Coupon has been removed from your booking.')
            ->warning()
            ->send();
    }

    protected function applyDiscount(): void
    {
        if (!$this->appliedCoupon) {
            return;
        }

        $this->discountAmount = $this->appliedCoupon->calculateDiscountAmount($this->totalPrice);
        $this->finalPrice = $this->totalPrice - $this->discountAmount;

        // Ensure final price is not negative
        if ($this->finalPrice < 0) {
            $this->finalPrice = 0;
        }
    }

    public function getSeatsProperty()
    {
        if (! $this->screen) {
            return collect();
        }

        return Seat::where('screen_id', $this->screen->id)
            ->orderBy('row')
            ->orderBy('number')
            ->get();
    }

    public function getBookedSeatsProperty()
    {
        if (! $this->showtime) {
            return [];
        }

        return $this->showtime->bookings()
            ->with('seats')
            ->get()
            ->pluck('seats.*.id')
            ->flatten()
            ->toArray();
    }

    public function proceedToPayment(): void
    {
        if (empty($this->selectedSeats)) {
            $this->addError('seats', 'Please select at least one seat.');
            return;
        }

        // Store the selected seats and pricing information in the session
        session(['selected_seats' => $this->selectedSeats]);
        session(['showtime_id' => $this->showtimeId]);
        session(['total_price' => $this->finalPrice]); // Use final price after discount
        session(['original_price' => $this->originalPrice]);
        session(['discount_amount' => $this->discountAmount]);

        // Store coupon information if applied
        if ($this->couponApplied && $this->appliedCoupon) {
            session(['coupon_id' => $this->appliedCoupon->id]);
            session(['coupon_code' => $this->appliedCoupon->code]);
        } else {
            session()->forget(['coupon_id', 'coupon_code']);
        }

        // Redirect to payment page
        $this->redirectRoute('payViaEsewa', ['showtimeId' => $this->showtimeId]);
    }
}
