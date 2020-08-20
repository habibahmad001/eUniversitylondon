<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCoupans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablecoupans', function (Blueprint $table) {
            $table->increments('id',100);
            $table->string('title', 250)->nullable();
            $table->string('value', 250)->nullable();
            $table->timestamp('startsFrom')->nullable();
            $table->timestamp('endsTo')->nullable();
            $table->text('ccomments')->nullable();
            $table->enum('status', array('yes', 'no'))->default('yes');
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
        Schema::dropIfExists('tablecoupans');
    }
}
