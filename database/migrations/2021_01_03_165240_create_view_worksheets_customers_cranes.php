<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB;

class CreateViewWorksheetsCustomersCranes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }

    /**
     * @return string
     */
    private function createView(): string
    {
        return <<<'SQL'
            CREATE VIEW `view_worksheets_customers_cranes` AS
                SELECT
                    worksheets.id,
                    worksheets.number,
                    worksheets.date,
                    YEAR(worksheets.date) AS year,
                    worksheets.validated,
                    worksheets.validated_date,
                    customers.id as customer_id,
                    customers.name,
                    cranes.id as crane_id,
                    cranes.serial,
                    cranes.plate
                FROM worksheets
                LEFT JOIN customers on worksheets.customer_id = customers.id
                LEFT JOIN cranes on worksheets.crane_id = cranes.id;
        SQL;
    }

    private function dropView(): string
    {
        return <<<'SQL'
                DROP VIEW IF EXISTS `view_worksheets_customers_cranes`;
        SQL;

    }
}
