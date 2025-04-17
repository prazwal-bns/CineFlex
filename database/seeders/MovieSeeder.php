<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MovieSeeder extends Seeder
{
    protected $apiKey;
    protected $baseUrl = 'https://api.themoviedb.org/3';

    public function __construct()
    {
        $this->apiKey = env('TMDB_API_KEY');
    }

    public function run(): void
    {
        if (empty($this->apiKey)) {
            Log::error('TMDB API key is not set in .env file');
            return;
        }

        // Fetch popular movies
        $response = Http::get("{$this->baseUrl}/movie/popular", [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'page' => 1,
        ]);

        if ($response->successful()) {
            $movies = $response->json()['results'];

            foreach ($movies as $movieData) {
                // Fetch movie details to get additional information
                $movieDetails = Http::get("{$this->baseUrl}/movie/{$movieData['id']}", [
                    'api_key' => $this->apiKey,
                    'language' => 'en-US',
                    'append_to_response' => 'credits',
                ])->json();

                // Get director from credits
                $director = collect($movieDetails['credits']['crew'] ?? [])
                    ->where('job', 'Director')
                    ->first()['name'] ?? 'Unknown';

                // Get genres
                $genres = collect($movieDetails['genres'] ?? [])
                    ->pluck('name')
                    ->implode(', ');

                Movie::firstOrCreate(
                    ['title' => $movieData['title']],
                    [
                        'title' => $movieData['title'],
                        'description' => $movieData['overview'],
                        'duration' => $movieDetails['runtime'] ?? 120,
                        'release_date' => $movieData['release_date'],
                        'poster_url' => "https://image.tmdb.org/t/p/w500{$movieData['poster_path']}",
                        'director' => $director,
                        'genre' => $genres ?: 'Unknown',
                        'rating' => $movieData['vote_average'] ?? null,
                        'language' => $movieDetails['original_language'] ?? 'English',
                        'country' => $movieDetails['production_countries'][0]['name'] ?? null,
                    ]
                );
            }

            $this->command->info('Successfully seeded movies from TMDB API');
        } else {
            Log::error('Failed to fetch movies from TMDB API', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            $this->command->error('Failed to fetch movies from TMDB API');
        }
    }
}
