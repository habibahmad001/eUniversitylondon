<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;



class UserNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'User:Notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify user to take test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $one_monthago   = '2017-11-29'; //date('Y-m-d',strtotime('-1 month', time() ));

      $last_use  =  DB::table('user_questions')
       ->Join('users', 'users.id', '=', 'user_questions.user_id')
       ->select('users.id','users.username','users.email', 'user_questions.user_id', 'user_questions.created_at','user_questions.session_id')
       ->where('user_questions.created_at', '<=', $one_monthago)
       ->whereNotIn('user_questions.user_id', function($query) use ($one_monthago)
      {

          $query->select(DB::raw('user_id'))
                ->from('user_questions')
                ->where('user_questions.created_at', '>' , $one_monthago);
      })
      ->groupBy('user_questions.user_id')
      ->get();

      foreach ($last_use as $user) {

        Mail::send('emails.mailExample', ['name' => $user->username,'email'=>$user->email], function($message) use ($user){
        $message->to($user->email);
        $message->subject('Super Quiz reminder');
       });

      
      }


        //$this->command->info('successfully create winner of this session!');

    }
}
