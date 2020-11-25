<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionReasonReassortementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('reassortements', function (Blueprint $table) {
            $table->string('note',255)->nullable();
            $table->unsignedBigInteger('reason_id');
            $table->foreign('reason_id')
                ->references('id')
                ->on('reasons')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reassortements', function (Blueprint $table) {
            $table->dropColumn(['note','reason_id']);
        });
    }
}
