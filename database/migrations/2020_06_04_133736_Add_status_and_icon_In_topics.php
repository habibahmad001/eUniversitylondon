<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusAndIconInTopics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabletopics', function (Blueprint $table) {
            $table->string('selectedicon',255)->nullable();
            $table->enum('topics_status', array('yes', 'no'))->default('yes');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tabletopics', function (Blueprint $table) {
            $table->dropColumn(['selectedicon', 'topics_status']);
        });
    }
}
