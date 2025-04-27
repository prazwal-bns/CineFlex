<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title' => 'The Dark Knight',
                'description' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'duration' => 152,
                'release_date' => '2008-07-18',
                'poster_url' => 'https://i1.sndcdn.com/artworks-000480914043-0a2fis-t500x500.jpg',
                'director' => 'Christopher Nolan',
                'genre' => ['Action', 'Crime', 'Drama'],
                'rating' => 9.0,
                'language' => 'English',
                'country' => 'United States',
            ],
            [
                'title' => 'Inception',
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'duration' => 148,
                'release_date' => '2010-07-16',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg',
                'director' => 'Christopher Nolan',
                'genre' => ['Action', 'Sci-Fi', 'Thriller'],
                'rating' => 8.8,
                'language' => 'English',
                'country' => 'United States',
            ],
            [
                'title' => 'The Shawshank Redemption',
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'duration' => 142,
                'release_date' => '1994-09-23',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/q6y0Go1tsGEsmtFryDOJo3dEmqu.jpg',
                'director' => 'Frank Darabont',
                'genre' => ['Drama'],
                'rating' => 9.3,
                'language' => 'English',
                'country' => 'United States',
            ],
            [
                'title' => 'The Godfather',
                'description' => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
                'duration' => 175,
                'release_date' => '1972-03-14',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/3bhkrj58Vtu7enYsRolD1fZdja1.jpg',
                'director' => 'Francis Ford Coppola',
                'genre' => ['Crime', 'Drama'],
                'rating' => 9.2,
                'language' => 'English',
                'country' => 'United States',
            ],
            [
                'title' => 'Pulp Fiction',
                'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'duration' => 154,
                'release_date' => '1994-09-10',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/d5iIlFn5s0ImszYzBPb8JPIfbXD.jpg',
                'director' => 'Quentin Tarantino',
                'genre' => ['Crime', 'Drama'],
                'rating' => 8.9,
                'language' => 'English',
                'country' => 'United States',
            ],
        ];

        foreach ($movies as $movie) {
            Movie::firstOrCreate(
                ['title' => $movie['title']],
                [
                    'title' => $movie['title'],
                    'description' => $movie['description'],
                    'duration' => $movie['duration'],
                    'release_date' => $movie['release_date'],
                    'poster_url' => $movie['poster_url'],
                    'director' => $movie['director'],
                    'genre' => $movie['genre'],
                    'rating' => $movie['rating'],
                    'language' => $movie['language'],
                    'country' => $movie['country'],
                ]
            );
        }

        $this->command->info('Successfully seeded sample movies');
    }
}
