<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablecms', function (Blueprint $table) {
            $table->increments('id',100);
            $table->text('cms_title')->nullable();
            $table->longText('cms_desc')->nullable();
            $table->enum('cms_status', array('yes', 'no'))->default('yes');
            $table->integer('cms_pid')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tablecms');
    }
}
