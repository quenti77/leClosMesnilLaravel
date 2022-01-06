<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        $startedAt = $this->faker->dateTimeBetween('+1 day', '+20 day');

        $useStartedAt = (clone $startedAt);
        $finishedAt = $this->faker->dateTimeBetween(
            $useStartedAt->format('Y-m-d'),
            $useStartedAt->modify('+20 day')->format('Y-m-d')
        );

        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        return [
            'user_id' => User::factory()->active(),
            'started_at' => $startedAt,
            'finished_at' => $finishedAt,
            'nb_adult' => $this->faker->numberBetween(1, 4),
            'nb_children' => $this->faker->numberBetween(0, 3),
            'payment_at' => null,
            'price' => $this->faker->numberBetween(50_00, 90_00)
        ];
    }
}
