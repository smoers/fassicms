<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCatalogStorePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_store', function (Blueprint $table) {
            $table->unsignedBigInteger('catalog_id')->index();
            $table->foreign('catalog_id')->references('id')->on('catalogs')->onDelete('cascade');
            $table->unsignedBigInteger('store_id')->index();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->primary(['catalog_id', 'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_store');
    }
}
