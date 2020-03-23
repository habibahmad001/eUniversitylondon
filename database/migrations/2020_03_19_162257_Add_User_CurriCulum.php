<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserCurriCulum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tablecurriculum', function (Blueprint $table) {
            $table->integer('curriculum_user_id')->unsigned()->nullable();

            $table->foreign('curriculum_user_id')
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
        Schema::table('tablecurriculum', function (Blueprint $table) {
            $table->dropColumn(['curriculum_user_id']);
        });
    }
}
