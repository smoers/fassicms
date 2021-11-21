<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Customer;
use App\Models\Provider;
use App\Models\Store;
use App\Models\Worksheet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        /*Store::factory()
            ->has(Catalog::factory()->count(2))
            ->count(10)
            -> create();
        */
        //Provider::factory()->count(10)->create();
        Customer::factory(20)->create();
        //Worksheet::factory(1)->create();
    }
}
