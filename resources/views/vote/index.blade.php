@extends('layouts.vote')
@section('title', 'Vote')
@section('content')

<div class="min-h-screen bg-[#A61616] flex items-center justify-center">
    <div class="w-full max-w-4xl bg-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center relative">

        <!-- Logo and Header -->
        <div class="w-full flex justify-center mb-6">
            <img src="{{ asset('image/icon/logo.png') }}" alt="App Logo" class="w-32 h-auto">
        </div>
        <h2 class="text-3xl font-bold text-center text-[#A61616] mb-4">Voting untuk Organisasi!</h2>
        
        <!-- Voting Options -->
        <div class="w-full flex flex-col items-center justify-center gap-8">
            @foreach($pemilu as $option)
            <div class="w-full bg-[#F9F9F9] p-8 rounded-lg shadow-xl border-4 border-[#FF6C6C]">
                <div class="flex flex-col items-center">
                    <img src="{{ asset($option->logo_path) }}" alt="Logo" class="w-32 h-auto mb-4">
                    <h3 class="text-xl font-semibold text-[#A61616] mb-4">{{ $option->name }}</h3>
                    <p class="text-lg text-center text-gray-700 mb-6">{{ $option->description }}</p>

                    <!-- Vote Button (for confirmation) -->
                    <button onclick="openConfirmationModal({{ $option->id }}, '{{ $option->name }}')" 
                        class="bg-[#A61616] hover:bg-[#FF6C6C] text-white font-semibold py-3 px-8 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                        Pilih {{ $option->name }}
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="relative bg-[#A61616] border-4 border-[#FF6C6C] rounded-2xl p-6 w-11/12 max-w-md text-white shadow-2xl animate-scale-in flex flex-col items-center">
        <div class="w-full flex justify-center">
            <img src="{{ asset('image/assets/warning.png') }}" alt="App Logo" class="w-3/5 h-auto animate-pulse mb-4">
        </div>
        <div class="flex flex-col items-center">
            <h1 class="">Konfirmasi Pilihanmu</h1>
            <p id="candidateName" class="text-center mb-6">
                Apakah kamu yakin ingin memilih organisasi ini?
            </p>
            <form id="confirmVoteForm" method="POST" class="w-full">
                @csrf
                @method('POST')
                <div class="flex justify-center gap-4">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded">
                        Ya, Pilih
                    </button>
                    <button type="button" onclick="closeConfirmationModal()" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    function openConfirmationModal(teamId, teamName) {
        // Set form action dynamically
        const form = document.getElementById('confirmVoteForm');
        form.action = `/vote/${teamId}`; // Sesuai route voting.create kamu

        // Set candidate name (optional kalau mau tampilkan)
        document.getElementById('candidateName').innerText = `Yakin mau pilih ${teamName}?`;

        // Tampilkan modal
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    function closeConfirmationModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }
</script>

<!-- Scale-in animation style -->
<style>
    @keyframes scale-in {
        from {
            transform: scale(0.9);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .animate-scale-in {
        animation: scale-in 0.3s ease-out forwards;
    }
</style>
@endsection
