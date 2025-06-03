<x-filament-panels::page>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <div class="space-y-8">
        <!-- Hero Header -->
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 dark:from-blue-700 dark:via-indigo-800 dark:to-purple-900 rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative p-8 lg:p-12">
                <div class="flex items-center justify-between">
                    <div class="max-w-2xl">
                        <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-4 tracking-tight">
                            Book Your Movie Tickets
                        </h1>
                        <p class="text-xl text-blue-100 dark:text-blue-200 leading-relaxed">
                            Discover the latest blockbusters and reserve your perfect seats for an unforgettable cinema experience
                        </p>
                    </div>
                    <div class="hidden lg:block">
                        <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                            <i class="fas fa-film text-6xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 lg:p-8">
            <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
                <div class="flex-1 max-w-lg">
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                        <input type="text" placeholder="Search movies, directors, or genres..."
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200">
                    </div>
                </div>
                <div class="flex flex-wrap gap-4">
                    <select class="px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 min-w-[120px] transition-all duration-200">
                        <option>All Genres</option>
                        <option>Action</option>
                        <option>Drama</option>
                        <option>Comedy</option>
                        <option>Horror</option>
                        <option>Sci-Fi</option>
                    </select>
                    <select class="px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 min-w-[120px] transition-all duration-200">
                        <option>All Languages</option>
                        <option>English</option>
                        <option>Hindi</option>
                        <option>Spanish</option>
                        <option>French</option>
                    </select>
                    <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 text-white rounded-xl font-medium transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Movies Grid -->
        <div class="space-y-6">
            @foreach ($this->movies as $movie)
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg hover:shadow-2xl dark:shadow-gray-900/50 border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:-translate-y-1">
                    <div class="p-6 lg:p-8">
                        <div class="flex flex-col lg:flex-row gap-8">

                            <!-- Movie Poster and Basic Info -->
                            <div class="flex-shrink-0">
                                <div class="relative group">
                                    <img src="{{ $movie->poster_url ?: 'https://via.placeholder.com/300x450/e5e7eb/6b7280?text=No+Poster' }}"
                                        alt="{{ $movie->title }}"
                                        class="w-48 h-72 lg:w-56 lg:h-84 object-cover rounded-xl shadow-lg group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            </div>

                            <!-- Movie Details -->
                            <div class="flex-1 space-y-6">
                                <!-- Title and Rating -->
                                <div class="space-y-3">
                                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white leading-tight">
                                        {{ $movie->title }}
                                    </h2>
                                    <div class="flex items-center flex-wrap gap-3">
                                        <div class="flex items-center space-x-1 bg-amber-200 dark:bg-amber-900/50 text-amber-900 dark:text-amber-200 px-3 py-1 rounded-full border border-amber-300 dark:border-amber-700">
                                            <i class="fas fa-star text-amber-600 dark:text-amber-400"></i>
                                            <span class="font-semibold">{{ $movie->rating }}/10</span>
                                        </div>
                                        <span class="bg-blue-200 dark:bg-blue-900/50 text-blue-900 dark:text-blue-200 px-3 py-1 rounded-full font-medium border border-blue-300 dark:border-blue-700">
                                            {{ $movie->language }}
                                        </span>
                                        <span class="text-gray-600 dark:text-gray-400 flex items-center">
                                            <i class="fas fa-clock mr-1"></i>{{ $movie->duration }} min
                                        </span>
                                        <span class="text-gray-600 dark:text-gray-400 flex items-center">
                                            <i class="fas fa-user-tie mr-1"></i>{{ $movie->director }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Description -->
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg">
                                    {{ Str::limit($movie->description, 180) }}
                                </p>

                                <!-- Genres -->
                                @if ($movie->genre)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($movie->genre as $index => $genre)
                                            @php
                                                $genreColors = [
                                                    'bg-red-200 text-red-900 dark:bg-red-900/50 dark:text-red-200 border-red-300 dark:border-red-700',
                                                    'bg-green-200 text-green-900 dark:bg-green-900/50 dark:text-green-200 border-green-300 dark:border-green-700',
                                                    'bg-blue-200 text-blue-900 dark:bg-blue-900/50 dark:text-blue-200 border-blue-300 dark:border-blue-700',
                                                    'bg-purple-200 text-purple-900 dark:bg-purple-900/50 dark:text-purple-200 border-purple-300 dark:border-purple-700',
                                                    'bg-yellow-200 text-yellow-900 dark:bg-yellow-900/50 dark:text-yellow-200 border-yellow-300 dark:border-yellow-700',
                                                    'bg-pink-200 text-pink-900 dark:bg-pink-900/50 dark:text-pink-200 border-pink-300 dark:border-pink-700',
                                                ];
                                                $colorClass = $genreColors[$index % count($genreColors)];
                                            @endphp
                                            <span class="{{ $colorClass }} px-3 py-1 rounded-full text-sm font-medium border transition-transform hover:scale-105 cursor-default">
                                                {{ $genre }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Release Date -->
                                <div class="flex items-center text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-calendar-alt mr-2 text-blue-500 dark:text-blue-400"></i>
                                    <span class="font-medium">Released: {{ $movie->release_date ? $movie->release_date->format('M d, Y') : 'Coming Soon' }}</span>
                                </div>
                            </div>

                            <!-- Showtimes Section -->
                            <div class="lg:w-96">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                    <i class="fas fa-clock mr-2 text-blue-500 dark:text-blue-400"></i>
                                    Available Showtimes
                                </h3>

                                <div class="space-y-3 max-h-80 overflow-y-auto">
                                    @forelse ($movie->showtimes->take(4) as $showtime)
                                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all duration-200 group">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-4">
                                                    <div class="bg-blue-600 dark:bg-blue-700 text-white rounded-lg px-3 py-2 text-center min-w-[70px]">
                                                        <div class="text-lg font-bold">{{ $showtime->start_time->format('H:i') }}</div>
                                                        <div class="text-xs opacity-90">{{ $showtime->start_time->format('M d') }}</div>
                                                    </div>
                                                    <div>
                                                        <div class="flex items-center space-x-2 mb-1">
                                                            <span class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-2 py-1 rounded-full text-sm font-medium">
                                                                ${{ $showtime->ticket_price }}
                                                            </span>
                                                            <span class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded-full text-sm">
                                                                Screen {{ $showtime->screen_id }}
                                                            </span>
                                                        </div>
                                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                                            {{ $showtime->start_time->format('l') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 group-hover:scale-105 border border-blue-700 dark:border-blue-600">
                                                    <i class="fas fa-ticket-alt mr-2"></i>Select
                                                </button>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-8 bg-gray-50 dark:bg-gray-800 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600">
                                            <i class="fas fa-calendar-times text-4xl text-gray-400 dark:text-gray-500 mb-3"></i>
                                            <p class="text-gray-600 dark:text-gray-400 font-medium">No showtimes available</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">Check back later for updates</p>
                                        </div>
                                    @endforelse

                                    @if ($movie->showtimes->count() > 4)
                                        <button class="w-full text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/40 py-3 rounded-xl font-medium transition-all duration-200 border border-blue-200 dark:border-blue-800 hover:border-blue-300 dark:hover:border-blue-600">
                                            <i class="fas fa-chevron-down mr-2"></i>
                                            Show {{ $movie->showtimes->count() - 4 }} more showtimes
                                        </button>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-6 space-y-3">
                                    <button class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 dark:from-blue-700 dark:to-indigo-700 dark:hover:from-blue-600 dark:hover:to-indigo-600 text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                                        <i class="fas fa-ticket-alt mr-2"></i>Book Tickets Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Enhanced Statistics -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 text-center border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all duration-300 hover:-translate-y-1">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-film text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">{{ $this->movies->count() }}</div>
                <div class="text-gray-700 dark:text-gray-300 font-medium">Movies Available</div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 text-center border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all duration-300 hover:-translate-y-1">
                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mb-2">
                    {{ $this->movies->sum(fn($movie) => $movie->showtimes->count()) }}
                </div>
                <div class="text-gray-700 dark:text-gray-300 font-medium">Total Showtimes</div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 text-center border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all duration-300 hover:-translate-y-1">
                <div class="bg-gradient-to-br from-yellow-500 to-orange-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-star text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-2">
                    {{ number_format($this->movies->avg('rating'), 1) }}
                </div>
                <div class="text-gray-700 dark:text-gray-300 font-medium">Average Rating</div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 text-center border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-all duration-300 hover:-translate-y-1">
                <div class="bg-gradient-to-br from-rose-500 to-pink-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-ticket-alt text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-rose-600 dark:text-rose-400 mb-2">24/7</div>
                <div class="text-gray-700 dark:text-gray-300 font-medium">Online Booking</div>
            </div>
        </div>
    </div>

    <style>
        /* Custom scrollbar for showtime sections */
        .space-y-3::-webkit-scrollbar {
            width: 6px;
        }
        .space-y-3::-webkit-scrollbar-track {
            @apply bg-gray-100 dark:bg-gray-800 rounded-full;
        }
        .space-y-3::-webkit-scrollbar-thumb {
            @apply bg-gray-300 dark:bg-gray-600 rounded-full hover:bg-gray-400 dark:hover:bg-gray-500;
        }
    </style>
</x-filament-panels::page>
