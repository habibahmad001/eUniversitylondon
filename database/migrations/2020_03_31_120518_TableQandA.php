<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableQandA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableqanda', function (Blueprint $table) {
            $table->increments('id', 100);
            $table->text('qa_title')->nullable();
            $table->longText('qa_desc')->nullable();
            $table->enum('qa_status', array('yes', 'no'))->default('yes');
            $table->integer('qa_cid')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tableqanda');
    }
}
