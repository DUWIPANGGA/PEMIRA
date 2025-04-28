@extends('layouts.admin')
@section('title', 'buat pemilu')
@section('content')
    {{-- Tambahkan di layout atau langsung di file --}}
    

    <div class="bg-white shadow rounded-2xl p-8 border border-gray-200">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Form Tambah Calon</h1>
            <p class="text-sm text-gray-500 mt-2">Silakan isi detail calon kandidat di bawah ini</p>
        </div>

        <form action="{{ route('candidate.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('POST')
            <!-- Deskripsi -->
            <input type="hidden" name="events_id" value="{{ $pemilu->id }}">
            
            <!-- Nama TIM -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama TIM</label>
                <textarea name="name" id="name" rows="4" placeholder="Tulis Name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" required>{{ old('name') }}</textarea>
            </div>
            
            <!-- Slogan -->
            <div>
                <label for="slogan" class="block text-sm font-medium text-gray-700 mb-1">Slogan</label>
                <textarea name="slogan" id="slogan" rows="4" placeholder="Tulis Slogan"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" required>{{ old('slogan') }}</textarea>
            </div>
            
            <!-- Visi -->
            <div>
                <label for="vision" class="block text-sm font-medium text-gray-700 mb-1">Visi</label>
                <textarea name="vision" id="vision" rows="4" placeholder="Tulis Visi"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" required>{{ old('vision') }}</textarea>
            </div>
            
            <!-- Misi -->
            <div>
                <label for="mission" class="block text-sm font-medium text-gray-700 mb-1">Misi</label>
                <textarea name="mission" id="mission" rows="4" placeholder="Tulis Misi "
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300" required>{{ old('mission') }}</textarea>
            </div>
            
            <!-- Pilih Ketua -->
            <div>
                <label for="ketua" class="block text-sm font-medium text-gray-700 mb-1">Pilih Ketua</label>
                <select name="ketua" id="ketua" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">-- Pilih Calon Ketua --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('ketua') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Pilih Wakil Ketua -->
            <div>
                <label for="wakilketua" class="block text-sm font-medium text-gray-700 mb-1">Pilih Calon Wakil Ketua</label>
                <select name="wakilketua" id="wakil-ketua" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">-- Pilih Calon Wakil Ketua --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('wakilketua') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Foto -->
            <div>
                <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Foto Kandidat</label>
                <input type="file" name="picture" id="picture"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                    accept="image/*">
            </div>

            <!-- Pemilu yang Diikuti -->
            <input type="hidden" name="pemilu_id" value="{{ $pemilu->id }}">

            <!-- Submit -->
            <div>
                <button type="submit"
                    class="w-full py-3 px-6 text-white bg-green-600 rounded-md font-semibold shadow hover:bg-green-700 transition">
                    Tambah Calon
                </button>
            </div>
        </form>

    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @section('script')
        <script>
            $(document).ready(function() {
                $('#wakil-ketua').select2({
                    placeholder: "-- Pilih Calon Wakil Ketua --",
                    allowClear: true,
                    width: '100%'
                });
            });
            $(document).ready(function() {
                $('#ketua').select2({
                    placeholder: "-- Pilih Calon Ketua --",
                    allowClear: true,
                    width: '100%'   
                });
            });
        </script>
    @endsection
