<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomerPhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW customer_phones AS
        SELECT customer.id ,customer.name , countries.name as country_name, SUBSTRING(phone, LOCATE('(', phone) + 1, LOCATE(')', phone) - LOCATE('(', phone) - 1) AS country_code,
        SUBSTRING(phone, LOCATE(')', phone) + 2, LENGTH(phone)-1) AS phone_number ,
        IF(phone REGEXP regex, 'Valid', 'Invalid') as state from customer
        INNER JOIN countries on countries.code =  SUBSTRING(phone, LOCATE('(', phone) + 1, LOCATE(')', phone) - LOCATE('(', phone) - 1)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW customer_phones");
    }
}
