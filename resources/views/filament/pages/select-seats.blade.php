<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if ($showtime)
        <div class="space-y-6">
            {{-- Movie Information --}}
            @include('components.movies.movie-info')

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
                @php
                    $sortedSeats = $this->seats->sortBy([
                        fn($a, $b) => $a->row <=> $b->row,
                        fn($a, $b) => (int) $a->number <=> (int) $b->number,
                    ]);
                @endphp

                <div class="grid grid-cols-8 gap-2 mb-6">
                    @foreach ($sortedSeats as $seat)
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
                            <span @class([
                                'text-gray-600' => !$isSelected && !$isBooked,
                                'text-white' => $isSelected,
                                'text-gray-800' => $isBooked,
                            ])>
                                {{ $seat->row }}{{ $seat->number }}
                            </span>
                        </button>
                    @endforeach
                </div>


                {{-- Legend --}}
                <div class="flex items-center space-x-4 text-sm">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-gray-400 rounded mr-2"></div>
                        <span class="text-gray-600">Available</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-primary-500 rounded mr-2"></div>
                        <span class="text-gray-600">Selected</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-gray-800 rounded mr-2"></div>
                        <span class="text-gray-600">Booked</span>
                    </div>
                </div>
            </div>

            {{-- Coupon Section --}}
            @if (count($selectedSeats) > 0)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold mb-4 flex items-center text-green-500">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Apply Coupon
                    </h3>

                    @if (!$couponApplied)
                        <div class="flex space-x-3">
                            <div class="flex-1">
                                <input type="text"
                                       wire:model="couponCode"
                                       placeholder="Enter coupon code"
                                       class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent uppercase text-gray-600"
                                       style="text-transform: uppercase;">
                                @error('couponCode')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <button wire:click="applyCoupon"
                                    class="px-6 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-600 transition-colors font-medium">
                                Apply Coupon
                            </button>
                        </div>
                    @else
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-green-800 font-medium">Coupon Applied: {{ $appliedCoupon->code }}</p>
                                        <p class="text-green-600 text-sm">{{ $appliedCoupon->description }}</p>
                                    </div>
                                </div>
                                <button wire:click="removeCoupon"
                                        class="text-red-500 hover:text-red-700 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            {{-- Summary and Proceed Button --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Selected Seats: {{ count($selectedSeats) }}</p>

                        @if ($couponApplied && $discountAmount > 0)
                            <div class="space-y-1">
                                <p class="text-gray-600">Original Price: <span class="line-through">NPR {{ number_format($originalPrice, 2) }}</span></p>
                                <p class="text-green-600">Discount: -NPR {{ number_format($discountAmount, 2) }}</p>
                                <p class="text-primary-600 text-xl font-bold">Final Price: NPR {{ number_format($finalPrice, 2) }}</p>
                            </div>
                        @else
                            <p class="text-primary-600 text-xl font-bold">Total: NPR {{ number_format($totalPrice, 2) }}</p>
                        @endif
                    </div>
                    @if (count($selectedSeats) > 0)
                        <button wire:click="proceedToPayment"
                            class="px-6 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">
                            Proceed to Payment
                        </button>
                    @endif
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
