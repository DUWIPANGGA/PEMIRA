@section('title', 'politeknik negeri indramayu')

<x-app-layout>
    <x-slot name="header"></x-slot>

    {{-- AOS STYLES --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <!-- HERO SECTION -->
    <div class="relative w-screen h-screen bg-cover bg-center flex justify-center items-center overflow-hidden"
         style="background-image: url({{ asset('image/background/polindra.png') }})">
        <h1 class="text-dark text-center text-4xl md:text-6xl font-bold z-10 opacity-0"
            id="text-container"
            data-aos="fade-up"
            data-aos-delay="300">
            WHO'S <br> THE NEXT!!
        </h1>

        <!-- Radio Buttons -->
        <div class="absolute bottom-10 flex space-x-4 z-10">
            <input type="radio" name="image-swap" id="radio-1" class="hidden" onclick="changeText(0)" checked>
            <input type="radio" name="image-swap" id="radio-2" class="hidden" onclick="changeText(1)">
            <div class="flex space-x-2">
                <label for="radio-1" class="w-4 h-4 bg-black rounded-full cursor-pointer"></label>
                <label for="radio-2" class="w-4 h-4 bg-black rounded-full cursor-pointer"></label>
            </div>
        </div>
    </div>

    <!-- PEMIRA SECTION -->
    <div class="relative w-full min-h-screen pt-20 z-10"
         style="background-image: url({{ asset('image/background/paperb.png') }}); background-repeat: no-repeat; background-size: 100% 190%; background-position: bottom; margin-top: -190px;">
        <div class="container mx-auto px-4 py-12 flex flex-col md:flex-row items-end justify-center gap-8 overflow-hidden">
            <div class="flex flex-col items-center text-center md:text-left md:items-start max-w-xs" data-aos="fade-right">
                <h2 class="text-3xl md:text-4xl font-extrabold leading-tight mb-2">
                    Apa Itu <span class="text-black">PEMIRA</span>?
                </h2>
                <img src="{{ asset('image/icon/logo.png') }}" alt="Kotak Suara" class="w-100 h-100 mb-4">
            </div>

            <div class="bg-white border-4 border-red-500 rounded-3xl p-6 max-w-xl relative shadow-lg" data-aos="fade-left">
                <p class="text-justify text-sm leading-relaxed font-medium">
                    Pemilihan Raya (Pemira) merupakan satu wujud demokrasi yang diterapkan di lingkungan kampus
                    Politeknik Statistika STIS.
                    Pemira merupakan pesta demokrasi bagi mahasiswa dan mediasi yang tepat untuk mewujudkan regenerasi
                    lembaga kampus. Dalam Pemira terdapat pemilihan Ketua serta Anggota Dewan Perwakilan Mahasiswa (DPM),
                    Ketua dan Wakil Ketua Badan Eksekutif Mahasiswa (BEM), serta Ketua Tingkat I–IV.
                </p>
            </div>
        </div>
    </div>

    <!-- TIMELINE SECTION -->
    <div class="relative w-full min-h-screen pt-20 z-10"
         style="background-image: url({{ asset('image/background/paper.png') }}); background-repeat: no-repeat; background-size: 100% 100%; background-position: bottom; margin-top: -400px;">
    </div>

    <div class="container flex flex-col justify-center items-center p-10" data-aos="fade-up">
        <h1 class="text-dark text-center text-4xl font-bold pb-10">TIMELINE</h1>
        <div id="app" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4"></div>
    </div>

    {{-- SCRIPT SECTION --}}
    <script>
        const app = document.getElementById("app");
        const events = @json($events);
        let selectedDate = new Date();

        function formatDateKey(date) {
            return date.toISOString().split("T")[0];
        }

        function renderTimeline(date) {
            const key = formatDateKey(date);
            const dayEvents = events[key] || [];

            let html = `<div class='mt-6'>
                <h3 class='text-lg font-medium text-purple-800 mb-3'>Timeline: ${key}</h3>`;

            if (dayEvents.length === 0) {
                html += `<p class='text-gray-500 text-sm'>Tidak ada event</p>`;
            } else {
                html += `<ul class='space-y-2'>`;
                dayEvents.forEach(evt => {
                    html += `<li class='border-l-4 border-purple-500 pl-3 text-gray-800'>
                        <span class='font-semibold'>${evt.title}</span> - ${evt.description}</li>`;
                });
                html += `</ul>`;
            }

            html += `</div>`;
            return html;
        }

        function renderCalendarForMonth(date) {
            const month = date.getMonth();
            const year = date.getFullYear();
            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();

            let html = `<div class='bg-white rounded-xl shadow-lg p-6'>
                <div class='flex justify-between items-center mb-4'>
                    <h2 class='text-xl font-semibold text-purple-800'>
                        ${date.toLocaleString('default', { month: 'long' })} ${year}
                    </h2>
                </div>
                <div class='grid grid-cols-7 text-center text-gray-600 font-medium mb-2'>
                    ${["S", "M", "T", "W", "T", "F", "S"].map(d => `<div>${d}</div>`).join("")}
                </div>
                <div class='grid grid-cols-7 gap-1 text-sm'>`;

            for (let i = 0; i < firstDay; i++) {
                html += `<div></div>`;
            }

            for (let d = 1; d <= lastDate; d++) {
                const dayDate = new Date(year, month, d);
                const key = formatDateKey(dayDate);
                const isSelected = dayDate.toDateString() === selectedDate.toDateString();
                const hasEvents = events[key] && events[key].length > 0;

                html += `
                    <button class='relative rounded-full w-8 h-8 flex items-center justify-center 
                        ${isSelected ? 'bg-purple-600 text-white' : 'hover:bg-purple-200 text-gray-800'}' 
                        onclick='selectDate(${year}, ${month}, ${d})'>
                        ${d}
                        ${hasEvents ? "<span class='absolute bottom-0 w-1.5 h-1.5 bg-purple-500 rounded-full'></span>" : ""}
                    </button>`;
            }

            html += `</div>`;
            html += renderTimeline(selectedDate);
            html += `</div>`;
            return html;
        }

        function renderAllCalendars() {
            let html = '';
            const start = new Date(2025, 0, 1); // Januari
            for (let m = 0; m < 12; m++) {
                const monthDate = new Date(start.getFullYear(), m, 1);
                html += renderCalendarForMonth(monthDate);
            }
            app.innerHTML = html;
        }

        function selectDate(y, m, d) {
            selectedDate = new Date(y, m, d);
            renderAllCalendars();
        }

        renderAllCalendars();
    </script>

    {{-- Change Hero Text --}}
    <script>
        function changeText(index) {
            const textContainer = document.getElementById('text-container');
            if (index === 0) {
                textContainer.innerHTML = "WHO'S <br> THE NEXT!!";
            } else {
                textContainer.innerHTML = "THE NEXT <br> IS HERE!!";
            }
        }
    </script>

    {{-- AOS SCRIPT --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
    </script>
</x-app-layout>
