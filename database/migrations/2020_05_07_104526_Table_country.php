<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablecountry', function (Blueprint $table) {
            $table->increments('id',100);
            $table->string('country_name', 256)->nullable();
            $table->enum('status', array('yes', 'no'))->default('yes');
            $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tablecountry');
    }
}
