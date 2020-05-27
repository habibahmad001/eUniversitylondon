<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUserAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableuseraddress', function (Blueprint $table) {
            $table->increments('id', 100);
            $table->string('user_id', 100)->nullable();
            $table->text('b_street_address')->nullable();
            $table->string('b_country', 150)->nullable();
            $table->string('b_state', 150)->nullable();
            $table->text('b_city')->nullable();
            $table->string('b_zip', 150)->nullable();
            $table->text('s_street_address')->nullable();
            $table->string('s_country', 150)->nullable();
            $table->string('s_state', 150)->nullable();
            $table->text('s_city')->nullable();
            $table->string('s_zip', 150)->nullable();
            $table->enum('status', array('yes', 'no'))->default('yes');
            $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tableuseraddress');
    }
}
