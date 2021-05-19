<?php 

namespace App\Http\Controllers;

use App\Models\Booking;

class BookingController extends Controller
{
    public function getBooking()
    {
        $bookings = Booking::all();
        return view('booking', compact('bookings'));
    }
}