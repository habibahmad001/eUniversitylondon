<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablecart', function (Blueprint $table) {
            $table->increments('id',100);
            $table->string('session_id', 150)->nullable();
            $table->string('key', 150)->nullable();
            $table->longText('val')->nullable();
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
        Schema::dropIfExists('tablecart');
    }
}
