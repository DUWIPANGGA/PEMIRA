<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PEMIRA - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Frijole&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            font-family: "Lalezar", sans-serif;
        }
        h5 {
            font-size: 1rem;
            font-family: "Lalezar", sans-serif;
        }
        .permira-button {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 10%;
            margin: 0;
            border-radius: 2rem;
            border: 1px solid black;
        }
        .hero-text {
            font-family: "Frijole", system-ui;
        }
        #main-header {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="font-sans antialiased">

<x-banner />

<div class="relative min-h-screen">
    @if (isset($header))
        <header id="main-header" class="sticky top-0 z-50 backdrop-blur-md bg-white/30 shadow-md flex flex-row items-center justify-between px-4 py-2">
            <div class="flex lg:justify-center items-center pl-4">
                <div class="flex lg:justify-center items-center pl-4">
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
                   class="permira-button hover:bg-gray-700 hover:text-white transition duration-300 ease-in-out 
                          {{ request()->is('dashboard') ? 'bg-gray-800 text-white' : 'bg-transparent text-black' }}">
                    {{ __('Dashboard') }}
                </a>
                    <a href="{{ route('voting') }}" 
                       class="permira-button hover:bg-gray-700 hover:text-white transition duration-300 ease-in-out 
                              {{ request()->is('voting') ? 'bg-gray-800 text-white' : 'bg-transparent text-black' }}">
                        {{ __('Voting') }}
                    </a>
                    <a href="{{ route('hasil') }}" 
                       class="permira-button hover:bg-gray-700 hover:text-white transition duration-300 ease-in-out 
                              {{ request()->is('hasil') ? 'bg-gray-800 text-white' : 'bg-transparent text-black' }}">
                        {{ __('Hasil') }}
                    </a>                
            </div>

            <div class="flex items-center space-x-3 ml-auto">
                @auth
                    <img 
                        src="{{ Auth::user()->avatar_url ?? asset('image/icon/user.png') }}" 
                        alt="User Avatar" 
                        class="h-10 w-10 rounded-full object-cover border border-gray-300"
                    >
                    <span class="font-medium text-gray-700">{{ Auth::user()->name }}</span>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="permira-button">Login</a>
                    <a href="{{ route('register') }}" class="permira-button">Register</a>
                @endguest
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="overflow-x-hidden">
        {{ $slot }}
    </main>
</div>

<footer class="bg-red-600 text-white py-10 mt-12">
    <div class="max-w-6xl mx-auto flex flex-wrap justify-between gap-10">
  
        <!-- Logo & Deskripsi -->
        <div class="flex flex-col items-center text-center w-full sm:w-1/3">
            <div class="w-24 h-24 bg-white rounded-full flex justify-center items-center mb-6">
                <img src="{{ asset('image/icon/logo.png') }}" alt="Logo" class="w-16 h-auto">
            </div>
            <p class="max-w-md mx-auto text-lg leading-relaxed">
                <strong>Pemilihan Raya (Pemira)</strong> merupakan wujud demokrasi yang diterapkan di lingkungan kampus Politeknik Negeri Indramayu. Pemira adalah pesta demokrasi bagi mahasiswa dan mediasi yang tepat untuk mewujudkan regenerasi lembaga kampus. Dalam Pemira terdapat pemilihan Ketua serta Anggota Dewan Perwakilan Mahasiswa (DPM), Ketua dan Wakil Ketua Badan Eksekutif Mahasiswa (BEM), serta Ketua Tingkat I-IV.
            </p>
        </div>
  
        <!-- Kontak -->
        <div class="w-full sm:w-1/3 text-lg">
            <h3 class="text-xl font-semibold mb-6">Kontak</h3>
            <div class="flex items-center gap-4 mb-4">
                <span class="material-symbols-outlined">mail</span>
                <p>pemira@polindra.ac.id</p>
            </div>
            <div class="flex items-center gap-4 mb-4">
                <span class="material-symbols-outlined">call</span>
                <p>+62 812-3456-7890</p>
            </div>
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined">location_on</span>
                <p>Jl. Raya Indramayu No. 64, Indramayu, Jawa Barat 45282</p>
            </div>
        </div>
    </div>
  
    <div class="text-center text-sm mt-8">
        &copy; 2025 Pemira Politeknik Negeri Indramayu. Semua Hak Dilindungi.
    </div>
</footer>

@stack('modals')
@livewireScripts

<script>
    let lastScrollTop = 0;
    const header = document.getElementById("main-header");

    window.addEventListener("scroll", function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop+10) {
            // Scroll ke bawah
            header.style.transform = "translateY(-100%)";
        } else {
            // Scroll ke atas
            header.style.transform = "translateY(0)";
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Untuk Safari
    });
</script>

</body>
</html>
