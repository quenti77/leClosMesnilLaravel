import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import frLocale from '@fullcalendar/core/locales/fr';

document.addEventListener('DOMContentLoaded', function() {
const calendarEl = document.getElementById('calendar');
let calendar = new Calendar(calendarEl, {
    locale: frLocale,
    plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
    initialView: 'dayGridMonth',
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek',
    }});
    calendar.render();
});
