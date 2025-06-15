<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if ($showtime)
        <div class="space-y-6">
            {{-- Movie Information --}}
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 space-y-6">
    {{-- Top Flex Section: Movie Poster + Info + Showtime --}}
    <div class="flex flex-col md:flex-row items-start gap-6">
        {{-- Movie Poster --}}
        @if ($movie->poster_url)
            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}"
                class="w-40 md:w-56 h-auto object-cover rounded-lg shadow-md">
        @endif

        {{-- Movie Info Section --}}
        <div class="flex-1 space-y-3">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ $movie->title }}</h2>
            <div class="text-gray-600 text-base leading-relaxed">
                <p class="mb-2">
                    @if (is_array($movie->genre))
                        @foreach ($movie->genre as $genre)
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-100 shadow-sm">
                                {{ $genre }}
                            </span>
                        @endforeach
                    @endif
                </p>
                <p><span class="font-semibold">Director:</span> {{ $movie->director }}</p>
                <p><span class="font-semibold">Duration:</span> {{ $movie->duration }} mins</p>
                <p><span class="font-semibold">Rating:</span> ⭐ {{ $movie->rating ?? 'N/A' }}/10</p>
                <p><span class="font-semibold">Language:</span> {{ $movie->language }}</p>
                <p><span class="font-semibold">Country:</span> {{ $movie->country ?? 'Unknown' }}</p>
            </div>
        </div>

        {{-- Showtime Section --}}
        <div class="md:w-64 text-center md:text-right mt-6 md:mt-0 space-y-2">
            <p class="text-lg text-gray-500">Showtime</p>
            <p class="text-2xl font-bold text-gray-900">
                {{ $showtime->start_time->format('F j, Y') }}
            </p>
            <p class="text-xl font-medium text-indigo-600">
                {{ $showtime->start_time->format('g:i A') }} -
                {{ $showtime->start_time->copy()->addHours(3)->format('g:i A') }}
            </p>
            <p class="text-sm text-gray-400">Estimated Duration: 3 hrs</p>
        </div>
    </div>

    {{-- Full Width Screen & Seat Info --}}
    <div class="bg-gray-50 p-4 rounded-lg shadow-inner text-center space-y-2 w-full">
        <p class="text-lg font-semibold text-indigo-600 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
            </svg>
            Screen: <span class="ml-1 text-gray-800">{{ $screen->name }}</span>
        </p>
        <p class="text-base text-gray-700">
            💺 Price per Seat: <span class="font-semibold">${{ number_format($seatPrice, 2) }}</span>
        </p>
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
