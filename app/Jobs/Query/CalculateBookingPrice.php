<?php

namespace App\Jobs\Query;

use App\DTO\BookingRequestData;
use App\Models\Booking;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Validation\ValidationException;

class CalculateBookingPrice
{
    const BASE_SEASON = [
        'price' => 80_00
    ];

    use Dispatchable;

    private BookingRequestData $bookingRequest;

    public function __construct(BookingRequestData $bookingRequest)
    {
        $this->bookingRequest = $bookingRequest;
    }

    public function handle(): int
    {
        $nbAdults = $this->bookingRequest->nbAdults();
        $period = $this->bookingRequest->period();

        $hasBooking = Booking::query()->includePeriod($period)->exists();
        if ($hasBooking) {
            $message = 'Le créneau demandé est déjà réservé.';
            throw ValidationException::withMessages(['started_at' => $message]);
        }

        $finalPrice = 5_00 * ($nbAdults - 1);

        /** @var Collection $seasons */
        $seasons = Season::query()->includePeriod($period)->get();
        foreach ($period as $current) {
            $selectedSeason = $seasons
                    ->where('started_at', '<=', $current->format('Y-m-d'))
                    ->where('finished_at', '>=', $current->format('Y-m-d'))
                    ->toArray()[0] ?? self::BASE_SEASON;
            $finalPrice += $selectedSeason['price'];
        }

        $additionals = array_sum($this->bookingRequest->additionals());

        return (int) ($finalPrice + $additionals);
    }
}
