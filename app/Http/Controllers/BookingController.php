<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use App\Models\Booking;
use App\Models\Season;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
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
        $bookings = Booking::all();
        return view('booking', compact('bookings'));
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
        $startedAt = $bookingData['started_at'];
        $finishedAt = $bookingData['finished_at'];
        $nbAdult = $bookingData['nb_adult'];
        $booking ??= new booking();

        $booking->started_at = $startedAt;
        $booking->finished_at = $finishedAt;
        $booking->nb_adult = $bookingData['nb_adult'];
        $booking->nb_children = $bookingData['nb_children'];
        $booking->price = $this->makeWithData($startedAt, $finishedAt, $nbAdult);
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

    /**
     * @param string $startedAt
     * @param string $finishedAt
     * @param int $nbAdult
     * @return int
     * @throws Exception
     */
    public function makeWithData(string $startedAt, string $finishedAt, int $nbAdult): int
    {
        $baseSeason = [
            'price' => 80_00
        ];

        $period = new DatePeriod(
            new DateTime($startedAt),
            new DateInterval('P1D'),
            new DateTime($finishedAt)
        );

        $finalPrice = 5_00 * ($nbAdult - 1);

        /** @var Collection $seasons */
        $seasons = Season::query()->includePeriod($period)->get();
        foreach ($period as $current) {
            $selectedSeason = $seasons
                ->where('started_at', '<=', $current->format('Y-m-d'))
                ->where('finished_at', '>=', $current->format('Y-m-d'))
                ->toArray()[0] ?? $baseSeason;
            $finalPrice += $selectedSeason['price'];
        }

        return $finalPrice;
    }
}
