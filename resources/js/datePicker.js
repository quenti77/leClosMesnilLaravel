import { DateRangePicker, Datepicker } from "vanillajs-datepicker";
import fr from "vanillajs-datepicker/locales/fr";


Object.assign(Datepicker.locales, fr);

function sqlToDate(sql) {
    const split = sql.split('-')
    return new Date(split[0], split[1] - 1, split[2], 12, 0, 0)
}

const bookingDates = window.bookings.reduce((dates, booking) => {
    const startedAt = sqlToDate(booking.started_at)
    const finishedAt = sqlToDate(booking.finished_at)
    let currentAt = startedAt

    while (currentAt <= finishedAt - 1) {
        dates.add(currentAt.toLocaleDateString("fr"))
        currentAt.setDate(currentAt.getDate() +1)
    }

    return dates
}, new Set())

const elem = document.querySelector("#range");

new DateRangePicker(elem, {
    language: "fr",
    clearBtn: "true",
    orientation: "bottom",
    nextArrow: '<i class=\"fas fa-chevron-right\"></i>',
    prevArrow: '<i class=\"fas fa-chevron-left\"></i>',
    datesDisabled: [...bookingDates],
});

