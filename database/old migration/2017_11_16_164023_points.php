<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Points extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id',100);
			$table->integer('user_id')->unsigned();
			$table->string('regular_point',255);
			$table->string('super_point',255);
			$table->timestamps();
			
			// user_id foreign key
			
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
        Schema::dropIfExists('points');
    }
}
