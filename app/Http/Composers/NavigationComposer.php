<?php

namespace App\Http\Composers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


use Auth;
use DB;
use App\User;
use App\steak;
use App\Session;
use App\Question;
use App\User_Question;
use App\Super_Points;
use App\Regular_Points;
use App\Experience_Points;

class NavigationComposer{

    
    public function compose($view){

        $id = Auth::user()->id; 
        $records = DB::table('user_questions')->where('created_at', '=', date('Y-m-d'))->where('user_id',$id)->get()->count();
        $res_last_ans = DB::table('user_questions')->where('created_at', '=', date('Y-m-d'))->where('user_id',$id)->orderBy("id", "desc")->take(1)->get();
       

        if($records >= 3){

            $data['QuestionMsg'] = "Today Questions are completed!";
            $data['level'] =  0;
        }

        if(count($res_last_ans) > 0 && $res_last_ans[0]->is_correct == 0)
        {
            $data['QuestionMsg'] = "Come Back Tomorrow to Try Again";
            $data['level'] =  0;
            $data['istrue'] = 0;
        }

        $data['check_test'] = $records;
        

        $score = DB::table('user_questions')
                    ->join('questions', 'user_questions.question_id', '=', 'questions.id')
                    ->select('questions.question','questions.answer','user_questions.user_id','user_questions.is_correct','user_questions.created_at','user_questions.level_id')
                    ->where('user_questions.created_at', '=', date('Y-m-d'))
                    ->where('user_questions.user_id',Auth::user()->id)
                    ->get();
        $data['scores']  = $score;
        $points          = 0;
        $is_correct      = 0;
        foreach ($data['scores'] as $sco) {

            if($sco->is_correct==1){
                $is_correct     = $is_correct+1;
                if($sco->level_id==1){
                    $points     =   $points+1;
                }else if($sco->level_id==2){
                   $points     =   $points+2; 
                }
                else if($sco->level_id==3){
                   $points     =   $points+3; 
                }
            }           
        }

        $data['points']      = $points;
        $data['is_correct']  = $is_correct;


        /******** User XP *******/
        $xp_res = Experience_Points::where("user_id", Auth::user()->id)->first();
        if(count($xp_res) > 0)
        {
            $data['xp_res'] =  $xp_res;
            $data['xp_bar'] =  (( $xp_res->xp_point  / $xp_res->level_up_xp ) * 100);
        } else {
            $data['xp_res'] =  $xp_res;
            $data['xp_bar'] =  0;
        }
        /******** User XP *******/

        /****** XP points **********/
        $resxp = steak::where("user_id", Auth::user()->id)->get();
        if(count($resxp) > 0)
        {
            $data['xp_point'] =  $resxp[0]->steak_point;
        } else {
            $data['xp_point'] =  0;
        }
        /****** XP points **********/


        $uq_res = user_question::where('user_id', Auth::user()->id)->where('is_correct', 1)->get();
        $points = 0;
          foreach ($uq_res as $single) {
            if($single->level_id==1){
              $points = $points+1;
            }else if($single->level_id==2){
              $points = $points+2;
            }else if($single->level_id==3){
              $points = $points+3;
          }
        }
      $data['totalpoints'] = $points;
      $data['superpoints'] = floor($points/100);
      $view->with($data);

    }
   
   
}
