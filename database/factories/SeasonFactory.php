<?php

namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
    protected $model = Season::class;

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

        return [
            'started_at' => $startedAt,
            'finished_at' => $finishedAt,
            'price' => $this->faker->numberBetween(50_00, 90_00)
        ];
    }
}
