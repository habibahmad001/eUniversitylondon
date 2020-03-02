<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


use App\User;
use Auth;
use DB;
use Faker\Factory as Faker;

//Enables us to output flash messaging
use Session;

class FakerController extends Controller {

    public function __construct() {
    $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources

    }
   
    public function index() {
     $faker = Faker::create();
     $limit = 20;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->userName,
                'email' => $faker->unique()->email,
                'phone' => $faker->phoneNumber,
                'user_type' => 'user',
                'password'=>'123456'
            ]);
        }

      echo 'users inserted';
    }

   
}
