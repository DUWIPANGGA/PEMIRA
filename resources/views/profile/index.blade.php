<!-- resources/views/profile/show.blade.php -->
@section('title', 'profile settings')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Profile Picture --}}
            <div class="flex flex-col items-center mb-10">
                <div class="w-32 h-32 rounded-full overflow-hidden shadow-lg border-4 border-red-600">
                    <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('image/icon/user.png') }}"
                        alt="Profile Photo" class="object-cover w-full h-full">
                </div>

                {{-- Informasi User --}}
                <div class="mt-4 text-center">
                    <h3 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h3>

                    <div class="mt-2 text-gray-600 space-y-1">
                        <div><span class="font-semibold text-red-600">NIM:</span> {{ Auth::user()->nim ?? '-' }}</div>
                        <div><span class="font-semibold text-red-600">Prodi:</span> {{ Auth::user()->prodi ?? '-' }}</div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->role == 'admin')
                {{-- Admin Panel --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-10 border-2 border-red-900">
                    <div class="p-6 text-white">
                        <h4 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <span class="material-symbols-outlined text-3xl text-white bg-red-600 p-2 rounded-full">admin_panel_settings</span>
                            <span class="text-black">Admin Dashboard</span>
                        </h4>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            {{-- Pemilu --}}
                            <a href="{{ route('pemilu.index') }}" 
                               class="bg-red-600/90 hover:bg-red-500 border border-red-700 rounded-xl p-4 transition-all duration-300 transform hover:scale-[1.02] flex flex-col items-center justify-center h-full group">
                                <div class="bg-white/20 p-3 rounded-full mb-3 group-hover:bg-white/30 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 17v-2a4 4 0 018 0v2M7 10h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                    <span class="font-semibold text-center text-white group-hover:text-white">Manajemen Pemilu</span>
                            </a>

                            {{-- Kandidat --}}
                            <a href="#" 
                               class="bg-red-600/90 hover:bg-red-500 border border-red-700 rounded-xl p-4 transition-all duration-300 transform hover:scale-[1.02] flex flex-col items-center justify-center h-full group">
                                <div class="bg-white/20 p-3 rounded-full mb-3 group-hover:bg-white/30 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M5.121 17.804A2.25 2.25 0 007.197 19.5H16.8a2.25 2.25 0 002.076-1.696l1.61-6.438a1.5 1.5 0 00-1.45-1.866H6.964a1.5 1.5 0 00-1.45 1.866l1.607 6.438z" />
                                    </svg>
                                </div>
                                <span class="font-semibold text-center text-white/90 group-hover:text-white">Manajemen Kandidat</span>
                            </a>

                            {{-- Pengguna --}}
                            <a href="{{ route('users.index') }}" 
                               class="bg-red-600/90 hover:bg-red-500 border border-red-700 rounded-xl p-4 transition-all duration-300 transform hover:scale-[1.02] flex flex-col items-center justify-center h-full group">
                                <div class="bg-white/20 p-3 rounded-full mb-3 group-hover:bg-white/30 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M4 20h5v-2a4 4 0 00-3-3.87M9 4a3 3 0 100 6 3 3 0 000-6zm6 0a3 3 0 100 6 3 3 0 000-6z" />
                                    </svg>
                                </div>
                                <span class="font-semibold text-center text-white/90 group-hover:text-white">Manajemen Pengguna</span>
                            </a>

                            {{-- Hasil Suara --}}
                            <a href="#" 
                               class="bg-red-600/90 hover:bg-red-500 border border-red-700 rounded-xl p-4 transition-all duration-300 transform hover:scale-[1.02] flex flex-col items-center justify-center h-full group">
                                <div class="bg-white/20 p-3 rounded-full mb-3 group-hover:bg-white/30 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M11 17a1 1 0 102 0v-6a1 1 0 10-2 0v6zm1-14a9 9 0 100 18 9 9 0 000-18z" />
                                    </svg>
                                </div>
                                <span class="font-semibold text-center text-white/90 group-hover:text-white">Hasil Pemilihan</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Update Profile Information --}}
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                    @livewire('profile.update-profile-information-form')
                </div>
            @endif

            {{-- Update Password --}}
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-6 bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                    @livewire('profile.update-password-form')
                </div>
            @endif

            {{-- Two Factor Authentication --}}
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-6 bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            @endif

            {{-- Logout Other Browser Sessions --}}
            <div class="mt-6 bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            {{-- Delete Account --}}
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="mt-6 bg-red-50 rounded-xl shadow-md border border-red-100 overflow-hidden">
                    @livewire('profile.delete-user-form')
                </div>
            @endif

        </div>
    </div>
</x-app-layout>