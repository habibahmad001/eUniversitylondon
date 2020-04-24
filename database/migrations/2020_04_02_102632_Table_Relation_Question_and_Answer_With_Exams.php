<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRelationQuestionAndAnswerWithExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tableqanda', function (Blueprint $table) {
            $table->integer('exam_qa_id')->unsigned()->nullable();
            $table->enum('table_name', array('Exam', 'MockExam'))->default('Exam');

            $table->foreign('exam_qa_id')
                ->references('id')
                ->on('tableexam')
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
        Schema::table('tableqanda', function (Blueprint $table) {
            $table->dropColumn(['exam_qa_id']);
        });
    }
}
