@extends('layouts.admin')
@section('title', 'Daftar Users')
@section('content')

<div class="bg-white shadow-xl rounded-lg p-10 w-full border border-gray-200">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-2xl font-bold text-gray-800">Daftar Users</h3>
        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
            Buat User Baru
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">NIM</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nomor HP</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Prodi</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-t border-gray-200">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->NIM }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->phone }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->prodi }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($user->role) }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:underline">Show</a> |
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a> |
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus user ini?')" class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
