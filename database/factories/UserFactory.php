<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->lastname,
            'name' => $this->faker->firstname,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$hb40E4RvtWhUSDr5JG6kjudqSrIrUHCjRkfzAre4rs3w.wLht4QJS', // test
            'phone' => $this->faker->phoneNumber,
            'countries_id' => $this->faker->randomDigit(),
            'created_at' => $this->faker->dateTime(),
            'remember_token' => Str::random(10),
        ];
    }

    
    // public function isAdmin()
    // {
    //     return $this->state(function() {
    //         return [
    //           'is_admin' => true
    //         ];
    //     });
    // }

    // /**
    //  * Indicate that the model's email address should be unverified.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Factories\Factory
    //  */
    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }
}
