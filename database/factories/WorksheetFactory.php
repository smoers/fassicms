<?php

namespace Database\Factories;

use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorksheetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Worksheet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'number' => intval(Carbon::now('Europe/Brussels')->format('yymdHis'))
        ];
    }
}
