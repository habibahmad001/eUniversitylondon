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
		
		  $file_n = app_path().'/../database/seeds/questions.csv';
          $file = fopen($file_n, "r");
          $all_data = array();
          while ( ($data = fgetcsv($file, 200, ",")) !==FALSE) {
			 fputcsv($file, $data);
			 $level_id	=	'';
			 $cateory_id	=	''; 
			 $level = DB::table('levels')->select('level')->where('level', $data[0])->first();
			 
			 if($level){
			 $level_id	=	$level->level;
			 }else{
        if($data[0]==1){
          $levelname  = 'Freshman';
        }else if($data[0]==2){
          $levelname  = 'Graduate';
        }else if($data[0]==3){
          $levelname  = 'Ph.D';
        }
			 $level_row = ["level" => $data[0],"name"=>$levelname];
			 $getid	=	DB::table('levels')->insert($level_row);
			 $level_id = $data[0];
			 	 
			 }
			 $category = DB::table('categories')->select('id')->where('category', $data[3])->count();
			 if($category==0){
		     $category_row = ["category" => $data[3]];
			 $category_id	=	DB::table('categories')->insertGetId($category_row);
			 }else{
			 $category_id = DB::table('categories')->select('id')->where('category', $data[3])->first()->id;	 
			 }
			 
			 $question = htmlentities($data[2]);
			
             $single_row = ["level_id" => $level_id, "category_id" => $category_id,"question"=>$question, "answer" => $data[1]];
			 
             DB::table('questions')->insert($single_row);
			 array_push($all_data, $single_row);
           }
           fclose($file);
		  
           DB::table('questions')->insert($all_data);
           $this->command->info('Questions table seeded!');

       //     	$faker = Faker::create();
     		// $limit = 20;
       //  	for ($i = 0; $i < $limit; $i++) {
       //  	if($i==0){
       //  		$user_type	=	'admin';
       //  	}else{
       //  		$user_type	=	'user';
       //  	}
       //      DB::table('users')->insert([
       //          'first_name' => $faker->firstName,
       //          'last_name' => $faker->lastName,
       //          'username' => $faker->userName,
       //          'email' => $faker->unique()->email,
       //          'phone' => $faker->phoneNumber,
       //          'user_type' => $user_type,
       //          'password'=>bcrypt('123456')
       //      ]);
       //  }
       //  $this->command->info('users inserted!');


        DB::table('users')->insert([[
                'id' => 1,
                'first_name' => 'mark1',
                'last_name' => 'davis1',
                'username' => 'markdavis1',
                'email' => 'markspicer1@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'admin',
                'password'=>bcrypt('123456'),
                'status'=>'active'
            ],[
                'id' => 2,
                'first_name' => 'mark2',
                'last_name' => 'spicer2',
                'username' => 'mspicer2',
                'email' => 'markspicer2@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'user',
                'password'=>bcrypt('123456'),
                'status'=>'active'
            ],[
                'id' => 3,
                'first_name' => 'mark3',
                'last_name' => 'spicer3',
                'username' => 'mspicer3',
                'email' => 'markspicer3@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'user',
                'password'=>bcrypt('123456'),
                'status'=>'active'
            ],[
                'id' => 4,
                'first_name' => 'mark4',
                'last_name' => 'spicer4',
                'username' => 'mspicer4',
                'email' => 'markspicer4@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'user',
                'password'=>bcrypt('123456'),
                'status'=>'active'
            ],[
                'id' => 5,
                'first_name' => 'mark5',
                'last_name' => 'spicer5',
                'username' => 'mspicer5',
                'email' => 'markspicer5@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'user',
                'password'=>bcrypt('123456'),
                'status'=>'active'
            ],[
                'id' => 6,
                'first_name' => 'mark6',
                'last_name' => 'spicer6',
                'username' => 'mspicer6',
                'email' => 'markspicer6@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'user',
                'password'=>bcrypt('123456'),
                'status'=>'active'
            ],[
                'id' => 7,
                'first_name' => 'mark7',
                'last_name' => 'spicer7',
                'username' => 'mspicer7',
                'email' => 'markspicer7@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'user',
                'password'=>bcrypt('123456'),
                'status'=>'active'
            ],[
                'id' => 8,
                'first_name' => 'mark8',
                'last_name' => 'spicer8',
                'username' => 'mspicer8',
                'email' => 'markspicer8@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'user',
                'password'=>bcrypt('123456'),
                'status'=>'active'
            ],[
                'id' => 9,
                'first_name' => 'mark9',
                'last_name' => 'spicer9',
                'username' => 'mspicer9',
                'email' => 'markspicer9@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'user',
                'password'=>bcrypt('123456'),
                'status'=>'active'
            ],[
                'id' => 10,
                'first_name' => 'mark10',
                'last_name' => 'spicer10',
                'username' => 'mspicer10',
                'email' => 'markspicer10@gmail.com',
                'phone' => '905-697-5170',
                'user_type' => 'user',
                'password'=>bcrypt('123456'),
                'status'=>'active'
            ]]);

        $this->command->info('User table data seeded Success!');




        DB::table('sessions')->insert([[
                'id' => 1,
                'start_date' => '2017-01-01',
                'end_date' => '2017-03-31',
                'status' => 'inactive'
            ],[
                'id' => 2,
                'start_date' => '2017-04-01',
                'end_date' => '2017-06-30',
                'status' => 'inactive'
            ],[
                'id' => 3,
                'start_date' => '2017-07-01',
                'end_date' => '2017-09-30',
                'status' => 'inactive'
            ],[
                'id' => 4,
                'start_date' => '2017-10-01',
                'end_date' => '2017-12-31',
                'status' => 'inactive'
            ],[
                'id' => 5,
                'start_date' => '2018-01-01',
                'end_date' => '2018-03-31',
                'status' => 'active'
            ]]);

              $this->command->info('Session table data seeded Success!');
    }
}
