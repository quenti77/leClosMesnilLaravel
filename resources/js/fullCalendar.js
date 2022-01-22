import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import frLocale from '@fullcalendar/core/locales/fr';

function sqlToDate(sql) {
    const split = sql.split('-')
    return new Date(split[0], split[1] - 1, split[2], 12, 0, 0)
}

const getBookings = async () => {
    const headers = {
        'content-type': 'application/json'
    }
    const url = '/bookings'
    const response = await fetch(url, {headers})
    if (response.status !== 200) {
        return null
    }

    return await response.json()
}


const getEvents = async () => {
    const bookings = await getBookings();
    const events = bookings.data.map((booking) => {
        let startedAt = booking.started_at
        let finishedAt = booking.finished_at

        return  {
            title: 'res-' + booking.user.name,
            start : startedAt,
            end : finishedAt,
            url : '/admin/booking/' + booking.id
        }
})
    return events
}




document.addEventListener('DOMContentLoaded', function () {
    getEvents().then(events => {
        const calendarEl = document.getElementById('calendar');
        let calendar = new Calendar(calendarEl, {
            locale: frLocale,
            plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek',
            },
            timeZone: 'UTC',
            events
        });
        calendar.render();
    })

});