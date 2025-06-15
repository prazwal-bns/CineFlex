<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if ($showtime)
        <div class="space-y-6">
            {{-- Movie Information --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-start space-x-4">
                    @if ($movie->poster_url)
                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}"
                            class="w-32 h-48 object-cover rounded-lg">
                    @endif
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $movie->title }}</h2>
                        <div class="mt-2 space-y-1">
                            <p class="text-gray-600"><span class="font-semibold">Showtime:</span>
                                {{ $showtime->start_time->format('F j, Y g:i A') }}</p>
                            <p class="text-gray-600"><span class="font-semibold">Screen:</span> {{ $screen->name }}</p>
                            <p class="text-gray-600"><span class="font-semibold">Price per seat:</span>
                                ${{ number_format($seatPrice, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Seat Selection --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4">Select Your Seats</h3>

                {{-- Screen Display --}}
                <div class="mb-12">
                    <div
                        class="relative bg-gradient-to-b from-gray-300 to-gray-200 h-10 rounded-b-full shadow-inner flex items-center justify-center">
                        <span class="text-gray-700 font-semibold tracking-widest">SCREEN</span>
                    </div>
                </div>


                {{-- Seat Grid --}}
                <div class="grid grid-cols-8 gap-2 mb-6">
                    @foreach ($this->seats as $seat)
                        @php
                            $isSelected = in_array($seat->id, $this->selectedSeats);
                            $isBooked = in_array($seat->id, $this->bookedSeats);
                        @endphp
                        <button wire:click="toggleSeat({{ $seat->id }})" @class([
                            'p-2 rounded text-center text-sm font-medium transition-colors',
                            'bg-gray-200 hover:bg-gray-300' => !$isSelected && !$isBooked,
                            'bg-primary-500 text-white hover:bg-primary-600' => $isSelected,
                            'bg-gray-400 cursor-not-allowed' => $isBooked,
                        ])
                            @disabled($isBooked)>
                            {{ $seat->row_number }}{{ $seat->seat_number }}
                        </button>
                    @endforeach
                </div>

                {{-- Legend --}}
                <div class="flex items-center space-x-4 text-sm">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-gray-800 rounded mr-2"></div>
                        <span class="text-gray-600">Available</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-primary-500 rounded mr-2"></div>
                        <span class="text-gray-600">Selected</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-gray-400 rounded mr-2"></div>
                        <span class="text-gray-600">Booked</span>
                    </div>
                </div>
            </div>

            {{-- Summary and Proceed Button --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Selected Seats: {{ count($selectedSeats) }}</p>
                        <p class="text-primary-600 text-xl font-bold">Total: ${{ number_format($totalPrice, 2) }}</p>
                    </div>
                    <button wire:click="proceedToPayment"
                        class="px-6 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">
                        Proceed to Payment
                    </button>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-6">
            @error('showtime')
                <div class="text-red-500 mb-4">{{ $message }}</div>
            @enderror
            <p class="text-gray-600">Please select a showtime first.</p>
            @if ($showtimeId)
                <p class="text-gray-600 mt-2">Debug: Showtime ID: {{ $showtimeId }}</p>
            @endif
        </div>
    @endif
</x-filament-panels::page>
