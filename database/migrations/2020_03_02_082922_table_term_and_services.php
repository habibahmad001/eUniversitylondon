<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableTermAndServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabletermandservices', function (Blueprint $table) {
            $table->increments('id',100);
            $table->text('termandservices_title')->nullable();
            $table->longText('termandservices_desc')->nullable();
            $table->enum('termandservices_status', array('yes', 'no'))->default('yes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabletermandservices');
    }
}
