<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesInCourseWithUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tableuserwithcourse', function (Blueprint $table) {
            $table->dateTime('created_at')->default('CURRENT_TIMESTAMP')->nullable()->change();
            DB::statement('ALTER TABLE `tableuserwithcourse` CHANGE `updated_at` `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
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
            $table->dropTimestamps();
        });
    }
}
