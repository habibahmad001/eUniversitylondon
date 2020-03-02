<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablecategories', function (Blueprint $table) {
            $table->increments('id', 100);
            $table->text('category_title')->nullable();
            $table->longText('category_desc')->nullable();
            $table->enum('category_status', array('yes', 'no'))->default('yes');
            $table->integer('category_cid')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tablecategories');
    }
}
