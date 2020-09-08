<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableQuiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablequiz', function (Blueprint $table) {
            $table->increments('id',100);
            $table->integer('course_id')->unsigned();
            $table->string('quiz_user_id', 256)->nullable();
            $table->text('quiz_title')->nullable();
            $table->longText('quiz_content')->nullable();
            $table->enum('quiz_status', array('yes', 'no'))->default('yes');
            $table->dateTime('quiz_date')->nullable();

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
        Schema::dropIfExists('tablequiz');
    }
}
