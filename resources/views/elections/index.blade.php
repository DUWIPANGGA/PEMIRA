@extends('layouts.admin')
@section('title', 'buat pemilu')
@section('content')
    
                <div class="bg-white shadow-xl rounded-lg p-10 w-full border border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-800">Daftar Pemilu</h3>
                        <a href="{{ route('pemilu.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                            Buat Pemilu Baru
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Pemilu</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal Mulai</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal Selesai</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pemilus as $pemilu)
                                    <tr class="border-t border-gray-200">
                                        <td class="px-6 py-4 text-sm text-gray-800">{{ $pemilu->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $pemilu->description }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $pemilu->start_date->format('d-m-Y') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $pemilu->end_date->format('d-m-Y') }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <a href="{{ route('pemilu.show', $pemilu->id) }}" class="text-blue-600 hover:underline">Show</a> |
                                            <a href="{{ route('pemilu.edit', $pemilu->id) }}" class="text-blue-600 hover:underline">Edit</a> |
                                            <form action="{{ route('pemilu.destroy', $pemilu->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus pemilu ini?')" class="text-red-600 hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data pemilu.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

@endsection