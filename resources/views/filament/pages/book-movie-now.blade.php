<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Book Your Movie Tickets</h1>
            <p class="text-blue-100">Choose from our latest movies with upcoming showtimes</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search
                        Movies</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" id="search" placeholder="Search by movie title, description..."
                            class="block w-full pl-12 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors duration-200">
                    </div>
                </div>

                <!-- Genre Filter -->
                <div>
                    <label for="genre-filter"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter by Genre</label>
                    <select id="genre-filter"
                        class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors duration-200">
                        <option value="">All Genres</option>
                        <option value="action">Action</option>
                        <option value="comedy">Comedy</option>
                        <option value="drama">Drama</option>
                        <option value="horror">Horror</option>
                        <option value="romance">Romance</option>
                        <option value="sci-fi">Sci-Fi</option>
                        <option value="thriller">Thriller</option>
                        <option value="adventure">Adventure</option>
                    </select>
                </div>
            </div>

            <!-- Filter Tags -->
            <div class="mt-4 flex flex-wrap gap-2">
                <span
                    class="inline-flex items-center px-4 py-2 rounded-full text-base font-semibold bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 shadow-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2" />
                    </svg>
                    {{ $this->movies->count() }} Movies Found
                </span>
                <button
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Clear Filters
                </button>
            </div>
        </div>

        <!-- Movies Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead
                        class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 border-b-2 border-gray-300 dark:border-gray-500">
                        <tr>
                            <th
                                class="px-6 py-5 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider poster-column border-r border-gray-300 dark:border-gray-500">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <span>Poster</span>
                                </div>
                            </th>
                            <th
                                class="px-6 py-5 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider border-r border-gray-300 dark:border-gray-500">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z" />
                                    </svg>
                                    <span>Movie Details</span>
                                </div>
                            </th>
                            <th
                                class="px-6 py-5 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider border-r border-gray-300 dark:border-gray-500">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span>Genre & Language</span>
                                </div>
                            </th>
                            <th
                                class="px-6 py-5 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider border-r border-gray-300 dark:border-gray-500">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    <span>Rating</span>
                                </div>
                            </th>
                            <th
                                class="px-6 py-5 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Upcoming Showtimes</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($this->movies as $movie)
                            <tr class="transition-colors duration-200">
                                <!-- Movie Poster -->
                                <td class="px-6 py-4 poster-column">
                                    <div class="poster-container">
                                        <img class="movie-poster"
                                            src="{{ $movie->poster_url ?? '/placeholder.svg?height=180&width=135' }}"
                                            alt="{{ $movie->title }}">
                                    </div>
                                </td>

                                <!-- Movie Details -->
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <h3 class="text-lg font-semibold">{{ $movie->title }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 max-w-xs">
                                            {{ Str::limit($movie->description ?? 'No description available', 120) }}
                                        </p>
                                        <div class="flex items-center space-x-2 text-xs text-gray-500 py-3">
                                            <span
                                                class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 shadow-sm">
                                                {{ $movie->duration ?? 'N/A' }} min
                                            </span>

                                        </div>
                                    </div>
                                </td>

                                <!-- Genre & Language -->
                                <td class="px-6 py-4">
                                    <div class="space-y-2">
                                        <div class="flex flex-wrap gap-2 max-w-xs">
                                            @if (is_array($movie->genre))
                                                @foreach ($movie->genre as $genre)
                                                    <span
                                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-100 shadow-sm">
                                                        {{ $genre }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-100 shadow-sm">
                                                    {{ $movie->genre ?? 'N/A' }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Language:</span> {{ $movie->language ?? 'N/A' }}
                                        </div>
                                    </div>
                                </td>

                                <!-- Rating -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-1">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                            <span class="ml-1 text-sm font-semibold">
                                                {{ number_format($movie->rating ?? 0, 1) }}
                                            </span>
                                        </div>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">/10</span>
                                    </div>
                                </td>

                                <!-- Showtimes -->
                                <!-- Showtimes -->
                                <td class="px-6 py-4 w-[18rem] align-top">
                                    <div class="space-y-2 max-h-40 overflow-y-auto showtime-container">
                                        @forelse ($movie->showtimes as $showtime)
                                            <div
                                                class="flex items-center justify-between bg-gray-50 dark:bg-gray-700 rounded-lg px-4 py-3">
                                                <div class="text-sm">
                                                    <div class="font-medium text-gray-700 dark:text-gray-200">
                                                        {{ $showtime->start_time->format('M d') }}
                                                    </div>
                                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                                        {{ $showtime->start_time->format('H:i A') }}
                                                    </div>
                                                </div>
                                                <button
                                                    wire:click="selectShowtime({{ $movie->id }}, {{ $showtime->id }})"
                                                    class="book-now-btn">
                                                    Book Now
                                                </button>
                                            </div>
                                        @empty
                                            <div class="text-xs text-gray-400 dark:text-gray-500 italic">No upcoming
                                                shows</div>
                                        @endforelse
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center space-y-3">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4zM9 6v10h6V6H9z" />
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900">No Movies Available</h3>
                                        <p class="text-gray-500">There are no movies with upcoming showtimes at the
                                            moment.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Stats Section -->
        @if ($this->movies->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Available Movies</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $this->movies->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Showtimes</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $this->movies->sum(fn($movie) => $movie->showtimes->count()) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Avg Rating</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ number_format($this->movies->avg('rating') ?? 0, 1) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .action-cell {
            padding: 1.5rem 1rem;
        }

        /* Enhanced movie poster styling */
        .movie-poster {
            height: 180px !important;
            width: 135px !important;
            min-height: 180px !important;
            min-width: 135px !important;
            max-height: 180px !important;
            max-width: 135px !important;
            border-radius: 0.75rem !important;
            object-fit: cover !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            transition: transform 0.2s ease-in-out !important;
            display: block !important;
        }

        .poster-container {
            flex-shrink: 0 !important;
            width: 135px !important;
            min-width: 135px !important;
            display: flex !important;
            justify-content: center !important;
            align-items: flex-start !important;
        }

        /* Enhanced table styling for larger posters */
        tbody tr {
            height: auto !important;
            min-height: 200px !important;
        }

        tbody td {
            vertical-align: top !important;
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        /* Ensure poster column has enough width */
        .poster-column {
            width: 160px !important;
            min-width: 160px !important;
        }

        /* Override any Filament default image styles */
        .movie-poster,
        .poster-container img {
            height: 180px !important;
            width: 135px !important;
        }

        /* Custom Book Now Button for Showtimes */
        .book-now-btn {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            min-width: 80px;
            position: relative;
            overflow: hidden;
        }

        .book-now-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .book-now-btn:hover::before {
            left: 100%;
        }

        .book-now-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px -1px rgba(37, 99, 235, 0.4);
        }

        .book-now-btn:active {
            transform: translateY(1px);
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);
        }

        .book-now-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        }

        /* Showtime container styling */
        .showtime-container {
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
        }

        .showtime-container::-webkit-scrollbar {
            width: 6px;
        }

        .showtime-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .showtime-container::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 20px;
        }
    </style>
</x-filament-panels::page>
