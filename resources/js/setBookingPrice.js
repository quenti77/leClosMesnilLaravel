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

const getPeriod = async () => {
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
