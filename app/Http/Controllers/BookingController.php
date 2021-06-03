<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BookingController extends Controller
{
    public function getBooking(): View|Factory
    {
        $bookings = Booking::all();
        return view('booking', compact('bookings'));
    }
}
