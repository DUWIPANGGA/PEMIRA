@section('title', 'dashboard')
<x-app-layout>
    <x-slot name="header">
        {{-- <div class="flex flex-row gap-4">
            <p class="permira-button">
                {{ __('Voting') }}
            </p>
            <p class="permira-button">
                {{ __('Dashboard') }}
            </p>
            <p class="permira-button">
                {{ __('Hasil') }}
            </p>
        </div> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
                <div class="container flex flex-col justify-center items-center p-10" data-aos="fade-up">
                    <h1 class="text-dark text-center text-4xl font-bold pb-10">TIMELINE</h1>
                    <div id="app" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4"></div>
                    <div id="timeline" class="mt-10 px-4"></div>
            
                </div>
            </div>
        </div>
    </div>
    <script>
        const app = document.getElementById("app");
const timeline = document.getElementById("timeline");
let selectedDate = new Date(); // default: today

const events = {
  "2025-01-01": [{ time: "09:00", title: "New Year Celebration" }],
  "2025-03-17": [{ time: "14:00", title: "Project Deadline" }],
  "2025-05-04": [
    { time: "10:00", title: "Current Date Event" },
    { time: "15:30", title: "Afternoon Meeting" }
  ],
  "2025-12-25": [{ time: "00:00", title: "Christmas Day" }]
};

function getMonthName(monthIndex) {
  return new Date(2025, monthIndex).toLocaleString("default", { month: "long" });
}

function pad(n) {
  return n.toString().padStart(2, "0");
}

function renderCalendarForMonth(date) {
  const year = date.getFullYear();
  const month = date.getMonth();
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const daysInMonth = lastDay.getDate();
  const startDayOfWeek = firstDay.getDay();

  let html = `
    <div class="bg-white rounded-lg shadow-md p-4">
      <h2 class="text-xl font-bold mb-4">${getMonthName(month)} ${year}</h2>
      <div class="grid grid-cols-7 text-center font-semibold text-sm text-gray-600 mb-2">
        <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div>
        <div>Thu</div><div>Fri</div><div>Sat</div>
      </div>
      <div class="grid grid-cols-7 text-center text-sm">
  `;

  for (let i = 0; i < startDayOfWeek; i++) {
    html += `<div class="p-2"></div>`;
  }

  for (let day = 1; day <= daysInMonth; day++) {
    const fullDate = `${year}-${pad(month + 1)}-${pad(day)}`;
    const isToday = fullDate === formatDate(selectedDate);
    const hasEvent = events.hasOwnProperty(fullDate) && Array.isArray(events[fullDate]) && events[fullDate].length > 0;

    html += `
      <div class="p-1">
        <button onclick="selectDate(${year}, ${month}, ${day})"
          class="w-full py-1 rounded relative flex flex-col items-center ${
            isToday
              ? "bg-blue-600 text-white font-bold"
              : hasEvent
              ? "bg-yellow-100 text-yellow-800 font-semibold"
              : "hover:bg-gray-100"
          }">
          <span>${day}</span>
          ${hasEvent ? '<span class="w-1.5 h-1.5 bg-red-500 rounded-full mt-0.5"></span>' : ''}
        </button>
      </div>
    `;
  }

  html += `</div></div>`;
  return html;
}


function renderAllCalendars() {
  const startYear = 2025;
  app.innerHTML = "";
  for (let m = 0; m < 12; m++) {
    const date = new Date(startYear, m, 1);
    app.innerHTML += renderCalendarForMonth(date);
  }

  // Render timeline only once for selectedDate
  timeline.innerHTML = renderTimeline(selectedDate);
}

function selectDate(y, m, d) {
  selectedDate = new Date(y, m, d);
  renderAllCalendars();
}

function renderTimeline(date) {
  const dateStr = formatDate(date);
  const dateTitle = date.toLocaleDateString("en-US", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric"
  });

  const dayEvents = events[dateStr] || [];

  let html = `
    <div class="bg-white rounded-lg shadow-md p-4">
      <h2 class="text-2xl font-bold mb-4">Timeline: ${dateTitle}</h2>
  `;

  if (dayEvents.length === 0) {
    html += `<p class="text-gray-500">No events for this date.</p>`;
  } else {
    html += `<ul class="space-y-2">`;
    for (let e of dayEvents) {
      html += `
        <li class="border-l-4 border-blue-500 pl-4">
          <div class="text-sm text-blue-600 font-semibold">${e.time}</div>
          <div class="text-gray-800">${e.title}</div>
        </li>
      `;
    }
    html += `</ul>`;
  }

  html += `</div>`;
  return html;
}

function formatDate(date) {
  return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}`;
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
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</x-app-layout>
