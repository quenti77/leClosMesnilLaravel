<?php

namespace Database\Factories;

use App\Models\User;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        $firstname = $this->faker->firstName();

        return [
            'is_admin' => false,
            'name' => $firstname,
            'last_name' => $this->faker->lastName(),
            'email' => Str::slug($firstname) . '@leclosmesnil.fr',
            'email_verified_at' => null,
            'password' => Hash::make('L3Cl0sM3ns1l'),
            'phone' => $this->faker->e164PhoneNumber(),
            'remember_token' => Hash::make(Str::uuid()->toString())
        ];
    }

    public function admin(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => true
        ]);
    }

    public function active(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => new DateTimeImmutable()
        ]);
    }
}
