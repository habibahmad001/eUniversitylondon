<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		
		    $file_n = app_path().'/../database/seeds/countriesandstates.json';
//            $file_n = './countriesandstates.json';
            $str = file_get_contents($file_n);
            $json = json_decode($str, true);
            $countindex = 0;
            foreach($json["countries"] as $v) {
    //            echo '<pre>' . $v["country"] . '</pre>';
    //            echo '<pre>' . print_r($v["states"], true) . '</pre>';
                $country_row = ["country_name" => $v["country"]];
                if(count($v["states"]) > 0) {
                    $country_id	=	DB::table('tablecountry')->insertGetId($country_row);
                    foreach($v["states"] as $val) {
                        $state_row = ["state_name" => $val, "cid" => $country_id];
                        DB::table('tablestate')->insert($state_row);
                    }

                } else {
                    DB::table('tablecountry')->insert($country_row);
                }
                $countindex++;
            }
        $this->command->info('Country and states data has been successfully inserted !!!');



        DB::table('users')->insert([[
                'id' => 1,
                'first_name' => 'Admin F',
                'last_name' => 'Admin L',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'admin',
                'password'=>bcrypt('123456'),
                'status'=>'active',
                'avatar'=>'1582622439.png',
                'remember_token'=>'F2spsX6xxi4dLf2PH0EsGw5nxheVJlepkKoqhK6ttr3GenJNMuD1WgPqsHHD',
                'created_at'=>'2019-12-13 18:38:53',
                'updated_at'=>'2020-03-16 15:07:05'
            ],[
                'id' => 2,
                'first_name' => 'Instructor F',
                'last_name' => 'Instructor L',
                'username' => 'instructor-f-instructor-l',
                'email' => 'instructor@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'instructor',
                'password'=>bcrypt('123456'),
                'status'=>'active',
                'avatar'=>'default.jpg',
                'remember_token'=>'F2spsX6xxi4dLf2PH0EsGw5nxheVJlepkKoqhK6ttr3GenJNMuD1WgPqsHHD',
                'created_at'=>'2020-04-22 02:06:46',
                'updated_at'=>'2020-04-22 02:06:46'
            ],[
                'id' => 3,
                'first_name' => 'learner F',
                'last_name' => 'learner L',
                'username' => 'learner-f-learner-l',
                'email' => 'learner@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'learner',
                'password'=>bcrypt('123456'),
                'status'=>'active',
                'avatar'=>'default.jpg',
                'remember_token'=>'F2spsX6xxi4dLf2PH0EsGw5nxheVJlepkKoqhK6ttr3GenJNMuD1WgPqsHHD',
                'created_at'=>'2020-04-22 02:06:46',
                'updated_at'=>'2020-04-22 02:06:46'
            ]]);

        $this->command->info('User table data seeded Success!');
    }
}
