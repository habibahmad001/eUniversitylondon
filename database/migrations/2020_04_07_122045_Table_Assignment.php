<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableAssignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableassignment', function (Blueprint $table) {
            $table->increments('id',100);
            $table->integer('exam_id')->unsigned();
            $table->text('assignment_title')->nullable();
            $table->longText('assignment_file')->nullable();
            $table->longText('table_name')->nullable();
            $table->enum('assignment_status', array('yes', 'no'))->default('yes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tableassignment');
    }
}
