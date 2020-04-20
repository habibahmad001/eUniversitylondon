<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableTestimonial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabletestimonial', function (Blueprint $table) {
            $table->increments('id',100);
            $table->text('testimonial_name')->nullable();
            $table->longText('testimonial_desc')->nullable();
            $table->text('testimonial_role')->nullable();
            $table->enum('testimonial_status', array('yes', 'no'))->default('yes');
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
        Schema::dropIfExists('tabletestimonial');
    }
}
