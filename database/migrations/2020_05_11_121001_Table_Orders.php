<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableorders', function (Blueprint $table) {
            $table->increments('id',100);
            $table->string('user_id', 100)->nullable();
            $table->string('key', 150)->nullable();
            $table->longText('val')->nullable();
            $table->string('order_id', 150)->nullable();
            $table->string('order_items', 150)->nullable();
            $table->enum('order_state', array('Processing', 'Completed', "On hold", "Failed"))->default('Completed');
            $table->enum('status', array('yes', 'no'))->default('yes');
            $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('tableorders');
    }
}
