<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('outs', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('qty_pull');
            $table->unsignedSmallInteger('qty_before');
            $table->unsignedBigInteger('reason_id');
            $table->foreign('reason_id')
                ->references('id')
                ->on('reasons')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')
                ->references('id')
                ->on('stores')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->timestamps();

            $table->index('reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outs');
    }
}
