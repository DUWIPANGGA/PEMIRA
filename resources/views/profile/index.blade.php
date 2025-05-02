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
                    <img 
                        src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('image/icon/user.png') }}" 
                        alt="Profile Photo" 
                        class="object-cover w-full h-full"
                    >
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
