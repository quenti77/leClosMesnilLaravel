<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Season;
use App\Transformer\Admin\BookingTransformer;
use App\Transformer\FractalTransformer;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class BookingController extends Controller
{

    use FractalTransformer;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View|Factory
    {
        $seasons = Season::all();
        $bookings = Booking::all();
        return view('admin.booking.index', compact('seasons','bookings'));
    }

    public function create(): View|Factory
    {
        return view('admin.booking.create');
    }

    public function store(BookingStoreRequest $request): Redirector|RedirectResponse
    {
        $booking = $this->Booking($request->all());

        $booking->save();

        return redirect()
            ->route('admin.booking.show', $booking->id)
            ->with(['success' => 'Création du booking']);
    }

    /**
     * @throws Exception
     */
    public function show(string $id): View|Factory
    {
        $booking = Booking::with('user')->where("id","=", $id)->first();
        $booking = $this->parseIncludes('user')->item($booking, new BookingTransformer());
        return view("admin.booking.show", compact('booking'));
    }

    public function edit(int $id): View|Factory
    {
        $booking = Booking::find($id);

        return view("admin.booking.edit", compact('booking'));
    }

    public function update(BookingStoreRequest $request, Booking $booking): Redirector|RedirectResponse
    {
        $this->Booking($request->all(), $booking);

        $booking->save();

        return redirect()
            ->route('admin.booking.show', $booking->id)
            ->with(['success' => 'Modification du booking']);
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();
        return redirect()
            ->route('admin.booking.index')
            ->with(['success' => 'La réservation a bien été supprimé']);
    }

    private function Booking(array $bookingData, Booking|null $booking = null): Booking
    {
        $booking ??= new Booking();
        $booking->save();

        return $booking;
    }
}
