<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('image/icon/icon.png') }}" type="image/x-icon">

    <title>PEMIRA - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Frijole&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        *{
            font-family: 'Roboto', sans-serif;  
        }
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            font-family: "Lalezar", sans-serif;
        }
        h2,h3 {
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
<body class="font-sans antialiased overflow-x-hidden">

<x-banner />

<div class="relative min-h-screen">
    @include('layouts.header')


    @if(session('success') || $errors->any())
    <!-- Modal Background -->
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 animate-fade-in">
        
        <!-- Modal Container -->
        <div class="relative bg-[#A61616] border-4 border-[#FF6C6C] rounded-2xl p-6 w-11/12 max-w-md text-white shadow-2xl animate-scale-in flex flex-col items-center">
            

            <!-- Icon Success or Error -->
            @if(session('success'))
            <h1>YEYY..!!!</h1>
            <!-- App Logo (40% of modal) -->
            <div class="w-full flex justify-center">
                <img src="{{ asset('image/assets/warning.png') }}" alt="App Logo" class="w-3/5 h-auto animate-pulse mb-4">
            </div>
                <h2 class="text-2xl font-bold mb-2 text-center">Terimakasih sudah ikut serta demokrasi ini ya!</h2>
            @elseif($errors->any())
            <h1>OOPS..!!!</h1>
            <!-- App Logo (40% of modal) -->
            <div class="w-full flex justify-center">
                <img src="{{ asset('image/assets/warning.png') }}" alt="App Logo" class="w-3/5 h-auto animate-pulse mb-4">
            </div>
                <h2 class="text-2xl font-bold mb-2">Error</h2>
                <ul class="list-disc text-left pl-6 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute top-3 right-3 text-white hover:text-gray-200 text-2xl">
                &times;
            </button>

        </div>
    </div>

    <!-- Script to close the modal -->
    <script>
        function closeModal() {
            document.querySelector('.fixed.inset-0').style.display = 'none';
        }
    </script>

    <!-- Tailwind Animations -->
    <style>
      @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
      }
      .animate-fade-in {
        animation: fade-in 0.3s ease-out forwards;
      }

      @keyframes scale-in {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
      }
      .animate-scale-in {
        animation: scale-in 0.3s ease-out forwards;
      }

      @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-5px); }
        40%, 80% { transform: translateX(5px); }
      }
      .animate-shake {
        animation: shake 0.5s ease;
      }
    </style>
@endif

    <div class="py-6 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex">
            <aside class="w-1/4 mr-4">
                <a href="{{ route('voting') }}" class="block bg-white border border-black rounded hover:bg-purple-100 p-2">
                    <div class="flex items-center">
                        <img src="{{ asset('image/icon/logo.png') }}" alt="App Logo" class="w-10 h-10 mr-3">
                        <span class="text-gray-600 font-semibold">Mau Vote Siapa?</span>
                    </div>
                </a>
                
                <ul class="bg-purple-100 p-2 rounded space-y-2">
                    
                    @foreach ($pemilu as $item)
                        <a href="{{ route('voting.show',$item->name) }}">
                            <li class="hover:bg-purple-300 cursor-pointer px-2 py-1 rounded">{{ $item->name }}</li>
                        </a>
                    @endforeach
                </ul>
            </aside>
            <main class="w-3/4 space-y-6">
                @yield('content')
            </main>            
        </div>
    </div>
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

@yield('script')
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
