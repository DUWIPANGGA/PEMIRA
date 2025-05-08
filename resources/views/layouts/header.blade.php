<header id="main-header" class="sticky top-0 z-50 backdrop-blur-md bg-white/80 shadow-md transition-transform duration-400 ease-in-out">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">
            <!-- Logo and Title -->
            <div class="flex-shrink-0 flex items-center">
                <div class="flex items-center">
                    <img class="h-10 md:h-12 mr-2" src="{{ asset('image/icon/polindra.png') }}" alt="Polindra Logo">
                    <img class="h-12 md:h-16 mr-3" src="{{ asset('image/icon/icon.png') }}" alt="Pemira Logo">
                    <div class="flex flex-col leading-tight">
                        <h1 class="text-xl md:text-2xl font-bold text-gray-800">PEMIRA</h1>
                        <h5 class="text-xs md:text-sm text-gray-600">Politeknik Negeri Indramayu</h5>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button (Only visible on mobile) -->
            <div id="mobile" class="flex items-center lg:hidden">
                <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-red-600 focus:outline-none">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Desktop Navigation (Hidden on mobile) -->
            <nav class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="px-4 py-2 mx-1 text-lg font-medium transition-colors duration-200 border-b-2 {{ request()->is('/') ? 'border-red-600 text-red-600' : 'border-transparent text-gray-700 hover:text-red-600 hover:border-red-400' }}">
                    {{ __('Home') }}
                </a>
                <a href="{{ route('dashboard') }}" class="px-4 py-2 mx-1 text-lg font-medium transition-colors duration-200 border-b-2 {{ request()->is('dashboard') ? 'border-red-600 text-red-600' : 'border-transparent text-gray-700 hover:text-red-600 hover:border-red-400' }}">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('voting') }}" class="px-4 py-2 mx-1 text-lg font-medium transition-colors duration-200 border-b-2 {{ request()->is('vote') ? 'border-red-600 text-red-600' : 'border-transparent text-gray-700 hover:text-red-600 hover:border-red-400' }}">
                    {{ __('Vote') }}
                </a>
                <a href="{{ route('hasil.index') }}" class="px-4 py-2 mx-1 text-lg font-medium transition-colors duration-200 border-b-2 {{ request()->is('hasil') ? 'border-red-600 text-red-600' : 'border-transparent text-gray-700 hover:text-red-600 hover:border-red-400' }}">
                    {{ __('Hasil') }}
                </a>
            </nav>

            <!-- Profile Section -->
            <div class="flex items-center ml-4">
                @auth
                    <a href="{{ route('profile') }}" class="flex items-center space-x-2 group">
                        <div class="relative">
                            <img src="{{ Auth::user()->avatar_url ?? asset('image/icon/user.png') }}"
                                 alt="User Avatar"
                                 class="h-9 w-9 md:h-10 md:w-10 rounded-full object-cover border-2 border-gray-200 group-hover:border-red-400 transition-colors duration-200">
                        </div>
                        <span class="hidden md:inline font-medium text-gray-700 group-hover:text-red-600 transition-colors duration-200">
                            {{ \Illuminate\Support\Str::limit(Auth::user()->name, 10) }}
                        </span>
                    </a>
                @endauth

                @guest
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none">
                            <img src="{{ asset('image/icon/user.png') }}"
                                 alt="User Avatar"
                                 class="h-9 w-9 md:h-10 md:w-10 rounded-full object-cover border-2 border-gray-200 hover:border-red-400 transition-colors duration-200">
                            <svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
                            <div class="py-1">
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">Login</a>
                                <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">Register</a>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="lg:hidden hidden bg-white shadow-lg">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->is('/') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }}">
                {{ __('Home') }}
            </a>
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->is('dashboard') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }}">
                {{ __('Dashboard') }}
            </a>
            <a href="{{ route('voting') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->is('vote') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }}">
                {{ __('Vote') }}
            </a>
            <a href="{{ route('hasil.index') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->is('hasil') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }}">
                {{ __('Hasil') }}
            </a>
        </div>
    </div>
</header>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // Hide header on scroll down
    let lastScrollTop = 0;
    const header = document.getElementById('main-header');
    const headerHeight = header.offsetHeight;

    window.addEventListener('scroll', function () {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop && scrollTop > headerHeight) {
            // Scroll down
            header.style.transform = 'translateY(-100%)';
        } else {
            // Scroll up
            header.style.transform = 'translateY(0)';
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
</script>
