<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use App\Models\Booking;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View|Factory
    {
        $price=90;
        return view('booking' , compact('price'));
    }

    public function create(): View|Factory
    {
        return view('booking');
    }

    public function store(BookingStoreRequest $request): Redirector|RedirectResponse
    {
        $this->storeBooking($request->all());

        return redirect()
            ->back()
            ->with(['success' => 'Merci d\'avoir réserver !']);
    }

    /**
     * @throws \Exception
     */
    private function storeBooking(array $bookingData, booking|null $booking = null): booking
    {
        $started_at = new \DateTime($bookingData['started_at']);
        $finished_at = new \DateTime($bookingData['finished_at']);
        $interval = $finished_at->diff($started_at);
        $booking ??= new booking();

        $booking->started_at = $bookingData['started_at'];
        $booking->finished_at = $bookingData['finished_at'];
        $booking->nb_night = $interval->format('%d');
        $booking->nb_adult = $bookingData['nb_adult'];
        $booking->nb_children = $bookingData['nb_children'];
        $booking->price = 90;
        $booking->user_id = (string) Auth::id();
        $booking->save();

        return $booking;
    }

    public function destroy(booking $booking): RedirectResponse
    {
        $booking->delete();
        return redirect()
            ->route('booking')
            ->with(['success' => 'La réservation a bien était annulée']);
    }
}
