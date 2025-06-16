<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if ($showtime)
        <div class="space-y-6">
            {{-- Movie Information --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="flex flex-col md:flex-row min-h-[600px]">
                    {{-- Left Side: Movie Poster --}}
                    <div class="md:w-80 lg:w-96 flex-shrink-0 min-h-[600px]">
                        @if ($movie->poster_url)
                            <div class="relative h-full">
                                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}"
                                    class="w-full h-full object-cover rounded-l-xl">
                            </div>
                        @endif
                    </div>

                    {{-- Right Side: All Movie Information --}}
                    <div
                        class="flex-1 flex flex-col justify-between p-6 md:p-8 lg:p-10 space-y-8 min-h-[600px] overflow-y-auto">
                        {{-- Movie Title & Basic Info --}}
                        <div class="space-y-4">
                            <h1 class="text-3xl font-extrabold text-gray-900">
                                {{ $movie->title }}
                            </h1>

                            {{-- Genre Tags --}}
                            <div class="flex flex-wrap gap-2">
                                @if (is_array($movie->genre))
                                    @foreach ($movie->genre as $genre)
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-sm hover:shadow-md transition-shadow">
                                            {{ $genre }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{-- Movie Details Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                {{-- Director --}}
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Director</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $movie->director }}</p>
                                    </div>
                                </div>

                                {{-- Duration --}}
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Duration</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $movie->duration }} mins</p>
                                    </div>
                                </div>

                                {{-- Language, Rating, Country side by side --}}
                                <div class="flex space-x-6">
                                    {{-- Language --}}
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 font-medium">Language</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $movie->language }}</p>
                                        </div>
                                    </div>

                                    {{-- Rating --}}
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-yellow-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 font-medium">Rating</p>
                                            <p class="text-lg font-semibold text-gray-900">
                                                {{ $movie->rating ?? 'N/A' }}/10
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Country --}}
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 font-medium">Country</p>
                                            <p class="text-lg font-semibold text-gray-900">
                                                {{ $movie->country ?? 'Unknown' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- If you want, keep other details here or adjust grid as needed --}}
                        </div>

                        {{-- Showtime Section --}}
                        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-6 border border-indigo-100">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Showtime
                                    </h3>
                                    <p class="text-2xl font-bold text-indigo-700">
                                        {{ $showtime->start_time->format('g:i A') }} -
                                        {{ $showtime->start_time->addHours(3)->format('g:i A') }}
                                    </p>
                                    <p class="text-lg text-gray-600">
                                        {{ $showtime->start_time->format('F j, Y') }}
                                    </p>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <p>Duration: {{ $movie->duration }} minutes</p>
                                    <p class="font-medium">Ends approximately:
                                        {{ $showtime->start_time->copy()->addMinutes($movie->duration)->format('g:i A') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Screen & Pricing Section --}}
                        <div
                            class="bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl p-6 border border-emerald-100">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Screen</p>
                                        <p class="text-xl font-bold text-gray-900">{{ $screen->name }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500 font-medium">Price per Seat</p>
                                    <p class="text-3xl font-bold text-emerald-600">${{ number_format($seatPrice, 2) }}
                                    </p>
                                </div>
                            </div>
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
