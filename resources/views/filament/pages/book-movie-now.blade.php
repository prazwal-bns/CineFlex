<x-filament-panels::page>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <div class="space-y-6">
        <!-- Hero Header -->
        <div
            class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-xl p-8 text-white dark:from-indigo-700 dark:via-purple-700 dark:to-pink-700">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Book Your Movie Tickets</h1>
                    <p class="text-indigo-100 dark:text-indigo-200">Choose from our latest movie selections and available
                        showtimes</p>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                        <i class="fas fa-film text-4xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Search Bar -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <i
                            class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                        <input type="text" placeholder="Search movies..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400">
                    </div>
                </div>
                <div class="flex gap-3">
                    <select
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option>All Genres</option>
                        <option>Action</option>
                        <option>Drama</option>
                        <option>Comedy</option>
                        <option>Horror</option>
                    </select>
                    <select
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option>All Languages</option>
                        <option>English</option>
                        <option>Hindi</option>
                        <option>Spanish</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Movies Table -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead
                        class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 border-b-2 border-gray-200 dark:border-gray-600">
                        <tr>
                            <th
                                class="text-left py-5 px-6 font-bold text-gray-900 dark:text-gray-100 text-sm uppercase tracking-wider">
                                <i class="fas fa-film mr-2 text-indigo-600 dark:text-indigo-400"></i>Movie
                            </th>
                            <th
                                class="text-left py-5 px-6 font-bold text-gray-900 dark:text-gray-100 text-sm uppercase tracking-wider">
                                <i class="fas fa-info-circle mr-2 text-indigo-600 dark:text-indigo-400"></i>Details
                            </th>
                            <th
                                class="text-left py-5 px-6 font-bold text-gray-900 dark:text-gray-100 text-sm uppercase tracking-wider">
                                <i class="fas fa-clock mr-2 text-indigo-600 dark:text-indigo-400"></i>Available
                                Showtimes
                            </th>
                            <th
                                class="text-center py-5 px-6 font-bold text-gray-900 dark:text-gray-100 text-sm uppercase tracking-wider">
                                <i class="fas fa-bolt mr-2 text-indigo-600 dark:text-indigo-400"></i>Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($this->movies as $movie)
                            <tr
                                class="bg-gradient-to-r from-gray-50 to-indigo-50 dark:from-gray-700 dark:to-indigo-900/30 transition-all duration-200 border-l-4 border-indigo-500 dark:border-indigo-400">
                                <!-- Movie Info Column -->
                                <td class="py-8 px-6">
                                    <div class="flex items-start space-x-6">
                                        <div class="flex-shrink-0">
                                            <div class="relative group">
                                                <img src="{{ $movie->poster_url ?: 'https://via.placeholder.com/120x180/f3f4f6/9ca3af?text=No+Image' }}"
                                                    alt="{{ $movie->title }}"
                                                    class="w-32 h-48 object-cover rounded-xl shadow-lg group-hover:shadow-xl transition-shadow duration-200">
                                            </div>
                                        </div>
                                        <div class="flex-grow min-w-0">
                                            <h3
                                                class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mb-2 transition-colors cursor-pointer">
                                                {{ $movie->title }}</h3>
                                            <p
                                                class="text-sm text-gray-600 dark:text-gray-300 mb-3 line-clamp-3 leading-relaxed">
                                                {{ Str::limit($movie->description, 150) }}
                                            </p>
                                            <div
                                                class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="flex items-center">
                                                    <i
                                                        class="fas fa-clock mr-1 text-indigo-500 dark:text-indigo-400"></i>{{ $movie->duration }}
                                                    min
                                                </span>
                                                <span class="flex items-center">
                                                    <i
                                                        class="fas fa-user-tie mr-1 text-indigo-500 dark:text-indigo-400"></i>{{ $movie->director }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Details Column -->
                                <td class="py-8 px-6">
                                    <div class="space-y-4">
                                        <!-- Rating -->
                                        <div class="flex items-center space-x-2 flex-wrap gap-2">
                                            <span
                                                class="bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                                                <i class="fas fa-star mr-1"></i>{{ $movie->rating }}/10
                                            </span>
                                            <span
                                                class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                                                {{ $movie->language }}
                                            </span>
                                        </div>

                                        <!-- Genres with enhanced badges -->
                                        <div class="flex flex-wrap gap-2">
                                            @if ($movie->genre)
                                                @foreach ($movie->genre as $index => $genre)
                                                    @php
                                                        $colors = [
                                                            'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                            'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                            'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                            'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                                            'bg-pink-100 text-pink-800 dark:bg-pink-900/30 dark:text-pink-300',
                                                            'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300',
                                                        ];
                                                        $colorClass = $colors[$index % count($colors)];
                                                    @endphp
                                                    <span
                                                        class="{{ $colorClass }} px-3 py-1 rounded-full text-xs font-semibold border border-current/20 hover:scale-105 transition-transform cursor-default">
                                                        {{ $genre }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>

                                        <!-- Release Date -->
                                        <div class="text-sm text-gray-600 dark:text-gray-300 flex items-center">
                                            <i
                                                class="fas fa-calendar-alt mr-2 text-indigo-500 dark:text-indigo-400"></i>
                                            <span
                                                class="font-medium">{{ $movie->release_date ? $movie->release_date->format('M d, Y') : 'TBA' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Showtimes Column - Show only 3 -->
                                <td class="py-8 px-6">
                                    <div class="w-80">
                                        @forelse ($movie->showtimes->take(3) as $showtime)
                                            <div
                                                class="mb-3 bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-indigo-900/40 dark:to-blue-900/40 rounded-xl p-4 border border-indigo-200 dark:border-indigo-500 transition-all duration-200 group cursor-pointer shadow-md">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-4">
                                                        <!-- Time Display -->
                                                        <div
                                                            class="bg-white dark:bg-gray-700 rounded-lg px-3 py-2 shadow-sm border border-indigo-300 dark:border-indigo-500 transition-colors">
                                                            <div
                                                                class="text-xl font-bold text-indigo-600 dark:text-indigo-400 transition-colors">
                                                                {{ $showtime->start_time->format('H:i') }}
                                                            </div>
                                                            <div
                                                                class="text-xs text-gray-500 dark:text-gray-400 text-center mt-1">
                                                                {{ $showtime->start_time->format('M d') }}
                                                            </div>
                                                        </div>

                                                        <!-- Details -->
                                                        <div class="flex-1">
                                                            <div class="flex items-center space-x-2 mb-1">
                                                                <span
                                                                    class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 px-2 py-1 rounded-full text-xs font-medium">
                                                                    ${{ $showtime->ticket_price }}
                                                                </span>
                                                                <span
                                                                    class="bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-2 py-1 rounded-full text-xs">
                                                                    Screen {{ $showtime->screen_id }}
                                                                </span>
                                                            </div>
                                                            <div class="text-xs text-gray-600 dark:text-gray-400">
                                                                <i class="fas fa-clock mr-1"></i>
                                                                {{ $showtime->start_time->format('l') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Select Button -->
                                                    <button
                                                        class="bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 transform scale-105 shadow-md">
                                                        <i class="fas fa-ticket-alt mr-1"></i>
                                                        Select
                                                    </button>
                                                </div>
                                            </div>
                                        @empty
                                            <div
                                                class="text-center py-8 bg-gray-50 dark:bg-gray-700 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600">
                                                <i
                                                    class="fas fa-calendar-times text-3xl text-gray-400 dark:text-gray-500 mb-3"></i>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">No
                                                    upcoming showtimes</p>
                                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Check back
                                                    later for updates</p>
                                            </div>
                                        @endforelse

                                        @if ($movie->showtimes->count() > 3)
                                            <div class="mt-4 text-center">
                                                <button
                                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 text-sm font-medium bg-indigo-50 dark:bg-indigo-900/30 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 px-4 py-2 rounded-lg transition-colors border border-indigo-200 dark:border-indigo-700 hover:border-indigo-300 dark:hover:border-indigo-500 w-full">
                                                    <i class="fas fa-plus mr-1"></i>
                                                    View {{ $movie->showtimes->count() - 3 }} more showtimes
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <!-- Action Column -->
                                <td class="py-8 px-6 text-center">
                                    <div class="space-y-3">
                                        <button
                                            class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-500 dark:via-purple-500 dark:to-pink-500 text-white px-6 py-3 rounded-xl font-bold transition-all duration-200 transform scale-105 shadow-xl w-full min-w-[120px]">
                                            <i class="fas fa-ticket-alt mr-2"></i>Book Now
                                        </button>
                                        <button
                                            class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/50 dark:to-purple-900/50 text-indigo-600 dark:text-indigo-400 px-4 py-2 rounded-lg font-medium transition-all duration-200 text-sm w-full border border-indigo-200 dark:border-indigo-500 shadow-sm">
                                            <i class="fas fa-info-circle mr-2"></i>Details
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Enhanced Footer Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div
                class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-shadow">
                <div
                    class="bg-gradient-to-r from-indigo-500 to-purple-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-film text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-1">{{ $this->movies->count() }}
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Movies Available</div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-shadow">
                <div
                    class="bg-gradient-to-r from-green-500 to-emerald-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-1">
                    {{ $this->movies->sum(fn($movie) => $movie->showtimes->count()) }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Total Showtimes</div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-shadow">
                <div
                    class="bg-gradient-to-r from-yellow-500 to-orange-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-star text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-1">
                    {{ number_format($this->movies->avg('rating'), 1) }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Average Rating</div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/50 transition-shadow">
                <div
                    class="bg-gradient-to-r from-pink-500 to-rose-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-ticket-alt text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-1">24/7</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Online Booking</div>
            </div>
        </div>
    </div>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-filament-panels::page>
