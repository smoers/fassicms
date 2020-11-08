<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->decimal('price',7,2);
            $table->unsignedSmallInteger('year');
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')
                ->references('id')
                ->on('stores')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->timestamps();

            $table->index('year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogs');
    }
}
