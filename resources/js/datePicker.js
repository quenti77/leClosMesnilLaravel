import {DateRangePicker, Datepicker} from "vanillajs-datepicker";
import fr from "vanillajs-datepicker/locales/fr";


Object.assign(Datepicker.locales, fr);

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


const getPeriode = async () => {
    const bookings = await getBookings();
    const bookingDates = bookings.data.reduce((dates, booking) => {
        const startedAt = sqlToDate(booking.started_at)
        const finishedAt = sqlToDate(booking.finished_at)
        let currentAt = startedAt

        while (currentAt <= finishedAt - 1) {
            dates.add(currentAt.toLocaleDateString("fr"))
            currentAt.setDate(currentAt.getDate() + 1)
        }

        return dates
    }, new Set())
    return bookingDates
}

getPeriode().then(bookingDates => {
        const elem = document.querySelector("#range");

        new DateRangePicker(elem, {
            language: "fr",
            clearBtn: "true",
            orientation: "bottom",
            nextArrow: '<i class=\"fas fa-chevron-right\"></i>',
            prevArrow: '<i class=\"fas fa-chevron-left\"></i>',
            minDate: new Date(),
            datesDisabled: [...bookingDates],
        });
    }
)






