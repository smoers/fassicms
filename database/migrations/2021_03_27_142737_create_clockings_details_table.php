<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClockingsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clockings_details', function (Blueprint $table) {
            $table->id();
            $table->date('date')->index();
            $table->dateTime('date_time')->index();
            $table->string('action',1)->index();
            $table->string('status',1)->default('A')->index();
            $table->unsignedBigInteger('worksheet_id');
            $table->foreign('worksheet_id')
                ->references('id')
                ->on('worksheets')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->unsignedBigInteger('technician_id');
            $table->foreign('technician_id')
                ->references('id')
                ->on('technicians')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('clockings_details');
    }
}
