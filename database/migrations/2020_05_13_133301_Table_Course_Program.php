<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCourseProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablecourseprogram', function (Blueprint $table) {
            $table->increments('id',100);
            $table->string('course_id', 100)->nullable();
            $table->text('cp_title')->nullable();
            $table->text('cp_author')->nullable();
            $table->longText('cp_desc')->nullable();
            $table->string('cp_placement', 150)->nullable();
            $table->enum('cp_status', array('yes', 'no'))->default('yes');
            $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('course_id')
                ->references('id')
                ->on('tablecourses')
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
        Schema::dropIfExists('tablecourseprogram');
    }
}
