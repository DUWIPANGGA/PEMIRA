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
                <div class="w-32 h-32 rounded-full overflow-hidden shadow-lg">
                    <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('image/icon/user.png') }}"
                        alt="Profile Photo" class="object-cover w-full h-full">
                </div>

                {{-- Informasi User --}}
                <div class="mt-4 text-center">
                    <h3 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h3>

                    <div class="mt-2 text-gray-600 space-y-1">
                        <div><span class="font-semibold">NIM:</span> {{ Auth::user()->nim ?? '-' }}</div>
                        <div><span class="font-semibold">Prodi:</span> {{ Auth::user()->prodi ?? '-' }}</div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role == 'admin')
    <div class="mt-10 w-full max-w-md mx-auto bg-white border rounded-2xl shadow-lg p-6 mb-4">
        <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            Admin Panel
        </h4>

        <div class="flex justify-between items-center gap-3">
            <a href="{{ route('pemilu.index') }}"
                class="flex justify-center items-center w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl transition">
                <!-- Icon Pemilu -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2a4 4 0 018 0v2M7 10h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </a>

            <a href="#"
                class="flex justify-center items-center w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl transition">
                <!-- Icon Kandidat -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A2.25 2.25 0 007.197 19.5H16.8a2.25 2.25 0 002.076-1.696l1.61-6.438a1.5 1.5 0 00-1.45-1.866H6.964a1.5 1.5 0 00-1.45 1.866l1.607 6.438z" />
                </svg>
            </a>

            <a href="{{ route('users.index') }}"
                class="flex justify-center items-center w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl transition">
                <!-- Icon Pengguna -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M4 20h5v-2a4 4 0 00-3-3.87M9 4a3 3 0 100 6 3 3 0 000-6zm6 0a3 3 0 100 6 3 3 0 000-6z" />
                </svg>
            </a>

            <a href="#"
                class="flex justify-center items-center w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl transition">
                <!-- Icon Hasil Suara -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 17a1 1 0 102 0v-6a1 1 0 10-2 0v6zm1-14a9 9 0 100 18 9 9 0 000-18z" />
                </svg>
            </a>
        </div>
    </div>
@endif


            {{-- Update Profile Information --}}
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
            @endif

            {{-- Update Password --}}
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>
            @endif

            {{-- Two Factor Authentication --}}
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            @endif

            {{-- Logout Other Browser Sessions --}}
            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            {{-- Delete Account --}}
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
