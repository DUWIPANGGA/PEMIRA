@extends('layouts.vote')
@section('title', 'Vote ')

@section('sidebar')
<aside class="w-1/4 mr-4" data-aos="fade-right">
    <a href="{{ route('hasil.index') }}" class="block bg-white border border-black rounded hover:bg-purple-100 p-2">
        <div class="flex items-center">
            <img src="{{ asset('image/icon/logo.png') }}" alt="App Logo" class="w-10 h-10 mr-3">
            <span class="text-gray-600 font-semibold">Cek Hasil Vote</span>
        </div>
    </a>
    
    <ul class="bg-purple-100 p-2 rounded space-y-2">
        @foreach ($pemilu as $item)
            <a href="{{ route('hasil.show',$item->name) }}">
                <li class="hover:bg-purple-300 cursor-pointer px-2 py-1 rounded hover:translate-x-1 transition-transform duration-150">
                    <b>{{ $item->name }}</b>
                </li>
            </a>
        @endforeach
    </ul>
</aside>
@endsection

@section('content')
<main class="w-full bg-transparent p-6 rounded-lg " data-aos="fade-up">
    <div class="w-full max-w-4xl bg-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center relative border-4 border-red-500">

        <!-- Logo and Header -->
        <div class="w-full flex justify-center mb-6">
            <img src="{{ asset('image/icon/logo.png') }}" alt="App Logo" class="w-32 h-auto">
        </div>
        <h2 class="text-3xl font-bold text-center text-[#A61616] mb-4">Hasil PEMILU sementara</h2>
        
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
</main>
@endsection

@section('script')
<!-- Chart.js -->

<!-- AOS Library -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        easing: 'ease-in-out'
    });
</script>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
@endsection
