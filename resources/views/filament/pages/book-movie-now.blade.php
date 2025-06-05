<x-filament-panels::page>
    @vite(['resources/css/app.css'])
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Book Your Movie Tickets</h1>
            <p class="text-blue-100">Choose from our latest movies with upcoming showtimes</p>
        </div>

        <!-- Search, Filter, and Sort Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Movies</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" id="search" placeholder="Search by movie title, description..."
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    </div>
                </div>

                <!-- Genre Filter -->
                <div>
                    <label for="genre-filter" class="block text-sm font-medium text-gray-700 mb-2">Filter by Genre</label>
                    <select id="genre-filter" class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
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

                <!-- Sort Options -->
                <div>
                    <label for="sort-by" class="block text-sm font-medium text-gray-700 mb-2">Sort by</label>
                    <select id="sort-by" class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="title">Movie Title</option>
                        <option value="rating">Rating (High to Low)</option>
                        <option value="rating-low">Rating (Low to High)</option>
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="duration">Duration</option>
                    </select>
                </div>
            </div>

            <!-- Filter Tags -->
            <div class="mt-4 flex flex-wrap gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2"/>
                    </svg>
                    {{ $this->movies->count() }} Movies Found
                </span>
                <button class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Clear Filters
                </button>
            </div>
        </div>

        <!-- Movies Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider poster-column">
                                Poster
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Movie Details
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Genre & Language
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rating
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Upcoming Showtimes
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($this->movies as $movie)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
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
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $movie->title }}</h3>
                                        <p class="text-sm text-gray-600 max-w-xs">
                                            {{ Str::limit($movie->description ?? 'No description available', 80) }}
                                        </p>
                                        <div class="flex items-center space-x-2 text-xs text-gray-500">
                                            <span class="bg-gray-100 px-2 py-1 rounded-full">
                                                {{ $movie->duration ?? 'N/A' }} min
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Genre & Language -->
                                <td class="px-6 py-4">
                                    <div class="space-y-2">
                                        <div class="flex flex-wrap gap-1">
                                            @if(is_array($movie->genre))
                                                @foreach(array_slice($movie->genre, 0, 2) as $genre)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $genre }}
                                                    </span>
                                                @endforeach
                                                @if(count($movie->genre) > 2)
                                                    <span class="text-xs text-gray-500">+{{ count($movie->genre) - 2 }} more</span>
                                                @endif
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $movie->genre ?? 'N/A' }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <span class="font-medium">Language:</span> {{ $movie->language ?? 'N/A' }}
                                        </div>
                                    </div>
                                </td>

                                <!-- Rating -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-1">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                            <span class="ml-1 text-sm font-semibold text-gray-900">
                                                {{ number_format($movie->rating ?? 0, 1) }}
                                            </span>
                                        </div>
                                        <span class="text-xs text-gray-500">/10</span>
                                    </div>
                                </td>

                                <!-- Showtimes -->
                                <td class="px-6 py-4">
                                    <div class="space-y-1 max-h-20 overflow-y-auto">
                                        @forelse ($movie->showtimes->take(3) as $showtime)
                                            <div class="flex items-center justify-between bg-gray-50 rounded-lg px-3 py-2">
                                                <div class="text-sm">
                                                    <div class="font-medium text-gray-900">
                                                        {{ $showtime->start_time->format('M d') }}
                                                    </div>
                                                    <div class="text-xs text-gray-600">
                                                        {{ $showtime->start_time->format('H:i A') }}
                                                    </div>
                                                </div>
                                                <button
                                                    wire:click="selectShowtime({{ $movie->id }}, {{ $showtime->id }})"
                                                    class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full hover:bg-green-200 transition-colors duration-200 font-medium">
                                                    Select
                                                </button>
                                            </div>
                                        @empty
                                            <div class="text-xs text-gray-400 italic">No upcoming shows</div>
                                        @endforelse

                                        @if($movie->showtimes->count() > 3)
                                            <div class="text-xs text-blue-600 font-medium">
                                                +{{ $movie->showtimes->count() - 3 }} more times
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <!-- Action Button -->
                                <td class="px-6 py-4">
                                    @if($movie->showtimes->count() > 0)
                                        <button class="book-now-button">
                                            Book Now
                                        </button>
                                    @else
                                        <button disabled class="no-shows-button">
                                            No Shows
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center space-y-3">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4zM9 6v10h6V6H9z"/>
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900">No Movies Available</h3>
                                        <p class="text-gray-500">There are no movies with upcoming showtimes at the moment.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Stats Section -->
        @if($this->movies->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Available Movies</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $this->movies->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Showtimes</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $this->movies->sum(fn($movie) => $movie->showtimes->count()) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Avg Rating</p>
                            <p class="text-2xl font-semibold text-gray-900">
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

        .book-now-button {
            width: 100%;
            background: linear-gradient(to right, #2563eb, #1d4ed8);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
        }

        .book-now-button:hover {
            background: linear-gradient(to right, #1d4ed8, #1e40af);
            transform: scale(1.05);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .no-shows-button {
            width: 100%;
            background-color: #d1d5db;
            color: #6b7280;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            border: none;
            cursor: not-allowed;
        }

        /* Enhanced movie poster styling with !important to override any conflicts */
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

        .movie-poster:hover {
            transform: scale(1.05) !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
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
    </style>
</x-filament-panels::page>
