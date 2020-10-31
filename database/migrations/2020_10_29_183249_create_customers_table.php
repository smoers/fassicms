<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('address',100);
            $table->string('address_optional',100)->nullable();
            $table->string('city',50);
            $table->string('zipcode',10);
            $table->string('country',100)->default('BELGIQUE');
            $table->string('mail',100)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('mobile',15)->nullable();
            $table->string('vat',15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
