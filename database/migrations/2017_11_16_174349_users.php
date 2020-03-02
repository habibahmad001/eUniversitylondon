<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('users', function (Blueprint $table) {
            $table->increments('id',100);
			$table->string('username',255)->nullable();
			$table->string('first_name',255)->nullable();
			$table->string('last_name',255)->nullable();
			$table->string('email');
			$table->string('phone',255)->nullable();
			$table->string('password',255);
            $table->string('avatar')->default('default.jpg');
			$table->enum('status', array('active', 'inactive'))->nullable();
            $table->string('confirmation_code',255)->nullable();
			$table->string('user_type',255)->nullable();
			$table->rememberToken();
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
         Schema::dropIfExists('users');
    }
}
