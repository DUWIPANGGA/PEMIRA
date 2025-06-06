@extends('layouts.vote')
@section('title', 'Vote ')

@section('sidebar')
<aside class="w-1/4 mr-4" data-aos="fade-right">
    <a href="{{ route('voting') }}" class="block bg-white border border-black rounded hover:bg-purple-100 p-2">
        <div class="flex items-center">
            <img src="{{ asset('image/icon/logo.png') }}" alt="App Logo" class="w-10 h-10 mr-3">
            <span class="text-gray-600 font-semibold">Mau Vote Siapa?</span>
        </div>
    </a>
    
    <ul class="bg-purple-100 p-2 rounded space-y-2">
        @foreach ($pemilu as $item)
            <a href="{{ route('voting.show',$item->name) }}">
                <li class="hover:bg-purple-300 hover:scale-105 transform transition-transform duration-150 cursor-pointer px-2 py-1 rounded">
                    <b>{{ $item->name }}</b>
                </li>
            </a>
        @endforeach
    </ul>
</aside>
@endsection

@section('content')
<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div
        class="relative bg-[#A61616] border-4 border-[#FF6C6C] rounded-2xl p-6 w-11/12 max-w-md text-white shadow-2xl flex flex-col items-center"
        data-aos="zoom-in"
    >
        <div class="w-full flex justify-center">
            <img src="{{ asset('image/assets/warning.png') }}" alt="App Logo" class="w-3/5 h-auto animate-pulse mb-4">
        </div>
        <div class="flex flex-col items-center">
            <h1 class="">Konfirmasi Pilihanmu</h1>
            <p id="candidateName" class="text-center mb-6">
                Apakah kamu yakin ingin memilih kandidat ini?
            </p>
            <form id="confirmVoteForm" method="POST" class="w-full">
                @csrf
                @method('POST')
                <div class="flex justify-center gap-4">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded">
                        Ya, Pilih
                    </button>
                    <button type="button" onclick="closeConfirmationModal()"
                        class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($teams->candidates && $teams->candidates->isNotEmpty())
    @foreach ($teams->candidates as $team)
        <div class="border border-gray-300 p-4 rounded-lg flex items-start bg-gray-50 shadow mb-4"
            data-aos="fade-up"
        >
            <div class="mr-4">
                <div class="h-24 w-24 flex items-center justify-center rounded">
                    <img src="{{ asset('storage/' . $team->picture) }}" alt="{{ $team->name }} Picture"
                        class="h-full w-full object-cover rounded">
                </div>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold">{{ $team->name }}</h3>
                @foreach ($team->members as $member)
                    <p class="text-xl font-bold">{{ $member->user->name ?? 'Tanpa Nama' }}</p>
                    <div class="text-sm text-gray-600 mb-2">
                        {{ $member->user->program_study ?? 'Tanpa Program Studi' }}
                    </div>
                @endforeach

                <div class="mb-2">
                    <strong>Visi:</strong>
                    <p class="text-sm text-gray-700">
                        {{ $team->vision }}
                    </p>
                </div>
                <div>
                    <strong>Misi:</strong>
                    <p class="text-sm text-gray-700">
                        {{ $team->mission }}
                    </p>
                </div>
            </div>
            <div class="ml-4">
                <form action="{{ route('voting.create', $team->id) }}" method="POST">
                    @method('POST')
                    @csrf
                    <button type="button" 
                        onclick="openConfirmationModal('{{ $team->id }}', '{{ $team->name }}')"
                        class="bg-red-600 hover:bg-red-700 hover:scale-105 transform transition-transform duration-200 text-white font-bold py-2 px-4 rounded shadow">
                        VOTE
                    </button>
                </form>
            </div>
        </div>
    @endforeach
@else
    <div class="border border-gray-300 p-4 rounded-lg flex justify-center items-center bg-gray-50 shadow" data-aos="fade-up">
        <div class="w-full flex justify-center">
            <img src="{{ asset('image/assets/warning.png') }}" alt="App Logo" class="w-3/5 h-auto animate-pulse mb-4">
        </div>
    </div>
@endif
@endsection

@section('script')
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            once: true
        });

        function openConfirmationModal(teamId, teamName) {
            const form = document.getElementById('confirmVoteForm');
            form.action = `/vote/${teamId}`;
            document.getElementById('candidateName').innerText = `Yakin mau pilih ${teamName}?`;
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        function closeConfirmationModal() {
            document.getElementById('confirmationModal').classList.add('hidden');
        }
    </script>

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
@endsection
