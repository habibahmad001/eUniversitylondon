<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserExam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tableexam', function (Blueprint $table) {
            $table->integer('exam_user_id')->unsigned()->nullable();

            $table->foreign('exam_user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('tableexam', function (Blueprint $table) {
            $table->dropColumn(['exam_user_id']);
        });
    }
}
