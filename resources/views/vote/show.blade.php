@extends('layouts.vote')
@section('title', 'Vote ')
@section('content')
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div
            class="relative bg-[#A61616] border-4 border-[#FF6C6C] rounded-2xl p-6 w-11/12 max-w-md text-white shadow-2xl animate-scale-in flex flex-col items-center">
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

    @foreach ($teams->candidates as $team)
        <div class="border border-gray-300 p-4 rounded-lg flex items-start bg-gray-50 shadow">
            <div class="mr-4">
                <div class="h-24 w-24 flex items-center justify-center rounded">
                    <!-- Menampilkan foto tim, jika ada -->
                    <img src="{{ asset('storage/' . $team->picture) }}" alt="{{ $team->name }} Picture"
                        class="h-full w-full object-cover rounded">
                </div>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold">{{ $team->name }}</h3> <!-- Menampilkan nomor urut -->

                @foreach ($team->members as $member)
                    <!-- Looping untuk members di dalam tim -->
                    <p class="text-xl font-bold">{{ $member->user->name ?? 'Tanpa Nama' }}</p>
                    <!-- Menampilkan nama user -->
                    <div class="text-sm text-gray-600 mb-2">
                        {{ $member->user->program_study ?? 'Tanpa Program Studi' }} <!-- Menampilkan program studi -->
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

                    <button type="button" onclick="openConfirmationModal('{{ $team->id }}', '{{ $team->name }}')"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">
                        VOTE
                    </button>
                </form>
            </div>
        </div>
    @endforeach

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
