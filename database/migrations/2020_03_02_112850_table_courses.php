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
            $table->integer('category_id')->unsigned();
            $table->integer('course_curriculum_id')->unsigned();
            $table->text('course_title')->nullable();
            $table->longText('course_desc')->nullable();
            $table->text('created_company')->nullable();
            $table->longText('what_you_learn')->nullable();
            $table->text('course_includes')->nullable();
            $table->text('course_requirements')->nullable();
            $table->text('course_for')->nullable();
            $table->text('course_price')->nullable();
            $table->text('course_discounted_price')->nullable();
            $table->enum('course_status', array('yes', 'no'))->default('yes');

            $table->foreign('category_id')
                ->references('id')
                ->on('tablecategories')
                ->onDelete('cascade');

            $table->foreign('course_curriculum_id')
                ->references('id')
                ->on('tablecurriculum')
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
        Schema::dropIfExists('tablecourses');
    }
}
