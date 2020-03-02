<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableExam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableexam', function (Blueprint $table) {
            $table->increments('id',100);
            $table->integer('course_id')->unsigned();
            $table->text('exam_title')->nullable();
            $table->longText('exam_content')->nullable();
            $table->enum('exam_status', array('yes', 'no'))->default('yes');
            $table->integer('exam_eid')->nullable();

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
        Schema::dropIfExists('tableexam');
    }
}
