<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;



class AnouncedWinner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Anounced:Winner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Winner of current session';

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
        $active_session = DB::table('sessions')->where('status','active')->first();
      $start_date     = $active_session->start_date;
      $end_date       = $active_session->end_date;
     
      $winner = DB::table('user_questions')
            ->Join('users', 'users.id', '=', 'user_questions.user_id')
            ->Join('regular_points', 'users.id', '=', 'regular_points.user_id')
            ->Join('super_points', 'users.id', '=', 'super_points.user_id')
            ->select('users.id','users.username', 'user_questions.user_id', 'user_questions.created_at','user_questions.is_correct','user_questions.session_id','regular_points.regular_point','regular_points.session_id','super_points.superpoint','super_points.session_id')
             ->where('user_questions.created_at', '>=', $start_date)
            ->where('user_questions.created_at', '<=', $end_date)
            ->where('user_questions.session_id', '=', $active_session->id)
            ->where('regular_points.session_id', '=', $active_session->id)
            ->where('super_points.session_id', '=', $active_session->id)
            ->where('super_points.session_id', '=', $active_session->id)
            ->groupBy('user_questions.user_id')
            ->orderBy('super_points.superpoint', 'desc')
            ->orderBy('regular_points.regular_point', 'desc')
            ->take(5)
            ->get();
     
      $points        = 10;
      foreach ($winner as $win) {


        DB::table('session_winners')->insert(
        ['user_id' => $win->user_id, 'session_id' => $win->session_id,'assigned_superpoint'=> $points]
        );

        DB::table('super_points')->where('user_id', $win->user_id)->update(['superpoint' => DB::raw("superpoint + $points")]);
       $points   = $points-2;
       
       }

       DB::table('sessions')->where('status', 'active')->update(array('status' => 'inactive'));




        //$this->command->info('successfully create winner of this session!');

    }
}
