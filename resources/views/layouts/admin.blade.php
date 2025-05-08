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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        :root {
            --primary: #7E22CE;
            --primary-dark: #6B21A8;
            --secondary: #DC2626;
            --light: #FAF5FF;
            --dark: #1F2937;
            --gray: #6B7280;
        }

        * {
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: #f9fafb;
            color: var(--dark);
            line-height: 1.6;
        }

        /* Mobile Sidebar Styles */
        .sidebar-mobile {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            transition: all 0.3s ease;
            opacity: 0;
            pointer-events: none;
        }

        .sidebar-mobile.active {
            opacity: 1;
            pointer-events: auto;
        }

        .sidebar-content {
            width: 280px;
            height: 100%;
            background: white;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-mobile.active .sidebar-content {
            transform: translateX(0);
        }

        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--primary);
            padding: 0.5rem;
            margin-right: 1rem;
        }

        /* Desktop Sidebar Styles */
        .sidebar-desktop {
            width: 280px;
            background: linear-gradient(to bottom, var(--primary), var(--primary-dark));
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            height: fit-content;
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .sidebar-desktop {
                display: none;
            }

            .hamburger-btn {
                display: block;
            }

            .main-content {
                width: 100% !important;
            }
        }

        /* Rest of your existing styles... */
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            font-family: "Lalezar", sans-serif;
            color: var(--primary);
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        h2, h3 {
            font-weight: bold;
            font-family: "Lalezar", sans-serif;
            color: var(--primary);
        }

        h5 {
            font-size: 1rem;
            font-family: "Lalezar", sans-serif;
            color: var(--primary);
        }

        .permira-button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 0.75rem 2rem;
            border-radius: 2rem;
            background: var(--primary);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .permira-button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .hero-text {
            font-family: "Frijole", system-ui;
            color: var(--secondary);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        #main-header {
            transition: transform 0.3s ease-in-out;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        #nav a.active {
            border-bottom: 3px solid var(--secondary);
            color: var(--secondary);
            font-weight: 500;
        }

        #nav a.inactive {
            color: var(--gray);
            transition: all 0.3s ease;
        }

        #nav a.inactive:hover {
            color: var(--secondary);
        }

        .sidebar-desktop {
            width: 280px;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            height: fit-content;
            border: 1px solid #e5e7eb;
        }

        .sidebar-desktop ul {
            background: white;
            border-radius: 0.5rem;
            padding: 0.5rem;
        }

        .sidebar-desktop li {
            transition: all 0.3s ease;
            border-radius: 0.25rem;
            margin-bottom: 0.25rem;
        }

        .sidebar-desktop a {
            display: block;
            padding: 0.75rem 1rem;
            color: #4b5563;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }

        .sidebar-desktop a:hover {
            background-color: #f9fafb;
            color: #dc2626; /* Red color */
            border-left-color: #dc2626;
        }

        .sidebar-desktop .material-symbols-outlined {
            margin-right: 0.75rem;
            color: #9ca3af;
        }

        .sidebar-desktop a:hover .material-symbols-outlined {
            color: #dc2626;
        }

        /* Mobile Sidebar */
        .sidebar-mobile .sidebar-content {
            background: white;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar-mobile ul {
            padding: 0.5rem;
        }

        .sidebar-mobile li {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .sidebar-mobile a {
            display: flex;
            align-items: center;
            color: #4b5563;
            font-weight: 500;
        }

        .sidebar-mobile a:hover {
            color: #dc2626;
        }

        .sidebar-mobile .material-symbols-outlined {
            margin-right: 0.75rem;
        }

        /* Close button */
        .close-sidebar {
            padding: 1rem;
            display: flex;
            justify-content: flex-end;
            border-bottom: 1px solid #f3f4f6;
        }

        #closeSidebar {
            color: #6b7280;
            cursor: pointer;
        }

        #closeSidebar:hover {
            color: #dc2626;
        }

        .main-content {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        footer {
            background: linear-gradient(to right, var(--secondary), #B91C1C);
            padding: 3rem 0;
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
        }

        footer .logo-container {
            transition: all 0.3s ease;
        }

        footer .logo-container:hover {
            transform: scale(1.05);
        }

        #myModal {
            z-index: 1000;
        }

        #myModal div {
            animation: fadeInUp 0.3s;
            border-radius: 0.5rem;
            border-top: 4px solid var(--secondary);
        }

        .close-sidebar {
            display: flex;
            justify-content: flex-end;
            padding: 1rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--primary);
        }
    </style>
</head>

<body class="font-sans antialiased overflow-x-hidden bg-gray-50">

    <x-banner />
    <div class="relative min-h-screen">
        @if ($errors->any())
            <div id="myModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white w-full max-w-md rounded-lg p-6 shadow-xl">
                    <h2 class="text-xl font-bold mb-4 text-red-600 flex items-center gap-2">
                        <span class="material-symbols-outlined">error</span>
                        Terjadi Kesalahan
                    </h2>

                    <ul class="list-disc list-inside text-red-500 mb-4 space-y-2">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>

                    <div class="flex justify-end">
                        <button onclick="document.getElementById('myModal').classList.add('hidden')"
                            class="permira-button bg-red-500 hover:bg-red-600">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @include('layouts.header')

        
                        
        <!-- Mobile Sidebar -->
        <div class="sidebar-mobile" id="mobileSidebar">
            <div class="sidebar-content">
                <div class="close-sidebar">
                    <span class="material-symbols-outlined" id="closeSidebar">close</span>
                </div>
                <ul>
                    <li>
                        <a href="{{ route('pemilu.index') }}">
                            <span class="material-symbols-outlined">how_to_vote</span>
                            Pemilu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}">
                            <span class="material-symbols-outlined">group</span>
                            User
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Page Content -->
        <main class="overflow-x-hidden w-full pt-0">
            <div class="py-10 min-h-screen">
                <div class="max-w-7xl w-full mx-auto flex flex-wrap gap-6 px-4 sm:px-6 lg:px-8">
                    <!-- Desktop Sidebar -->
                    <aside class="sidebar-desktop">
                        <ul class="space-y-2">
                            <a href="{{ route('pemilu.index') }}">
                                <li class="hover:bg-purple-300 cursor-pointer px-3 py-2 rounded transition flex items-center gap-2">
                                    <span class="material-symbols-outlined">how_to_vote</span>
                                    Pemilu
                                </li>
                            </a>
                            <a href="{{ route('users.index') }}">
                                <li class="hover:bg-purple-300 cursor-pointer px-3 py-2 rounded transition flex items-center gap-2">
                                    <span class="material-symbols-outlined">group</span>
                                    User
                                </li>
                            </a>
                        </ul>
                    </aside>
                    
                    <!-- Main Content -->
                    <main class="flex-1 animate__animated animate__fadeIn">
                        <!-- Hamburger Button (Mobile Only) -->
                        <button class="hamburger-btn mb-4 lg:hidden" id="hamburgerBtn">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        
                        @yield('content')
                    </main>
                </div>
            </div>
        </main>
    </div>

    <footer class="text-white py-10 mt-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-between gap-10">

            <!-- Logo & Description -->
            <div class="flex flex-col items-center text-center w-full sm:w-1/3">
                <div class="logo-container w-24 h-24 bg-white rounded-full flex justify-center items-center mb-6 shadow-lg animate-float">
                    <img src="{{ asset('image/icon/logo.png') }}" alt="Logo" class="w-16 h-auto">
                </div>
                <p class="max-w-md mx-auto text-lg leading-relaxed text-white/90">
                    <strong class="text-white">Pemilihan Raya (Pemira)</strong> merupakan wujud demokrasi yang diterapkan di lingkungan
                    kampus Politeknik Negeri Indramayu. Pemira adalah pesta demokrasi bagi mahasiswa dan mediasi yang
                    tepat untuk mewujudkan regenerasi lembaga kampus.
                </p>
            </div>

            <!-- Contact -->
            <div class="w-full sm:w-1/3 text-lg">
                <h3 class="text-xl font-semibold mb-6 text-white flex items-center gap-2">
                    <span class="material-symbols-outlined">contact_support</span>
                    Kontak
                </h3>
                <div class="flex items-center gap-4 mb-4 text-white/90 hover:text-white transition">
                    <span class="material-symbols-outlined text-white">mail</span>
                    <p>pemira@polindra.ac.id</p>
                </div>
                <div class="flex items-center gap-4 mb-4 text-white/90 hover:text-white transition">
                    <span class="material-symbols-outlined text-white">call</span>
                    <p>+62 812-3456-7890</p>
                </div>
                <div class="flex items-center gap-4 text-white/90 hover:text-white transition">
                    <span class="material-symbols-outlined text-white">location_on</span>
                    <p>Jl. Raya Indramayu No. 64, Indramayu, Jawa Barat 45282</p>
                </div>
            </div>
        </div>

        <div class="text-center text-sm mt-8 text-white/80">
            &copy; 2025 Pemira Politeknik Negeri Indramayu. Semua Hak Dilindungi.
        </div>
    </footer>

    @stack('modals')
    @livewireScripts
    <script>
        // Mobile sidebar functionality
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const closeSidebar = document.getElementById('closeSidebar');
        const mobileSidebar = document.getElementById('mobileSidebar');

        hamburgerBtn.addEventListener('click', () => {
            mobileSidebar.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closeSidebar.addEventListener('click', () => {
            mobileSidebar.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        mobileSidebar.addEventListener('click', (e) => {
            if (e.target === mobileSidebar) {
                mobileSidebar.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });

        // Enhanced header scroll effect
        let lastScrollTop = 0;
        const header = document.getElementById("main-header");
        const headerHeight = header.offsetHeight;
        
        window.addEventListener("scroll", function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop && scrollTop > headerHeight) {
                // Scroll down
                header.style.transform = "translateY(-100%)";
                header.style.boxShadow = "none";
            } else {
                // Scroll up
                header.style.transform = "translateY(0)";
                header.style.boxShadow = "0 2px 10px rgba(0, 0, 0, 0.1)";
            }
            
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, { passive: true });

        // Add animation to elements when they come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__fadeInUp');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('main.main-content > *').forEach(el => {
            observer.observe(el);
        });
    </script>
    
    @yield('script')
</body>

</html>