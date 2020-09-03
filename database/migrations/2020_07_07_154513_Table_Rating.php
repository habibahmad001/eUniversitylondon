<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablerating', function (Blueprint $table) {
            $table->increments('id',100);
            $table->string('course_id', 250)->nullable();
            $table->string('user_id', 250)->nullable();
            $table->string('rating', 250)->nullable();
            $table->string('name', 250)->nullable();
            $table->text('ccomment')->nullable();
            $table->string('commentlevel', 250)->nullable();
            $table->enum('status', array('yes', 'no'))->default('yes');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tablerating');
    }
}
