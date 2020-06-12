<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableteams', function (Blueprint $table) {
            $table->increments('id',100);
            $table->text('teams_name')->nullable();
            $table->longText('teams_desc')->nullable();
            $table->text('teams_role')->nullable();
            $table->longText('teams_img')->nullable();
            $table->enum('teams_status', array('yes', 'no'))->default('yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tableteams');
    }
}
