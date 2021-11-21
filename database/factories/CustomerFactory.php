<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
            'address' => $this->faker->address,
            'zipcode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country' => 'Belgique',
            'mail' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'mobile' => $this->faker->e164PhoneNumber,
            'user_id' => 1,
            'vat' => 'BE177.255.255'
        ];
    }
}
