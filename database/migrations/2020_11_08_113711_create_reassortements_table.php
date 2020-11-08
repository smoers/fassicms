<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReassortementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('reassortements', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('qty_add');
            $table->unsignedSmallInteger('qty_before');
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')
                ->references('id')
                ->on('stores')
                ->onUpdate('restrict')
                ->onDelete('restrict');
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
        Schema::dropIfExists('reassortements');
    }
}
