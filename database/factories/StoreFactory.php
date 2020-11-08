<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'part_number' => $this->faker->unique()->ean8,
            'description' => $this->faker->text(255),
            'qty' => $this->faker->numberBetween(1,1000),
            'enabled' => true
        ];
    }
}
