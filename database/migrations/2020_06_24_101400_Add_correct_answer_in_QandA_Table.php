<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCorrectAnswerInQandATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tableqanda', function (Blueprint $table) {
            $table->enum('isCorrect', array('yes', 'no'))->default('no');
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
            $table->dropColumn(['isCorrect']);
        });
    }
}
