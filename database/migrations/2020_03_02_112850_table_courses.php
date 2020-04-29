<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablecourses', function (Blueprint $table) {
            $table->increments('id',100);
            $table->string('category_id', 256)->nullable();
            $table->string('course_avatar', 256)->nullable();
            $table->text('course_title')->nullable();
            $table->longText('course_desc')->nullable();
            $table->string('course_lectures', 256)->nullable();
            $table->string('course_language', 256)->nullable();
            $table->string('course_video', 256)->nullable();
            $table->string('course_duration', 256)->nullable();
            $table->string('course_includes', 256)->nullable();
            $table->string('course_price', 256)->nullable();
            $table->string('course_discounted_price', 256)->nullable();
            $table->enum('course_status', array('yes', 'no'))->default('yes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tablecourses');
    }
}
