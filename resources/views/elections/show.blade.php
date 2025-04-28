@extends('layouts.admin')
@section('title', 'buat pemilu')
@section('content')

    <div class="bg-white shadow-xl rounded-lg p-10 w-full border border-gray-200">
        <!-- Header -->
        <div class="text-center mb-8 border-4 border-gray-500 p-6 rounded-xl shadow-lg">
            <h1 class="text-4xl font-extrabold text-gray-800">{{ $pemilu->name }}</h1>
            <p class="text-lg text-gray-600 mt-2">
                {{ \Carbon\Carbon::parse($pemilu->start_date)->format('d M Y') }} - 
                {{ \Carbon\Carbon::parse($pemilu->end_date)->format('d M Y') }}
            </p>
        </div>
        
        
        <!-- Deskripsi -->
        <section class="mb-8 p-6 bg-gray-50 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4 border-b-2 border-gray-200 pb-2">Deskripsi</h3>
            <p class="text-gray-600 leading-relaxed">{{ $pemilu->description }}</p>
        </section>
        
        <!-- Informasi Waktu -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-gray-50 rounded-lg p-4 shadow-md hover:shadow-xl transition duration-200">
                <h4 class="text-gray-700 font-semibold mb-1">Tanggal Mulai</h4>
                <p class="text-gray-500">{{ \Carbon\Carbon::parse($pemilu->start_date)->translatedFormat('l, d F Y') }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 shadow-md hover:shadow-xl transition duration-200">
                <h4 class="text-gray-700 font-semibold mb-1">Tanggal Selesai</h4>
                <p class="text-gray-500">{{ \Carbon\Carbon::parse($pemilu->end_date)->translatedFormat('l, d F Y') }}</p>
            </div>
        </section>
        

        <!-- Daftar Calon -->
        <section class="mb-10">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Daftar Calon</h3>

                <a href="{{ route('candidate.create', ['id' => $pemilu->id]) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-500 text-white font-semibold hover:bg-green-600 transition">
                    ➕ Tambah Calon
                </a>
            </div>

            @if ($pemilu->candidates && $pemilu->candidates->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6">
                @foreach ($pemilu->candidates as $team)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                        <div class="relative p-4">
                            <a href="{{ route('candidate.edit', $team->id) }}"
                               class="absolute top-2 right-2 p-2 rounded-full bg-gray-200 text-gray-600 hover:bg-blue-100 hover:text-blue-600 transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.232 5.232l3.536 3.536M9 11l6.293-6.293a1 1 0 011.414 0l1.586 1.586a1 1 0 010 1.414L11 14l-4 1 1-4z" />
                                </svg>
                            </a>
                            <!-- Foto Paslon (Tim) -->
                            <div class="mb-4 text-center">
                                <img src="{{ $team->picture ? asset('storage/' . $team->picture) : asset('image/icon/user.png') }}"
                                     alt="Foto Tim"
                                     class="w-full h-56 object-cover rounded-xl shadow border border-gray-300">
                            </div>
        
                            <!-- Informasi Tim -->
                            <h3 class="text-xl font-bold text-center text-gray-800">{{ $team->name }}</h3>
                            <p class="text-sm text-center text-gray-500 italic mb-2">"{{ $team->slogan }}"</p>
        
                            <div class="mt-4 text-sm text-gray-600 space-y-2">
                                <p><strong>Visi:</strong> {{ $team->vision }}</p>
                                <p><strong>Misi:</strong> {{ $team->mission }}</p>
                            </div>
        
                            <!-- Ketua & Wakil Ketua -->
                            <div class="flex flex-col sm:flex-row justify-center items-center gap-6 mt-6">
                                @php
                                    $ketua = $team->members->firstWhere('position', 'ketua');
                                    $wakil = $team->members->firstWhere('position', 'wakil ketua');
                                @endphp
                            
                                @if($ketua)
                                <div class="text-center">
                                    <img src="{{ optional($ketua->user)->profile_photo_path 
                                            ? asset('storage/profile/' . $ketua->user->profile_photo_path)
                                            : asset('image/icon/user.png') }}"
                                         alt="Ketua"
                                         class="w-20 h-20 object-cover rounded-full border shadow mb-2 mx-auto">
                                    <h4 class="text-gray-800 font-bold text-sm">{{ $ketua->user->name ?? 'Tanpa Nama' }}</h4>
                                    <p class="text-xs text-gray-400 italic text-center">Ketua</p>
                                </div>
                                @endif
                            
                                @if($wakil)
                                <div class="text-center">
                                    <img src="{{ optional($wakil->user)->profile_photo_path 
                                            ? asset('storage/profile/' . $wakil->user->profile_photo_path)
                                            : asset('image/icon/user.png') }}"
                                         alt="Wakil Ketua"
                                         class="w-20 h-20 object-cover rounded-full border shadow mb-2 mx-auto">
                                    <h4 class="text-gray-800 font-bold text-sm">{{ $wakil->user->name ?? 'Tanpa Nama' }}</h4>
                                    <p class="text-xs text-gray-400 italic text-center">Wakil Ketua</p>
                                </div>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center">Belum ada calon yang terdaftar.</p>
        @endif
        

        </section>

        <!-- Tombol Navigasi -->
        <div class="flex justify-between items-center pt-6 border-t mt-8">
            <a href="{{ route('pemilu.index') }}" class="text-blue-600 font-semibold hover:underline">
                ← Kembali ke Daftar Pemilu
            </a>
            <a href="{{ route('pemilu.edit', $pemilu->id) }}"
                class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                ✏️ Edit Pemilu
            </a>
        </div>
    @endsection
