<?php

namespace App\DTO;

use DateInterval;
use DatePeriod;
use DateTimeImmutable;

class BookingRequestData
{
    public function __construct(
        private DateTimeImmutable $startedAt,
        private DateTimeImmutable $finishedAt,
        private int $nbAdults,
        private array $additionals
    ) {
        // EMPTY
    }

    public function nbAdults(): int
    {
        return $this->nbAdults;
    }

    public function additionals(): array
    {
        return $this->additionals;
    }

    public function period(): DatePeriod
    {
        return new DatePeriod(
            $this->startedAt,
            new DateInterval('P1D'),
            $this->finishedAt
        );
    }
}


