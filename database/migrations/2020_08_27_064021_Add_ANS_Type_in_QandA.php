<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddANSTypeInQandA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tableqanda', function (Blueprint $table) {
            $table->text('AnsType')->nullable();
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
            $table->dropColumn(['AnsType']);
        });
    }
}
