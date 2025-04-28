@extends('layouts.admin')
@section('title', 'buat pemilu')
@section( 'content')
<div class="bg-white shadow-xl rounded-lg p-10 w-full border border-gray-200 max-w-3xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col leading-none space-y-0 justify-center items-center mb-9">
        <h1 class="m-0">Formulir PEMILU</h1>
        <h5 class="m-0">Buat pemilu baru</h5>
    </div>


    <!-- Form -->
    <form action="{{ route('pemilu.store') }}" method="POST" class="space-y-6 w-full px-4 py-2">
        @method('POST')
        @csrf
        <!-- Nama -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama
                Pemilu</label>
            <input type="text" id="name" name="name" placeholder="Contoh: Pemilu Ketua BEM"
                class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="description"
                class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
            <textarea id="description" name="description" rows="4" placeholder="Deskripsikan pemilu ini..."
                class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"></textarea>
        </div>

        <!-- Tanggal Mulai -->
        <div>
            <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal
                Mulai</label>
            <input type="date" id="start_date" name="start_date"
                class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
        </div>

        <!-- Tanggal Selesai -->
        <div>
            <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal
                Selesai</label>
            <input type="date" id="end_date" name="end_date"
                class="w-full px-5 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
        </div>

        <div>
            <button type="submit"
                class="w-full text-white font-semibold py-3 px-6 rounded-xl shadow-md transition-all duration-300"
                style="background: linear-gradient(to right, #6366F1, #3B82F6);">
                Simpan Pemilu
            </button>
        </div>

    </form>
</div>
@endsection