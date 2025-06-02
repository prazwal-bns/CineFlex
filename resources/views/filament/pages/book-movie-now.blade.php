<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($this->movies as $movie)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $movie->title }}</h2>
                    <p class="text-sm text-gray-600">{{ Str::limit($movie->description, 100) }}</p>
                    <p class="text-sm mt-2"><strong>Genre:</strong> {{ implode(', ', $movie->genre) }}</p>
                    <p class="text-sm"><strong>Language:</strong> {{ $movie->language }}</p>
                    <p class="text-sm mb-2"><strong>Rating:</strong> {{ $movie->rating }}/10</p>

                    <div class="mt-4">
                        <h3 class="text-sm font-semibold mb-1">Upcoming Showtimes:</h3>
                        <ul class="space-y-1">
                            @forelse ($movie->showtimes as $showtime)
                                <li class="text-xs text-gray-700">
                                    {{ $showtime->start_time->format('M d, Y H:i') }}
                                    – <span class="text-green-600 font-semibold">Book Now</span>
                                </li>
                            @empty
                                <li class="text-xs text-gray-400">No upcoming showtimes.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
