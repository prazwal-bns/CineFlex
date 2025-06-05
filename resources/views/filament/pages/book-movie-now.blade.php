<x-filament-panels::page>
    @vite(['resources/css/app.css'])
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Book Your Movie Tickets</h1>
            <p class="text-blue-100">Choose from our latest movies with upcoming showtimes</p>
        </div>

        <!-- Movies Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">
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
                                <td class="px-6 py-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-20 w-16 rounded-lg object-cover shadow-md"
                                             src="{{ $movie->poster_url ?? '/placeholder.svg?height=80&width=64' }}"
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
                                        <button class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg text-sm">
                                            Book Now
                                        </button>
                                    @else
                                        <button disabled class="w-full bg-gray-300 text-gray-500 font-semibold py-2 px-4 rounded-lg text-sm cursor-not-allowed">
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
</x-filament-panels::page>
