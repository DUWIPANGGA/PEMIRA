@extends('layouts.admin')
@section('title', 'Edit User')
@section('content')
<div class="bg-white shadow-xl rounded-lg p-10 w-full border border-gray-200 max-w-3xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col leading-none space-y-0 justify-center items-center mb-9">
        <h1 class="m-0">Formulir User</h1>
        <h5 class="m-0">Edit user: <strong>{{ $user->name }}</strong></h5>
    </div>

    <!-- Form -->
    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6 w-full px-4 py-2">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
        </div>

        <!-- NIM -->
        <div>
            <label for="NIM" class="block text-sm font-semibold text-gray-700 mb-1">NIM</label>
            <input type="text" id="NIM" name="NIM" value="{{ old('NIM', $user->NIM) }}"
                class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
        </div>

        <!-- Nomor HP -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">Nomor HP</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
        </div>

        <!-- Prodi -->
        <div>
            <label for="prodi" class="block text-sm font-semibold text-gray-700 mb-1">Program Studi</label>
            <input type="text" id="prodi" name="prodi" value="{{ old('prodi', $user->prodi) }}"
                class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">Role</label>
            <select id="role" name="role"
                class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <!-- Tombol Submit -->
        <div>
            <button type="submit"
                class="w-full text-white font-semibold py-3 px-6 rounded-xl shadow-md transition-all duration-300"
                style="background: linear-gradient(to right, #6366F1, #3B82F6);">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection
