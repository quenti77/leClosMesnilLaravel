<?php

namespace App\Http\Controllers;

use App\DTO\BookingRequestData;
use App\Http\Requests\BookingStoreRequest;
use App\Jobs\Query\CalculateBookingPrice;
use App\Models\Booking;
use App\Transformer\BookingTransformer;
use App\Transformer\FractalTransformer;
use DateTime;
use DateTimeImmutable;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class BookingController extends Controller
{
    use FractalTransformer;

    public function __construct()
    {
        $this->middleware('auth')->except('getBooking');
    }

    public function index(): View|Factory
    {
        $bookings = Booking::all();
        return view('booking', compact('bookings'));
    }

    public function getBooking(): \Illuminate\Http\JsonResponse
    {
        $bookings = Booking::with('user')->get();

        return response()->json($this->collection($bookings, new BookingTransformer()));
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
     * @throws Exception
     */
    private function storeBooking(array $bookingData, Booking|null $booking = null): Booking
    {
        $format = 'd/m/Y';
        $startedAt = DateTimeImmutable::createFromFormat($format, $bookingData['started_at']);
        $finishedAt = DateTimeImmutable::createFromFormat($format, $bookingData['finished_at']);
        $nbAdult = $bookingData['nb_adult'];

        if ($startedAt === false || $finishedAt === false) {
            throw new InvalidArgumentException('Started or Finished date are not a valid format');
        }

        /**
         * options
         * 
         * - id (uuid)
         * - name (varchar(20))
         * - description (text)
         * - prices (json)
         * 
         * UUID, linge de lit, desc, '{ items: [
         *  { price: 13_00, label: '1 chambre' }, { price: 20_00, label: '2 chambres' }
         * ] }'::json
         * UUID, ménage, desc, '{ items: [{ price: 50_00 }] }'::json
         */

        $bookingRequest = new BookingRequestData(
            $startedAt,
            $finishedAt,
            $nbAdult,
            [13_00, 50_00] // TODO: Get options price (new job)
        );
        $bookingPrice = CalculateBookingPrice::dispatchSync($bookingRequest);

        $booking ??= new booking();

        $booking->started_at = DateTime::createFromImmutable($startedAt);
        $booking->finished_at = DateTime::createFromImmutable($finishedAt);
        $booking->nb_adult = $bookingData['nb_adult'];
        $booking->nb_children = $bookingData['nb_children'];
        $booking->price = $bookingPrice;
        $booking->user_id = (string)Auth::id();
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
