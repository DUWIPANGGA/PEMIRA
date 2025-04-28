@extends('layouts.admin')
@section('title', 'Detail User')
@section('content')

    <div class="bg-white shadow-xl rounded-lg p-10 w-full border border-gray-200">
        <div class="text-center mb-8 border-4 border-gray-500 p-6 rounded-xl shadow-lg">
            <h1 class="text-4xl font-extrabold text-gray-800">{{ $user->name }}</h1>
            <p class="text-lg text-gray-600 mt-2">{{ $user->email }}</p>
        </div>

        <section class="mb-8 p-6 bg-gray-50 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4 border-b-2 border-gray-200 pb-2">Informasi User</h3>
            <div class="space-y-4">
                <div>
                    <h4 class="text-gray-700 font-semibold mb-1">Nama Lengkap</h4>
                    <p class="text-gray-600">{{ $user->name }}</p>
                </div>
                <div>
                    <h4 class="text-gray-700 font-semibold mb-1">Email</h4>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
                <div>
                    <h4 class="text-gray-700 font-semibold mb-1">Role</h4>
                    <p class="text-gray-600">{{ $user->role ?? '-' }}</p>
                </div>
                <div>
                    <h4 class="text-gray-700 font-semibold mb-1">Tanggal Registrasi</h4>
                    <p class="text-gray-600">{{ $user->created_at->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
        </section>

        <div class="flex flex-col md:flex-row justify-center items-center gap-10 mt-10">
            <div class="text-center">
                <img src="{{ $user->profile_photo_path 
                            ? asset('storage/profile/' . $user->profile_photo_path)
                            : asset('image/icon/user.png') }}"
                     alt="Foto Profil"
                     class="w-40 h-40 object-cover rounded-full border shadow mb-4">
                <h4 class="text-gray-800 font-bold text-lg">{{ $user->name }}</h4>
            </div>
        </div>

        <div class="flex justify-between items-center pt-6 border-t mt-8">
            <a href="{{ route('users.index') }}" class="text-blue-600 font-semibold hover:underline">
                ← Kembali ke Daftar User
            </a>
            <a href="{{ route('users.edit', $user->id) }}"
                class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                ✏️ Edit User
            </a>
        </div>
    </div>

@endsection
