<?php

namespace Tests\Unit\Jobs\Query;

use App\DTO\BookingRequestData;
use App\Jobs\Query\CalculateBookingPrice;
use App\Models\Booking;
use App\Models\Season;
use DateTimeImmutable;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CalculateBookingPriceTest extends TestCase
{
    public function test_if_booking_already_exist_in_period_should_throw_an_exception(): void
    {
        $this->expectException(ValidationException::class);

        Booking::factory()->create([
            'started_at' => new DateTimeImmutable('2022-01-07'),
            'finished_at' => new DateTimeImmutable('2022-01-13')
        ]);

        $bookingRequest = $this->createBookingRequest('2022-01-05', '2022-01-10', 2);
        $job = new CalculateBookingPrice($bookingRequest);
        $job->handle();
    }

    public function test_return_price_without_season(): void
    {
        $bookingRequest = $this->createBookingRequest('2022-01-05', '2022-01-10', 2);
        $job = new CalculateBookingPrice($bookingRequest);
        $price = $job->handle();

        // Price = (Base Season price * nbDay) + (nbAdults - 1) * 5
        $this->assertSame(405_00, $price);
    }

    public function test_return_price_with_season(): void
    {
        Season::factory()->create([
            'started_at' => new DateTimeImmutable('2022-01-01'),
            'finished_at' => new DateTimeImmutable('2022-01-20'),
            'price' => 100_00
        ]);

        $bookingRequest = $this->createBookingRequest('2022-01-05', '2022-01-10', 3);
        $job = new CalculateBookingPrice($bookingRequest);
        $price = $job->handle();

        $this->assertSame(510_00, $price);
    }

    public function test_return_price_with_partial_season(): void
    {
        Season::factory()->create([
            'started_at' => new DateTimeImmutable('2022-01-07'),
            'finished_at' => new DateTimeImmutable('2022-01-12'),
            'price' => 100_00
        ]);

        $bookingRequest = $this->createBookingRequest('2022-01-05', '2022-01-10', 1);
        $job = new CalculateBookingPrice($bookingRequest);
        $price = $job->handle();

        $this->assertSame(460_00, $price);
    }

    public function test_include_additionals_in_final_price(): void
    {
        $additionals = [20_00, 50_00, 30_00];
        $bookingRequest = $this->createBookingRequest('2022-01-05', '2022-01-10', 2, $additionals);
        $job = new CalculateBookingPrice($bookingRequest);
        $price = $job->handle();

        // Price = (Base Season price * nbDay) + (nbAdults - 1) * 5
        $this->assertSame(505_00, $price);
    }

    private function createBookingRequest(
        string $start,
        string $finish,
        int $nbAdults,
        array $additionals = []
    ): BookingRequestData {
        return new BookingRequestData(
            new DateTimeImmutable($start),
            new DateTimeImmutable($finish),
            $nbAdults,
            $additionals
        );
    }
}
