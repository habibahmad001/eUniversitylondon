<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMexamWithUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablemexamwithuser', function (Blueprint $table) {
            $table->increments('id',100);
            $table->integer('mexam_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();

            $table->foreign('mexam_id')
                ->references('id')
                ->on('tablemexam')
                ->onDelete('cascade');

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
        Schema::dropIfExists('tablemexamwithuser');
    }
}
