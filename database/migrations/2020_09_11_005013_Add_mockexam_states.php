<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMockexamStates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tablemockexam', function (Blueprint $table) {
            $table->string('ExamDuration', 256)->nullable();
            $table->string('TotalMarks', 256)->nullable();
            $table->string('PassingMarks', 256)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tablemockexam', function (Blueprint $table) {
            $table->dropColumn(['ExamDuration']);
            $table->dropColumn(['TotalMarks']);
            $table->dropColumn(['PassingMarks']);
        });
    }
}
