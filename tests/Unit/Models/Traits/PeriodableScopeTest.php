<?php

namespace Tests\Unit\Models\Traits;

use App\Models\Booking;
use DateInterval;
use DatePeriod;
use DateTimeImmutable;
use Tests\TestCase;

class PeriodableScopeTest extends TestCase
{
    public function test_start_period_is_include_between_sql_period(): void
    {
        $period = $this->createPeriod('2022-01-10', '2022-01-15');

        $bookingExpected = Booking::factory()->create([
            'started_at' => new DateTimeImmutable('2022-01-07'),
            'finished_at' => new DateTimeImmutable('2022-01-13')
        ]);

        $booking = Booking::query()->includePeriod($period)->first();

        $this->assertNotNull($booking);
        $this->assertSame($bookingExpected->id, $booking->id);
    }

    public function test_end_period_is_include_between_sql_period(): void
    {
        $period = $this->createPeriod('2022-01-10', '2022-01-15');

        $bookingExpected = Booking::factory()->create([
            'started_at' => new DateTimeImmutable('2022-01-13'),
            'finished_at' => new DateTimeImmutable('2022-01-19')
        ]);

        $booking = Booking::query()->includePeriod($period)->first();

        $this->assertNotNull($booking);
        $this->assertSame($bookingExpected->id, $booking->id);
    }

    public function test_period_include_outside_sql_period(): void
    {
        $period = $this->createPeriod('2022-01-07', '2022-01-18');

        $bookingExpected = Booking::factory()->create([
            'started_at' => new DateTimeImmutable('2022-01-10'),
            'finished_at' => new DateTimeImmutable('2022-01-15')
        ]);

        $booking = Booking::query()->includePeriod($period)->first();

        $this->assertNotNull($booking);
        $this->assertSame($bookingExpected->id, $booking->id);
    }

    public function test_period_should_not_include_in_sql_period(): void
    {
        $period = $this->createPeriod('2022-01-10', '2022-01-15');

        // Before
        Booking::factory()->create([
            'started_at' => new DateTimeImmutable('2022-01-07'),
            'finished_at' => new DateTimeImmutable('2022-01-09')
        ]);

        // After
        Booking::factory()->create([
            'started_at' => new DateTimeImmutable('2022-01-16'),
            'finished_at' => new DateTimeImmutable('2022-01-20')
        ]);

        $booking = Booking::query()->includePeriod($period)->first();

        $this->assertNull($booking);
    }

    private function createPeriod(string $start, string $finish): DatePeriod
    {
        $startedAt = new DateTimeImmutable($start);
        $finishedAt = new DateTimeImmutable($finish);

        return new DatePeriod(
            $startedAt,
            new DateInterval('P1D'),
            $finishedAt
        );
    }
}
