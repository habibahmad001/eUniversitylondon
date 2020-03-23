<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUserWithCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableuserwithcourse', function (Blueprint $table) {
            $table->increments('id',100);
            $table->integer('course_id')->nullable();
            $table->integer('user_id')->nullable();

            $table->foreign('course_id')
                ->references('id')
                ->on('tablecourses')
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
        Schema::dropIfExists('tableuserwithcourse');
    }
}
