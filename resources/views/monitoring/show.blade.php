@extends('layouts.vote')
@section('title', 'Vote ')

@section('sidebar')
<aside class="w-1/4 mr-4" data-aos="fade-right">
    <a href="{{ route('voting') }}" class="block bg-white border border-black rounded hover:bg-purple-100 p-2">
        <div class="flex items-center">
            <img src="{{ asset('image/icon/logo.png') }}" alt="App Logo" class="w-10 h-10 mr-3">
            <span class="text-gray-600 font-semibold">Cek Hasil Vote</span>
        </div>
    </a>
    
    <ul class="bg-purple-100 p-2 rounded space-y-2">
        @foreach ($pemilu as $item)
            <a href="{{ route('hasil.show',$item->name) }}">
                <li class="hover:bg-purple-300 cursor-pointer px-2 py-1 rounded">
                    <b>{{ $item->name }}</b>
                </li>
            </a>
        @endforeach
    </ul>
</aside>
@endsection

@section('content')
<main class="w-full bg-gray-100 p-6 rounded-lg shadow" data-aos="fade-up">
    <h3 class="text-2xl font-bold text-center text-red-700 mb-6">Grafik Hasil Suara Sementara</h3>

    <!-- Chart -->
    <canvas id="voteChart" class="w-full h-64 mb-6" data-aos="fade-up"></canvas>

    <!-- Kandidat Cards -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center flex-wrap gap-8">
            @foreach ($teams->candidates as $index => $candidate)
                @php
                    $bgColors = [
                        ['#3b82f6', '#6366f1'],
                        ['#10b981', '#34d399'],
                        ['#ef4444', '#f472b6'],
                        ['#facc15', '#fcd34d'],
                        ['#8b5cf6', '#a78bfa'],
                        ['#14b8a6', '#2dd4bf'],
                        ['#f97316', '#fb923c'],
                        ['#e11d48', '#f43f5e']
                    ];
                    $bg = $bgColors[$index % count($bgColors)];
                @endphp
                <div 
                    class="text-white shadow-lg rounded-lg p-6 w-64 text-center transform transition-transform duration-300 hover:scale-105"
                    style="background: linear-gradient(to right, {{ $bg[0] }}, {{ $bg[1] }});"
                    data-aos="flip-up"
                >
                    <img src="{{ asset('image/icon/user.png') }}" alt="Paslon"
                        class="w-32 h-32 object-cover rounded-full shadow-xl mb-4 mx-auto border-4 border-white">
                    <p class="font-semibold text-xl mb-2">{{ $candidate->name }}</p>
                    <p class="text-sm mb-4">Total Suara: {{ $candidate->votes_count }}</p>
                    <span class="bg-white text-gray-800 px-6 py-2 rounded-full font-semibold shadow-md">
                        {{ $candidate->votes_count }} Suara
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection

@section('script')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartLabels = {!! json_encode($chartData->pluck('name')) !!};
    const chartVotes = {!! json_encode($chartData->pluck('votes')) !!};

    const colors = ['#3b82f6', '#10b981', '#ef4444', '#facc15', '#8b5cf6', '#14b8a6', '#f97316', '#e11d48'];

    const ctx = document.getElementById('voteChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Jumlah Suara',
                data: chartVotes,
                backgroundColor: colors.slice(0, chartLabels.length),
                borderColor: colors.slice(0, chartLabels.length),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>

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
