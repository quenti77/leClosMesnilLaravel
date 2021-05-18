<?php

namespace Database\Factories;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use PragmaRX\Countries\Package\Countries;
use PragmaRX\Countries\Package\Services\Config;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

    }
}
