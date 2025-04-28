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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            font-family: "Lalezar", sans-serif;
        }

        h2,
        h3 {
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
        @if ($errors->any())
            <div id="myModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white w-1/3 rounded-lg p-6 shadow-lg">
                    <h2 class="text-lg font-bold mb-4 text-red-600">Terjadi Kesalahan</h2>

                    <ul class="list-disc list-inside text-sm text-red-500 mb-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button onclick="document.getElementById('myModal').classList.add('hidden')"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition">Tutup</button>
                </div>
            </div>
        @endif

        @include('layouts.header')


        <!-- Page Content -->
        <main class="overflow-x-hidden">
            <div class="bg-white min-h-screen" style="background-image: url('{{ asset('image/background/polindra.png') }}'); background-size: cover;">
                <div class="flex flex-col justify-center items-center min-h-screen px-4 sm:px-6 lg:px-8">
                    <!-- Logo Section -->
                    
                    <div class="w-full max-w-7xl">
                        
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
        
        
    </div>  

    <footer class="bg-red-600 text-white py-10 ">
        <div class="max-w-6xl mx-auto flex flex-wrap justify-between gap-10">

            <!-- Logo & Deskripsi -->
            <div class="flex flex-col items-center text-center w-full sm:w-1/3">
                <div class="w-24 h-24 bg-white rounded-full flex justify-center items-center mb-6">
                    <img src="{{ asset('image/icon/logo.png') }}" alt="Logo" class="w-16 h-auto">
                </div>
                <p class="max-w-md mx-auto text-lg leading-relaxed">
                    <strong>Pemilihan Raya (Pemira)</strong> merupakan wujud demokrasi yang diterapkan di lingkungan
                    kampus Politeknik Negeri Indramayu. Pemira adalah pesta demokrasi bagi mahasiswa dan mediasi yang
                    tepat untuk mewujudkan regenerasi lembaga kampus. Dalam Pemira terdapat pemilihan Ketua serta
                    Anggota Dewan Perwakilan Mahasiswa (DPM), Ketua dan Wakil Ketua Badan Eksekutif Mahasiswa (BEM),
                    serta Ketua Tingkat I-IV.
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

            if (scrollTop > lastScrollTop + 10) {
                // Scroll ke bawah
                header.style.transform = "translateY(-100%)";
            } else {
                // Scroll ke atas
                header.style.transform = "translateY(0)";
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Untuk Safari
        });
    </script>
    @yield('script')
</body>

</html>
