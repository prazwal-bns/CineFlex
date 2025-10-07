<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if ($showtime)
        <div class="space-y-6">
            {{-- Movie Information --}}
            @include('components.movies.movie-info')

            {{-- Seat Selection --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold mb-6 text-gray-900 dark:text-white">Select Your Seats</h3>

                {{-- Screen Display --}}
                <div class="mb-12">
                    <div class="relative bg-gradient-to-b from-gray-300 to-gray-200 dark:from-gray-600 dark:to-gray-500 h-12 rounded-b-full shadow-inner flex items-center justify-center border border-gray-400 dark:border-gray-500">
                        <span class="text-gray-700 dark:text-gray-200 font-bold tracking-widest text-sm">SCREEN</span>
                    </div>
                </div>


                {{-- Seat Grid --}}
                @php
                    $sortedSeats = $this->seats->sortBy([
                        fn($a, $b) => $a->row <=> $b->row,
                        fn($a, $b) => (int) $a->number <=> (int) $b->number,
                    ]);
                @endphp

                <div class="grid grid-cols-8 gap-3 mb-8">
                    @foreach ($sortedSeats as $seat)
                        @php
                            $isSelected = in_array($seat->id, $this->selectedSeats);
                            $isBooked = in_array($seat->id, $this->bookedSeats);
                        @endphp
                        <button wire:click="toggleSeat({{ $seat->id }})" @class([
                            'p-3 rounded-lg text-center text-sm font-semibold transition-all duration-200 transform hover:scale-',
                            'bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600' => !$isSelected && !$isBooked,
                            'bg-amber-500 text-white hover:bg-amber-600 border border-amber-600 focus:ring-amber-500 shadow-lg' => $isSelected,
                            'bg-gray-400 dark:bg-gray-500 cursor-not-allowed border border-gray-500 dark:border-gray-400' => $isBooked,
                        ])
                            @disabled($isBooked)>
                            <span @class([
                                'text-gray-700 dark:text-gray-300' => !$isSelected && !$isBooked,
                                'text-white font-bold' => $isSelected,
                                'text-gray-800 dark:text-gray-200' => $isBooked,
                            ])>
                                {{ $seat->row }}{{ $seat->number }}
                            </span>
                        </button>
                    @endforeach
                </div>


                {{-- Legend --}}
                <div class="flex flex-wrap items-center gap-6 text-sm">
                    <div class="flex items-center">
                        <div class="w-5 h-5 bg-gray-200 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg mr-3"></div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Available</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-5 h-5 bg-amber-500 border border-amber-600 rounded-lg mr-3 shadow-sm"></div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Selected</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-5 h-5 bg-gray-400 dark:bg-gray-500 border border-gray-500 dark:border-gray-400 rounded-lg mr-3"></div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Booked</span>
                    </div>
                </div>
            </div>

            {{-- Coupon Section --}}
            @if (count($selectedSeats) > 0)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold mb-6 flex items-center text-emerald-600 dark:text-emerald-400">
                        <svg class="w-6 h-6 mr-3 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Apply Coupon
                    </h3>

                    @if (!$couponApplied)
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1">
                                <input type="text"
                                       wire:model="couponCode"
                                       placeholder="Enter coupon code"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent uppercase text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 transition-colors"
                                       style="text-transform: uppercase;">
                                @error('couponCode')
                                    <span class="text-red-500 dark:text-red-400 text-sm mt-2 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <button wire:click="applyCoupon"
                                    class="px-8 py-3 bg-amber-500 text-white rounded-lg hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                                Apply Coupon
                            </button>
                        </div>
                    @else
                        <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-emerald-800 dark:text-emerald-200 font-semibold text-lg">Coupon Applied: {{ $appliedCoupon->code }}</p>
                                        <p class="text-emerald-600 dark:text-emerald-300 text-sm mt-1">{{ $appliedCoupon->description }}</p>
                                    </div>
                                </div>
                                <button wire:click="removeCoupon"
                                        class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20">
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
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="space-y-3">
                        <p class="text-gray-700 dark:text-gray-300 font-medium">Selected Seats: <span class="text-amber-600 dark:text-amber-400 font-bold">{{ count($selectedSeats) }}</span></p>

                        @if ($couponApplied && $discountAmount > 0)
                            <div class="space-y-2">
                                <p class="text-gray-600 dark:text-gray-400">Original Price: <span class="line-through text-gray-500 dark:text-gray-500">NPR {{ number_format($originalPrice, 2) }}</span></p>
                                <p class="text-emerald-600 dark:text-emerald-400 font-semibold">Discount: -NPR {{ number_format($discountAmount, 2) }}</p>
                                <p class="text-amber-600 dark:text-amber-400 text-2xl font-bold">Final Price: NPR {{ number_format($finalPrice, 2) }}</p>
                            </div>
                        @else
                            <p class="text-amber-600 dark:text-amber-400 text-2xl font-bold">Total: NPR {{ number_format($totalPrice, 2) }}</p>
                        @endif
                    </div>
                    @if (count($selectedSeats) > 0)
                        <button wire:click="proceedToPayment"
                            class="px-8 py-4 bg-amber-500 text-white rounded-xl hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition-all duration-200 font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                            Proceed to Payment
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 border border-gray-200 dark:border-gray-700 text-center">
            @error('showtime')
                <div class="text-red-500 dark:text-red-400 mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                    <svg class="w-6 h-6 mx-auto mb-2 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
            <div class="space-y-4">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300">No Showtime Selected</h3>
                <p class="text-gray-600 dark:text-gray-400">Please select a showtime first to proceed with seat selection.</p>
                @if ($showtimeId)
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">Debug: Showtime ID: {{ $showtimeId }}</p>
                @endif
            </div>
        </div>
    @endif
</x-filament-panels::page>
