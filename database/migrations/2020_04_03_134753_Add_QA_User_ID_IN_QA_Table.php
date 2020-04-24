<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQAUserIDINQATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tableqanda', function (Blueprint $table) {
            $table->integer('qa_user_id')->unsigned()->nullable();

            $table->foreign('qa_user_id')
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
        Schema::table('tableqanda', function (Blueprint $table) {
            $table->dropColumn(['qa_user_id']);
        });
    }
}
