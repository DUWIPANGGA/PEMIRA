
<header id="main-header"
    style="transition: transform 0.4s ease;"
    class="sticky top-0 z-50 backdrop-blur-md bg-white/30 shadow-md flex flex-row items-center px-4 py-2 gap-3">
    
    <!-- Logo dan Judul -->
    <div class="flex items-center w-[30%] min-w-[250px]">
        <img class="h-[60px] mr-2" src="{{ asset('image/icon/polindra.png') }}" alt="">
        <img class="h-[100px] mr-4" src="{{ asset('image/icon/icon.png') }}" alt="">
        <div class="flex flex-col leading-none space-y-0">
            <h1 class="m-0">PEMIRA</h1>
            <h5 class="m-0">Politeknik Negeri Indramayu</h5>
        </div>
    </div>

    <!-- Link Navigasi -->
    <div id="nav" class="hidden lg:flex flex-1 justify-end ml-[auto] mr-4 w-[10%]">
        <a href="{{ route('home') }}"
            class="px-4 py-2 border-b-2 transition duration-200 text-lg font-bold {{ request()->is('/') ? 'active' : 'inactive' }}">
            {{ __('Home') }}
        </a>
        <a href="{{ route('dashboard') }}"
            class="px-4 py-2 border-b-2 transition duration-200 text-lg font-bold {{ request()->is('dashboard') ? 'active' : 'inactive' }}">
            {{ __('Dashboard') }}
        </a>
        <a href="{{ route('voting') }}"
            class="px-4 py-2 border-b-2 transition duration-200 text-lg font-bold {{ request()->is('vote') ? 'active' : 'inactive' }}">
            {{ __('Vote') }}
        </a>
        <a href="{{ route('hasil') }}"
            class="px-4 py-2 border-b-2 transition duration-200 text-lg font-bold {{ request()->is('hasil') ? 'active' : 'inactive' }}">
            {{ __('Hasil') }}
        </a>
    </div>
    

    <!-- Profile -->
    <div class="flex items-center justify-end w-[20%] mr-5 ml-6">
        @auth
            <a href="{{ route('profile') }}" class="flex items-center gap-2">
                <img src="{{ Auth::user()->avatar_url ?? asset('image/icon/user.png') }}"
                    alt="User Avatar"
                    class="h-10 w-10 rounded-full object-cover border border-gray-300">
                <span class="font-medium text-gray-700">{{ \Illuminate\Support\Str::limit(Auth::user()->name, 10) }}</span>
            </a>
        @endauth

        @guest
            <div x-data="{ open: false }" class="relative inline-block text-left">
                <button @click="open = !open">
                    <img src="{{ asset('image/icon/user.png') }}"
                        alt="User Avatar"
                        class="h-10 w-10 rounded-full object-cover border border-gray-300">
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute z-10 mt-2 w-32 bg-white rounded-md shadow-lg rignt-1">
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Register</a>
                </div>
            </div>
        @endguest
    </div>
</header>
