<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCourseStarted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablecoursestarted', function (Blueprint $table) {
            $table->increments('id',100);
            $table->string('course_id', 100)->nullable();
            $table->string('user_id', 100)->nullable();
            $table->string('CourseProgramID', 256)->nullable();
            $table->enum('CourseCompleted', array('yes', 'no'))->default('no');
            $table->enum('isActive', array('yes', 'no'))->default('yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tablecoursestarted');
    }
}