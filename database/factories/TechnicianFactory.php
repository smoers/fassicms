<?php

namespace Database\Factories;

use App\Models\Technician;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TechnicianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Technician::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => intval(Carbon::now('Europe/Brussels')->format('yymdHis')),
            'lastname' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'enabled' => true,
            'user_id' => 1
        ];
    }
}
