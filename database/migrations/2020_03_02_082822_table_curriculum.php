<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCurriculum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablecurriculum', function (Blueprint $table) {
            $table->increments('id',100);
            $table->integer('course_id')->unsigned();
            $table->text('curriculum_title')->nullable();
            $table->longText('curriculum_content')->nullable();
            $table->enum('curriculum_status', array('yes', 'no'))->default('yes');

            $table->foreign('course_id')
                ->references('id')
                ->on('tablecourses')
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
        Schema::dropIfExists('tablecurriculum');
    }
}
