<header id="main-header"
    class="sticky top-0 z-50 backdrop-blur-md bg-white/30 shadow-md flex flex-row items-center justify-between px-4 py-2">
    <div class="flex lg:justify-center items-center pl-1">
        <div class="flex lg:justify-center items-center pl-1">
            <img class="h-[60px]" src="{{ asset('image/icon/polindra.png') }}" alt="">
            <img class="h-[100px]" src="{{ asset('image/icon/icon.png') }}" alt="">
        </div>
        <div class="flex flex-col leading-none space-y-0">
            <h1 class="m-0">PEMIRA</h1>
            <h5 class="m-0">Politeknik Negeri Indramayu</h5>
        </div>
    </div>

    <div class="hidden gap-1 lg:flex flex-1 justify-center items-center">
        <a href="{{ route('dashboard') }}"
            class="permira-button px-4 py-2 border-b-2 transition duration-200
          {{ request()->is('dashboard') ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-700 hover:border-blue-400 hover:text-blue-500' }}">
            {{ __('Dashboard') }}
        </a>
        <a href="{{ route('voting') }}"
            class="permira-button px-4 py-2 border-b-2 transition duration-200
          {{ request()->is('voting') ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-700 hover:border-blue-400 hover:text-blue-500' }}">
            {{ __('Voting') }}
        </a>

        <a href="{{ route('hasil') }}"
            class="permira-button px-4 py-2 border-b-2 transition duration-200
          {{ request()->is('hasil') ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-700 hover:border-blue-400 hover:text-blue-500' }}">
            {{ __('Hasil') }}
        </a>

    </div>

    <a class="flex items-center gap-1" 
    @auth
    href="{{ route('profile') }}"
    @endauth
    >
        @auth
            <img src="{{ Auth::user()->avatar_url ?? asset('image/icon/user.png') }}" alt="User Avatar"
                class="h-10 w-10 rounded-full object-cover border border-gray-300">
            <span class="font-medium text-gray-700">{{ \Illuminate\Support\Str::limit(Auth::user()->name, 10) }}</span>
        @endauth

        @guest
            <div x-data="{ open: false }" class="relative inline-block text-left">
                <button @click="open = !open">
                    <img src="{{ Auth::user()->avatar_url ?? asset('image/icon/user.png') }}" alt="User Avatar"
                        class="h-10 w-10 rounded-full object-cover border border-gray-300">
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute z-10 mt-2 w-32 bg-white rounded-md shadow-lg">
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Register</a>
                </div>
            </div>
        @endguest
    </a>
</header>
