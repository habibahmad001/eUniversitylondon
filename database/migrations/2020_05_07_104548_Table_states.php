<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableStates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablestate', function (Blueprint $table) {
            $table->increments('id',100);
            $table->string('state_name', 256)->nullable();
            $table->integer('cid')->unsigned()->nullable();
            $table->enum('status', array('yes', 'no'))->default('yes');
            $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('cid')
                ->references('id')
                ->on('tablecountry')
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
        Schema::dropIfExists('tablestate');
    }
}
