<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserMockExam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tablemockexam', function (Blueprint $table) {
            $table->integer('mexam_user_id')->unsigned()->nullable();

            $table->foreign('mexam_user_id')
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
        Schema::table('tablemockexam', function (Blueprint $table) {
            $table->dropColumn(['mexam_user_id']);
        });
    }
}
