<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablecomments', function (Blueprint $table) {
            $table->increments('id',100);
            $table->string('name', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('subComment', 250)->nullable();
            $table->text('message')->nullable();
            $table->text('liked')->nullable();
            $table->enum('isActive', array('yes', 'no'))->default('yes');
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
        Schema::dropIfExists('tablecomments');
    }
}
