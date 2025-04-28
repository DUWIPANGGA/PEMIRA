<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monitoring Hasil PEMIRA') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex gap-8">
            <!-- Sidebar -->
            <aside class="w-1/4">
                <div class="mb-4">
                    <select class="w-full p-2 border border-gray-300 rounded bg-purple-100 text-purple-800 font-semibold">
                        <option selected>Mau Vote Siapa?</option>
                        <option value="1">Organisasi 1</option>
                        <option value="2">Organisasi 2</option>
                        <option value="3">Organisasi 3</option>
                    </select>
                </div>
                <ul class="bg-purple-100 rounded p-2 space-y-2 font-semibold text-purple-900">
                    @foreach (['MPM', 'BEM', 'HMM', 'HPMP', 'HIMATIF', 'HIMA-RPL', 'HIMA-SIKC', 'HIMRA', 'HIMATRIK', 'FORMADIKSI', 'SEBURA', 'KOTAK PENA', 'FOLAFO', 'RPI', 'KOMPA', 'POPI'] as $menu)
                        <li class="hover:bg-purple-300 px-3 py-1 rounded cursor-pointer">{{ $menu }}</li>
                    @endforeach
                </ul>
            </aside>

            <!-- Main Content -->
            <main class="w-3/4 bg-gray-100 p-6 rounded-lg shadow">
                <h3 class="text-2xl font-bold text-center text-red-700 mb-6">Grafik Hasil Suara Sementara</h3>
                    
                <!-- Chart -->
                <canvas id="voteChart" class="w-full h-64 mb-6"></canvas>

                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center flex-wrap gap-8">
                        <!-- Paslon 1 Card (Blue Gradient) -->
                        <div class="text-white shadow-lg rounded-lg p-6 w-64 text-center" style="background: linear-gradient(to right, #3b82f6, #6366f1);">
                            <img src="{{ asset('image/icon/user.png') }}" onerror="this.onerror=null; this.src='{{ asset('images/icon/user.png') }}'" alt="Paslon 1" class="w-32 h-32 object-cover rounded-full shadow-xl mb-4 mx-auto border-4 border-white">
                            <p class="font-semibold text-xl mb-2">Paslon 1</p>
                            <p class="text-sm mb-4">Total Suara: 120</p>
                            <span class="bg-white text-blue-600 px-6 py-2 rounded-full font-semibold shadow-md">120 Suara</span>
                        </div>
                
                        <!-- Paslon 2 Card (Green Gradient) -->
                        <div class="text-white shadow-lg rounded-lg p-6 w-64 text-center" style="background: linear-gradient(to right, #10b981, #34d399);">
                            <img src="{{ asset('image/icon/user.png') }}" onerror="this.onerror=null; this.src='{{ asset('images/icon/user.png') }}'" alt="Paslon 2" class="w-32 h-32 object-cover rounded-full shadow-xl mb-4 mx-auto border-4 border-white">
                            <p class="font-semibold text-xl mb-2">Paslon 2</p>
                            <p class="text-sm mb-4">Total Suara: 95</p>
                            <span class="bg-white text-green-600 px-6 py-2 rounded-full font-semibold shadow-md">95 Suara</span>
                        </div>
                
                        <!-- Paslon 3 Card (Red Gradient) -->
                        <div class="text-white shadow-lg rounded-lg p-6 w-64 text-center" style="background: linear-gradient(to right, #ef4444, #f472b6);">
                            <img src="{{ asset('image/icon/user.png') }}" onerror="this.onerror=null; this.src='{{ asset('images/icon/user.png') }}'" alt="Paslon 3" class="w-32 h-32 object-cover rounded-full shadow-xl mb-4 mx-auto border-4 border-white">
                            <p class="font-semibold text-xl mb-2">Paslon 3</p>
                            <p class="text-sm mb-4">Total Suara: 60</p>
                            <span class="bg-white text-red-600 px-6 py-2 rounded-full font-semibold shadow-md">60 Suara</span>
                        </div>
                    </div>
                </div>
                
                
            </main>
        </div>
    </div>

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('voteChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Paslon 1', 'Paslon 2', 'Paslon 3'],
                datasets: [{
                    label: 'Jumlah Suara',
                    data: [120, 95, 60],
                    backgroundColor: ['#3b82f6', '#10b981', '#ef4444'],
                    borderColor: ['#2563eb', '#059669', '#dc2626'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
