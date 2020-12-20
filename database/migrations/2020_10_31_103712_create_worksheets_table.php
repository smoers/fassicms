<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('worksheets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number')->unique();
            $table->date('date')->nullable();
            $table->text('remarks')->nullable();
            $table->text('work')->nullable();
            $table->integer('oil_replace')->unsigned()->default(0);
            $table->boolean('oil_filtered')->default(false);
            $table->boolean('validated')->default(false);
            $table->dateTime('validated_date')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('crane_id')->nullable();
            $table->foreign('crane_id')
                ->references('id')
                ->on('cranes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::dropIfExists('worksheets');
    }
}
