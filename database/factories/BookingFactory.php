<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_users' => User::factory(),
            'started_at' => $this->faker->dateTime(),
            'finished_at' => $this->faker->dateTime(),
            'nb_night' => $this->faker->numberBetween(1, 20),
            'nb_adult' => $this->faker->numberBetween(1, 4),
            'nb_children' =>  $this->faker->numberBetween(1, 4),
            'payment_at' => $this->faker->dateTime,
            'price' => $this->faker->numberBetween(20, 500),
        ];
    }
}
