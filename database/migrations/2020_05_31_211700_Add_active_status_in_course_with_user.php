<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveStatusInCourseWithUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tableuserwithcourse', function (Blueprint $table) {
            $table->enum('isActive', array('yes', 'no'))->default('yes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tableuserwithcourse', function (Blueprint $table) {
            $table->dropColumn(['isActive']);
        });
    }
}
