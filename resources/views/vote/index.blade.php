@extends('layouts.vote')
@section('title', 'Vote')
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
                <li class="hover:bg-purple-300 cursor-pointer px-2 py-1 rounded hover:translate-x-1 transition-transform duration-150 "><b>{{ $item->name }}</b></li>
            </a>
        @endforeach
    </ul>
</aside>
@endsection
@section('content')

<div class="min-h-screen flex items-center justify-center" data-aos="fade-up">
    <div class="w-full max-w-4xl bg-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center relative border-4 border-red-500">

        <!-- Logo and Header -->
        <div class="w-full flex justify-center mb-6">
            <img src="{{ asset('image/icon/logo.png') }}" alt="App Logo" class="w-32 h-auto">
        </div>
        <h2 class="text-3xl font-bold text-center text-[#A61616] mb-4">Voting untuk Organisasi!</h2>
        
        <!-- Voting Options -->
        <div class="w-full flex flex-col items-center justify-center gap-8">
           Lorem ipsum dolor sit amet consectetur adipisicing elit. Est facilis sequi deserunt alias, illum aut, saepe consequuntur voluptates sint neque sapiente dolore a odit voluptatibus dolores? Totam quia ab aut!
           Consectetur vel aut ex error incidunt dolor minus blanditiis iure esse aperiam quia nostrum amet culpa libero aliquid, dolores dolore! Vitae eveniet repellendus deserunt corrupti animi dicta nemo natus ut?
           Animi numquam, id modi consectetur obcaecati dolores eligendi sit dolorum blanditiis iure, eos incidunt repellat quos totam soluta quis deserunt fugit laudantium reprehenderit hic tempore eaque temporibus quo earum. Voluptatem.
<br>
           Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, obcaecati voluptate voluptas quam quidem doloribus rem vel unde architecto consequuntur tempore ipsam consequatur, a molestiae? Eos amet expedita totam corrupti.
           Autem illum hic eos nam nemo. Veritatis laudantium porro cumque commodi officia velit saepe optio harum incidunt suscipit natus inventore, reiciendis pariatur quidem explicabo sed hic ut debitis quasi quis!
           Repellat illum recusandae sunt tempore, ex maxime! Voluptatum aperiam animi dolor, est corporis aliquid necessitatibus ipsa dignissimos libero deleniti adipisci expedita quis itaque ad iste quisquam sapiente iure consequuntur ducimus!
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
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        easing: 'ease-in-out'
    });
</script>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
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
