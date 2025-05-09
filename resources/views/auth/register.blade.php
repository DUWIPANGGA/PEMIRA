@extends('layouts.auth')
@section('title','register')
@section('content')

<div class="max-w-md mx-auto mt-10 bg-white shadow-md rounded-lg p-8">
    <div class="mb-6 flex items-center gap-4 justify-center">
        <img src="{{ asset('image/icon/icon.png') }}" alt="App Logo" class="w-32 h-auto">
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-200" />
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-200" />
        </div>

        <div class="mb-4">
            <label for="NIM" class="block text-sm font-medium text-gray-700">NIM</label>
            <input id="NIM" name="NIM" type="text" value="{{ old('NIM') }}" required autocomplete="NIM"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-200" />
        </div>

        <div class="mb-4">
            <label for="prodi" class="block text-sm font-medium text-gray-700">Program Studi</label>
            <select id="prodi" name="prodi" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-200">
                <option value="Teknologi Rekayasa Elektro-Medis (TREM)">Teknologi Rekayasa Elektro-Medis (TREM)</option>
                <option value="Teknologi Rekayasa Komputer (TRK)">Teknologi Rekayasa Komputer (TRK)</option>
                <option value="Teknologi Rekayasa Instrumentasi dan Kontrol (TRIK)">Teknologi Rekayasa Instrumentasi dan Kontrol (TRIK)</option>
                <option value="Sistem Informasi Kota Cerdas (SIKC)">Sistem Informasi Kota Cerdas (SIKC)</option>
                <option value="Rekayasa Perangkat Lunak (RPL)">Rekayasa Perangkat Lunak (RPL)</option>
                <option value="Perancangan Manufaktur (PM)">Perancangan Manufaktur (PM)</option>
                <option value="Teknik Pendingin dan Tata Udara">Teknik Pendingin dan Tata Udara (TPTU)</option>
                <option value="Teknik Informatika (TI)">Teknik Informatika (TI)</option>
                <option value="Teknik Mesin (TM)">Teknik Mesin (TM)</option>
                <option value="Keperawatan">Keperawatan</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" name="password" type="password" required autocomplete="new-password"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-200" />
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-200" />
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="terms" id="terms" required class="mr-2">
                    <span class="text-sm text-gray-600">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </span>
                </label>
            </div>
        @endif

        <div class="flex items-center justify-between">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 underline hover:text-gray-900">Already registered?</a>
            <button type="submit"
                class="ml-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-200">
                Register
            </button>
        </div>
    </form>
</div>

@endsection