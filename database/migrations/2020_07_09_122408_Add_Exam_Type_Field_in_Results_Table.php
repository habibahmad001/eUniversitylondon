<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExamTypeFieldInResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tableresults', function (Blueprint $table) {
            $table->enum('examType', array('Exam', 'MockExam'))->default('Exam');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tableresults', function (Blueprint $table) {
            $table->dropColumn(['examType']);
        });
    }
}
