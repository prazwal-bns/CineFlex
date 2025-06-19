<?php

namespace App\Filament\Pages;

use App\Models\Seat;
use App\Models\Showtime;
use Filament\Pages\Page;
use Livewire\Attributes\Url;

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

    public $seatPrice = 0;

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
        $this->totalPrice = count($this->selectedSeats) * $this->seatPrice;
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

        // Store the selected seats in the session
        session(['selected_seats' => $this->selectedSeats]);
        session(['showtime_id' => $this->showtimeId]);
        session(['total_price' => $this->totalPrice]);

        // Redirect to payment page
        // dd($this->showtimeId);
        $this->redirectRoute('payViaEsewa', ['showtimeId' => $this->showtimeId]);
    }
}
