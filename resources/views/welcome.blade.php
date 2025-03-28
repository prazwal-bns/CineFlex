<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CineFlex - Book Your Movie Experience</title>
    <link rel="icon" type="image/png" href="https://img.icons8.com/3d-fluency/94/film-reel.png">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/3d-fluency/94/film-reel.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF2D55',
                        secondary: '#1A1A1A',
                        dark: '#0F0F0F',
                    }
                }
            }
        }
    </script>
    <style>
        .mobile-menu {
            display: none;
        }
        .mobile-menu.active {
            display: block;
        }
    </style>
</head>
<body class="bg-dark text-white">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-dark/90 backdrop-blur-sm border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="#" class="text-2xl font-bold text-primary">CineFlex</a>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-white hover:text-primary transition">Home</a>
                    <a href="#" class="text-white hover:text-primary transition">Movies</a>
                    <a href="#" class="text-white hover:text-primary transition">Cinemas</a>
                    <a href="#" class="text-white hover:text-primary transition">Contact</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-white hover:text-primary transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-primary transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-white hover:text-primary transition">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
                <button id="mobile-menu-button" class="md:hidden text-white">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="mobile-menu md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="#" class="block px-3 py-2 text-white hover:text-primary transition">Home</a>
                    <a href="#" class="block px-3 py-2 text-white hover:text-primary transition">Movies</a>
                    <a href="#" class="block px-3 py-2 text-white hover:text-primary transition">Cinemas</a>
                    <a href="#" class="block px-3 py-2 text-white hover:text-primary transition">Contact</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="block px-3 py-2 text-white hover:text-primary transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block px-3 py-2 text-white hover:text-primary transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block px-3 py-2 text-white hover:text-primary transition">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center">
        <div class="absolute inset-0 bg-gradient-to-r from-dark/90 to-dark/50 z-10"></div>
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                 class="w-full h-full object-cover" alt="Movie Theater">
        </div>
        <div class="container mx-auto px-4 relative z-20">
            <div class="max-w-2xl">
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-bold mb-6 leading-tight">Experience Movies Like Never Before</h1>
                <p class="text-lg sm:text-xl md:text-2xl text-gray-300 mb-8">Book your tickets now for the latest blockbusters in premium quality screens.</p>
                <a href="#now-showing" class="bg-primary hover:bg-primary/90 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full text-base sm:text-lg font-semibold transition duration-300 inline-flex items-center">
                    Book Now
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Now Showing Section -->
    <section class="py-12 sm:py-20" id="now-showing">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold">Now Showing</h2>
                <a href="#" class="text-primary hover:text-primary/90 transition">View All</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                @php
                    $movies = [
                        ['title' => 'Oppenheimer', 'genre' => 'Biography', 'duration' => '3h 0m', 'image' => 'https://m.media-amazon.com/images/M/MV5BMDBmYTZjNjUtN2M1MS00MTQ2LTk2ODgtNzc2M2QyZGE5NTVjXkEyXkFqcGdeQXVyNzAwMjU2MTY@._V1_.jpg'],
                        ['title' => 'Barbie', 'genre' => 'Comedy', 'duration' => '1h 54m', 'image' => 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcROuK_Bl8jrLUP7fo3hsDC4XC2AC1WR1CAXS3G1SVqDPZE0pgFTQKnr8P2_cKmRuXg03nPE'],
                        ['title' => 'Mission: Impossible', 'genre' => 'Action', 'duration' => '2h 43m', 'image' => 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcS1KzgP3ubLzquySUERfhx0ZTs-v3IVwifHZnQQw5CwiSYfmSomi8pUUhEEzr0cw73Lgiz6'],
                        ['title' => 'Spider-Man: Across the Spider-Verse', 'genre' => 'Animation', 'duration' => '2h 28m', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDDvJ0zhGxVySz3RjLa35ukjpctxW41KzD3VQ56VzSEX2lB5WHZ0le10IjuI8ZJ9cd5CeZpA']
                    ];
                @endphp
                @foreach($movies as $movie)
                    <div class="group">
                        <div class="relative overflow-hidden rounded-lg">
                            <img src="{{ $movie['image'] }}"
                                 class="w-full h-[300px] sm:h-[400px] object-cover transform group-hover:scale-105 transition duration-300" alt="{{ $movie['title'] }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark/90 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <h3 class="text-lg sm:text-xl font-bold mb-2">{{ $movie['title'] }}</h3>
                                    <p class="text-gray-300 mb-4">{{ $movie['genre'] }} • {{ $movie['duration'] }}</p>
                                    <a href="#" class="bg-primary hover:bg-primary/90 text-white px-4 sm:px-6 py-2 rounded-full inline-block transition duration-300 text-sm sm:text-base">
                                        Book Tickets
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Coming Soon Section -->
    <section class="py-12 sm:py-20 bg-secondary">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold">Coming Soon</h2>
                <a href="#" class="text-primary hover:text-primary/90 transition">View All</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                @php
                    $upcoming = [
                        ['title' => 'Dune: Part Two', 'release' => 'March 1, 2024', 'image' => 'https://m.media-amazon.com/images/M/MV5BNTc0YmQxMjEtODI5MC00NjFiLTlkMWUtOGQ5NjFmYWUyZGJhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'],
                        ['title' => 'Deadpool 3', 'release' => 'July 26, 2024', 'image' => 'https://resizing.flixster.com/mPJp85eApHd8ih9XF5E9d3-2LbM=/ems.cHJkLWVtcy1hc3NldHMvbW92aWVzLzUxODlkZDE1LTQyYjUtNDg5ZS05NjZmLWMxZDk1YWZhN2E1ZC5qcGc='],
                        ['title' => 'Joker: Folie à Deux', 'release' => 'October 4, 2024', 'image' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQAAHXQO2orN4VL_aGhDbMvlfoDUsiQuMht8hPdieaUN9yl0FcLZwBhQwAcV4XbgbljcW9r'],
                        ['title' => 'Avatar 3', 'release' => 'December 19, 2024', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrZ_Mst1CTDeEBhbCvI9S7tg4xoa8f8h4loA&s']
                    ];
                @endphp
                @foreach($upcoming as $movie)
                    <div class="group">
                        <div class="relative overflow-hidden rounded-lg">
                            <img src="{{ $movie['image'] }}"
                                 class="w-full h-[300px] sm:h-[400px] object-cover transform group-hover:scale-105 transition duration-300" alt="{{ $movie['title'] }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark/90 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <h3 class="text-lg sm:text-xl font-bold mb-2">{{ $movie['title'] }}</h3>
                                    <p class="text-gray-300 mb-4">Release: {{ $movie['release'] }}</p>
                                    <a href="#" class="border-2 border-primary text-primary hover:bg-primary hover:text-white px-4 sm:px-6 py-2 rounded-full inline-block transition duration-300 text-sm sm:text-base">
                                        Notify Me
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-12 sm:py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 sm:mb-6">Stay Updated</h2>
                <p class="text-gray-300 mb-6 sm:mb-8">Subscribe to our newsletter for the latest movie updates and exclusive offers.</p>
                <form class="flex flex-col sm:flex-row gap-4 justify-center">
                    <input type="email" placeholder="Enter your email"
                           class="px-4 sm:px-6 py-3 rounded-full bg-secondary border border-gray-700 focus:outline-none focus:border-primary w-full sm:w-96">
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-6 sm:px-8 py-3 rounded-full font-semibold transition duration-300">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary py-8 sm:py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl sm:text-2xl font-bold text-primary mb-4">CineFlex</h3>
                    <p class="text-gray-400">Your premier destination for movie entertainment and convenient online ticket booking.</p>
                </div>
                <div>
                    <h4 class="text-base sm:text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-base sm:text-lg font-semibold mb-4">Connect With Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-primary transition text-lg sm:text-xl">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary transition text-lg sm:text-xl">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary transition text-lg sm:text-xl">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-6 sm:mt-8 pt-6 sm:pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} CineFlex. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                mobileMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html>

