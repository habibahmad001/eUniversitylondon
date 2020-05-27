<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


use Auth;
use DB;
use App\User;
use App\steak;
use App\cart;
use App\Question;
use App\User_Question;
use App\Super_Points;
use App\Regular_Points;
use App\Experience_Points;
//Enables us to output flash messaging

class QuestionUserController extends Controller {

    public function __construct() { 

        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission 

    }
   
    public function index() {

        $id = Auth::user()->id;
        $data['sub_heading']  = 'Questions';
        $data['page_title']   = 'Super Quiz Questions';
      
        $records = DB::table('user_questions')->where('created_at', '=', date('Y-m-d'))->where('user_id',$id)->get()->count();

        $res_last_ans = DB::table('user_questions')->where('created_at', '=', date('Y-m-d'))->where('user_id',$id)->orderBy("id", "desc")->take(1)->get();
        $res_last_ans = json_decode($res_last_ans, true);
       
        /****** XP points **********/
        $resxp = steak::where("user_id", $id)->get();
        if(count($resxp) > 0)
        {
            $data['xp_point'] =  $resxp[0]->steak_point;
        } else {
            $data['xp_point'] =  0;
        }
        /****** XP points **********/
        
        
        
        $level_id   =   0;
        if($records==0){
        $level_id   =   1;
        }else if($records==1){
           $level_id   =   2; 
        }else if($records==2){
           $level_id   =   3; 
        }

        $data['level'] =  $level_id;

        /********* Total and Super Points ********/
          $uq_res = user_question::where('user_id', $id)->where('is_correct', 1)->get();
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
        /********* Total and Super Points ********/


        $data['QuestionMsg'] = "";
        $data['istrue'] = 1;
        if($records >= 3){

            $data['QuestionMsg'] = "Today Questions are completed!";
            $data['level'] =  0;
        }

        if(count($res_last_ans) > 0 && $res_last_ans[0]["is_correct"] == 0)
        {
            $data['QuestionMsg'] = "Last answer was wrong!";
            $data['level'] =  0;
            $data['istrue'] = 0;
        }

        if((isset($_REQUEST["sess"]) && $_REQUEST["sess"] == "inactive"))
        {
            $data['QuestionMsg'] = "All session are inactive at this time!";
            $data['level'] =  0;
            $data['istrue'] = 0;
        }

        $data['uid'] =  $id;

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
        

        $data['users']        =  DB::select( DB::raw("SELECT * FROM questions WHERE id NOT IN ( SELECT question_id FROM user_questions WHERE user_id=$id) and level_id=$level_id ORDER BY RAND() LIMIT 1") );
  
        return view('userquestion/index', $data);
    }

    public function ready_quiz(){

        $data['sub_heading']  = 'Ready to play';
        $id = Auth::user()->id; 

        $records = DB::table('user_questions')->where('created_at', '=', date('Y-m-d'))->where('user_id',$id)->get()->count();
        $res_last_ans = DB::table('user_questions')->where('created_at', '=', date('Y-m-d'))->where('user_id',$id)->orderBy("id", "desc")->take(1)->get();
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

      return view('userquestion.readytoplay', $data);
        
    }

    public function score(){
        $data['sub_heading']  = 'Score';
        $score = DB::table('user_questions')
                    ->join('questions', 'user_questions.question_id', '=', 'questions.id')
                    ->select('questions.question','questions.answer','user_questions.user_id','user_questions.is_correct','user_questions.answer as your_answer','user_questions.created_at','user_questions.level_id')
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

        /******** Total and Super Points *******/

        return view('users.score', $data);
    }


    public function dashboard() {

        $data['sub_heading']  = 'LeaderBoard';

        $id = Auth::user()->id; 

        $records = DB::table('user_questions')->where('created_at', '=', date('Y-m-d'))->where('user_id',$id)->get()->count();

        $res_dt =  DB::select( DB::raw("SELECT *,datediff(CURDATE(), start_date) as dta FROM sessions WHERE status='active'") );
        
        
        $level_id   =   0;
        if($records==0){
        $level_id   =   1;
        }else if($records==1){
           $level_id   =   2; 
        }else if($records==2){
           $level_id   =   3; 
        }

        $uq_res = regular_points::where('user_id', $id)->get();


        $data['level'] =  $level_id;

        if(count($res_dt) > 0)
        {
            $data['nodays'] = $res_dt[0]->dta;
        } else {
            $data['nodays'] = 0;
        }

        if(count($uq_res) > 0)
        {
            //$uq_res = 200;
            $data['totalpoints'] = $uq_res[0]->regular_point;
            $data['superpoints'] = floor($uq_res[0]->regular_point/100);
        }
        else
        {
            $data['totalpoints'] = 0;
            $data['superpoints'] = 0;
        }

        DB::enableQueryLog();
            $data['reports'] = DB::table('super_points')
                    ->join('regular_points', 'super_points.user_id', '=', 'regular_points.user_id')
                    ->join('users', 'super_points.user_id', '=' , 'users.id')
                    ->join('user_experience_points', 'super_points.user_id', '=' , 'user_experience_points.user_id')
                    ->select('users.id','users.username','regular_points.regular_point','regular_points.session_id','super_points.superpoint','super_points.session_id','user_experience_points.user_level', DB::raw('(SELECT SUM(super_points.superpoint) FROM super_points WHERE regular_points.user_id = super_points.user_id) as total_superpoint'),DB::raw('(SELECT SUM(regular_points.regular_point) FROM regular_points WHERE regular_points.user_id = super_points.user_id) as total_regular_points'))
                    ->groupBy('regular_points.user_id')
                    ->orderBy("total_superpoint", "desc")
                    ->orderBy("total_regular_points", "desc")
                    ->get();

             


        if(count($res_dt) > 0)
        {
                    
             $data['month_res'] = DB::table('users')
            ->join('regular_points', 'regular_points.user_id', '=' , 'users.id')
            ->join('user_experience_points', 'user_experience_points.user_id', '=' , 'users.id')
            ->select('users.id', 'users.username','regular_points.regular_point','regular_points.session_id','user_experience_points.user_level')
            ->where('regular_points.session_id', '=',$res_dt[0]->id)
            ->groupBy('users.id')
            ->orderBy('regular_points.regular_point','DESC')
            ->get();
               
        }
        else
        {
            $data["regular_points"] = array();
            $data['month_res'] = array();
            $data['res_msg'] = "All session are inactive at this time !!!";
            $data["one_monthago"] = date('M/d',strtotime('-1 month', time() ));
            $data["current_month"] = date('M/d',time());
        }

        $score = DB::table('user_questions')
                    ->join('questions', 'user_questions.question_id', '=', 'questions.id')
                    ->select('questions.question','user_questions.answer','user_questions.user_id','user_questions.is_correct','user_questions.created_at','user_questions.level_id')
                    ->where('user_questions.created_at', '=', date('Y-m-d'))
                    ->where('user_questions.user_id',Auth::user()->id)
                    ->get();
        $data['scores']  = $score;
        if($records > 0){

            $data['QuestionMsg'] = "Today Questions are completed!";
        }

  
        return view('userquestion/leaderboard', $data);
    }


    public function edit_user($id){
        $user           = User::find($id); //Get user with specified id
        $data['user']   =   $user;
        return view('users.edit',$data); //pass user and roles data to view
    }


    public function store(Request $request) {

        $res_session = cart::where('status', "active")->get();

        if(count($res_session) === 0)
        {
            return redirect("/userquestion?sess=inactive");
        }

        $res_in_chk = user_question::where('question_id', $request->qid)->where('user_id', $request->uid)->where('level_id', $request->lev)->where('created_at', date("Y-m-d"))->get();
        if(count($res_in_chk) > 0)
        {
            return redirect("/userquestion");
        }
        else
        {
                /************ Entry in Question points **************/
                $uqobj = new user_question();

                $id = Auth::user()->id;

                $uqobj->question_id =  $request->qid;
                $uqobj->user_id     =  $request->uid;
                $uqobj->session_id  =  $res_session[0]->id; 
                $uqobj->answer      =  trim($request->ans); 
                $res_correct        = Question::where('id', $request->qid)->where('answer',$request->ans)->get()->count();

                $new_ans = 0;
                if( $res_correct > 0 )
                {
                    $new_ans = 1;
                }
                
                $uqobj->is_correct =  $new_ans;
                $uqobj->level_id =  $request->lev;

                $uqobj->save();
                /************ Entry in Question points **************/



                /*********** Entry in Experience points *************/

                 $xpPointData = Experience_Points::where("user_id", $id)->first();
                 if(COUNT($xpPointData)== 0){
                    $xp_data = new Experience_Points();
                    $xp_data->user_id       =  $id;
                    $xp_data->user_level    =  1;
                    $xp_data->xp_point      =  1;
                    $xp_data->save();

                 }else{
                    $xp_update = Experience_Points::where("user_id", $id)->first();
                    $xp_update->xp_point      =  $xpPointData->xp_point+1;
                    $xp_update->save();

                    $xpAfterUpdate     = Experience_Points::where("user_id", $id)->first();


                    if($xpAfterUpdate->xp_point==$xpAfterUpdate->level_up_xp){
                         $xp_afterupdate                   =    Experience_Points::where("user_id", $id)->first();
                         $xp_afterupdate->user_level       =   $xpPointData->user_level+1;
                         $require_percentage               =   ($xpAfterUpdate->req_percentage/100)*120;
                         $xp_afterupdate->req_percentage   =   $require_percentage;
                         $xp_afterupdate->level_up_xp      =   $xpAfterUpdate->level_up_xp+$require_percentage;
                         $xp_afterupdate->save();


                    }
                 }

                 /*********** End Experience points *************/



                /************ Entry in steak points **************/
                if($new_ans == 1)
                { 

                    $chkxp = steak::where("user_id", $id)->get();
                    
                    if(count($chkxp) > 0 ){
                        $xpobj = steak::where("user_id", $id)->first();
                        $ste = $xpobj->steak_point;
                    } else {
                        $xpobj = new steak();
                        $ste = 0;
                    }

                    $xpobj->user_id =  $id;
                    $xpobj->steak_point =  $ste + 1;

                    $xpobj->save(); 
                } else {

                    $xpobj_chk = steak::where("user_id", $id)->get();

                    if( COUNT($xpobj_chk) > 0 ){
                        $xpobj = steak::where("user_id", $id)->first();
                    } else {
                        $xpobj = new steak();
                    }
                    
                    $xpobj->user_id =  Auth::user()->id;
                    $xpobj->steak_point =  0;

                    $xpobj->save();
                }
                /************ Entry in steak points **************/



                /************ Entry in Regular points **************/
                if($new_ans == 1)
                {
                    $chkrp = Regular_Points::where("user_id", $id)->where('session_id', $res_session[0]->id)->get();
                
                    if( COUNT($chkrp) > 0 ){
                        $rpobj = Regular_Points::where("user_id", $id)->where("session_id", $res_session[0]->id)->first();
                        $totpoints = $chkrp[0]["regular_point"] + $request->lev;
                    } else {
                        $rpobj = new Regular_Points();
                        $totpoints = $request->lev;
                    }

                    $rpobj->regular_point =  $totpoints;
                    $rpobj->user_id =  $request->uid;
                    $rpobj->session_id =  $res_session[0]->id;

                    $rpobj->save();

                } else {

                    $chkrp = Regular_Points::where("user_id", $id)->where('session_id', $res_session[0]->id)->get();
                
                    if( COUNT($chkrp) > 0 ){
                        $rpobj = Regular_Points::where("user_id", $id)->where("session_id", $res_session[0]->id)->first();
                        $totpoints = $chkrp[0]["regular_point"] + 0;
                    } else {
                        $rpobj = new Regular_Points();
                        $totpoints = 0;
                    }

                    $rpobj->regular_point =  $totpoints;
                    $rpobj->user_id =  Auth::user()->id;
                    $rpobj->session_id =  $res_session[0]->id;

                    $rpobj->save();

                }
                /************ Entry in Regular points **************/



                /************ Entry in Super points **************/
                if($new_ans == 1)
                {
                    $rp_res = Regular_Points::where('user_id', $id)->where('session_id', $res_session[0]->id)->first();
                    $superpoints = floor($rp_res->regular_point/100); 

                    $chksp = Super_Points::where("user_id", $id)->where("session_id", $res_session[0]->id)->get();
                    
                    if(count($chksp) > 0 ){
                        $spobj = Super_Points::where("user_id", $id)->where("session_id", $res_session[0]->id)->first();
                    } else {
                        $spobj = new Super_Points();
                    }

                    $spobj->user_id =  $id;
                    $spobj->superpoint =  $superpoints;
                    $spobj->session_id =  $res_session[0]->id;

                    $spobj->save(); 
                    
                } else {

                    $rp_res = Regular_Points::where('user_id', $id)->where('session_id', $res_session[0]->id)->first();
                    $superpoints = floor($rp_res->regular_point/100); 

                    $chksp = Super_Points::where("user_id", $id)->where("session_id", $res_session[0]->id)->get();
                    
                    if(count($chksp) > 0 ){
                        $spobj = Super_Points::where("user_id", $id)->where("session_id", $res_session[0]->id)->first();
                    } else {
                        $spobj = new Super_Points();
                    }

                    $spobj->user_id =  Auth::user()->id;
                    $spobj->superpoint =  $superpoints;
                    $spobj->session_id =  $res_session[0]->id;

                    $spobj->save(); 
                }
                /************ Entry in Super points **************/

                // $sp = array($id, $superpoints);
                // $uqobj->super_points()->attach($sp);
            

                
            //Redirect to the users.index view and display message
        }        return redirect("result");

    }

    public function result(){

       $data['sub_heading']  = 'Result';
        $id = Auth::user()->id; 

        $records = DB::table('user_questions')->where('created_at', '=', date('Y-m-d'))->where('user_id',$id)->get()->count();
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

      $data['check_question'] = user_question::where("user_id", Auth::user()->id)
      ->where('created_at', '=', date('Y-m-d'))
      ->orderBy('id','DESC')
      ->first();
      if(count($data['check_question'])>0){

      $data['questions'] = DB::table('user_questions')
                    ->join('questions', 'user_questions.question_id', '=', 'questions.id')
                    ->select('questions.question','questions.answer','user_questions.user_id','user_questions.is_correct','user_questions.answer as your_answer','user_questions.created_at','user_questions.level_id')
                    ->where('user_questions.question_id', '=',$data['check_question']->question_id)
                    ->first();
     $data['count_question'] = user_question::where("user_id", Auth::user()->id)
      ->where('created_at', '=', date('Y-m-d'))
      ->orderBy('id','DESC')
      ->count();

      
      }else{
         return redirect('ready-to-play');
      }




      return view('userquestion.result', $data);
    }

    
    public function show($id) {
        return redirect('users');
    }

    public function usersearch($searchstring) {
        
        if($searchstring == "<>")
        {
            $searchstring = "";
        }
        $res_dt =  DB::select( DB::raw("SELECT *,datediff(CURDATE(), start_date) as dta FROM sessions WHERE status='active'") );

        $one_monthago   = date('Y-m-d', strtotime( $res_dt[0]->start_date ));
        $data["one_monthago"] = date('M/d', strtotime( $res_dt[0]->start_date ));
        $data["current_month"] = date('M/d', strtotime( $res_dt[0]->end_date ));
        $current_date   = date('Y-m-d', strtotime( $res_dt[0]->end_date ));
        $data['month_res'] = DB::table('user_questions')
                            ->join("users", 'users.id', '=', 'user_questions.user_id')
                            ->select('users.id', 'users.username','user_questions.user_id','user_questions.is_correct','user_questions.created_at','user_questions.level_id', DB::raw("count(user_questions.level_id) as ranking"))
                            ->where('user_questions.created_at', '>=', $one_monthago)
                            ->where('user_questions.created_at', '<=', $current_date)
                            ->where('user_questions.is_correct', '=',1)
                            ->where('users.username', 'like', '%' . $searchstring . '%')
                            ->groupBy('user_questions.user_id')
                            ->orderBy('ranking','DESC')
                            ->take(10)
                            ->get();
        
        $point_array      = array();

        

          foreach ($data['month_res'] as $reg) {

            $single_point = DB::table('user_questions')
                            ->where('created_at', '>=', $one_monthago)
                            ->where('created_at', '<=', $current_date)
                            ->where('is_correct', '=',1)
                            ->where('user_id', '=',$reg->id)->get();
            

         $regular_points=0;

                foreach ($single_point as $single) {

                    if($single->level_id==1){

                      $regular_points = $regular_points+1;



                    }else if($single->level_id==2){

                      $regular_points = $regular_points+2;
                     

                    }else if($single->level_id==3){

                      $regular_points = $regular_points+3;

                    }


                  
                }

            $point_array[$reg->user_id]  = $regular_points;
           
          }


          $data["regular_points"] = $point_array;

          $returnHTML = view('userquestion.tablesearchmonth',$data)->render();
          
          return response()->json(array('success' => true, 'html'=>$returnHTML));
          //print_r($data);
    }


    public function usersearchall($searchstring) {

        if($searchstring == "<>")
        {
            $searchstring = "";
        }


        DB::enableQueryLog();
        $users = DB::table('users')->join('user_questions', 'users.id', '=', 'user_questions.user_id')->join('regular_points', 'users.id', '=', 'regular_points.user_id')->join('super_points', 'users.id', '=', 'super_points.user_id')->select('users.id','users.username', 'user_questions.user_id', 'user_questions.created_at','user_questions.is_correct','regular_points.regular_point','super_points.superpoint')
            ->where('users.username', 'like', '%' . $searchstring . '%')
            ->groupBy('users.id')
            ->orderBy("regular_points.regular_point", "desc");

         $data['reports']  = $users->paginate(10);


          $returnHTML = view('userquestion.tablesearchall',$data)->render();
          
          return response()->json(array('success' => true, 'html'=>$returnHTML));
          //print_r($data);
    }

    
    public function edit($id) {
        $user           = User::find($id); //Get user with specified id
        $data['user']   =   $user;
        return view('users.edit',$data); //pass user and roles data to view
    }

    public function update(Request $request, $id = null) {
        if(!$id) $id = Auth::user()->id;
        $user = User::findOrFail($id); //Get role specified by id
        //Validate name, email and password fields
        $this->validate($request, [
            'first_name'=>'required|max:120',
            'last_name'=>'required|max:120',
            'username'=>'required|unique:users,username,'.$id,
            'email'=>'required|email|unique:users,email,'.$id
        ]);

        $input = $request->only(['first_name', 'last_name', 'email', 'password', 'country_id', 'state_id', 'city_id']); //Retreive the name, email and password fields
        // $roles = $request['roles']; //Retreive all roles
        if($user->fill($input)->save()){
        $request->session()->flash('message', 'User was successful Edited!');
        return redirect('users');
        }else{
        return redirect()->back()->with('error', 'Couldn\'t create organization!');

        }

    }

    
    public function destroy($id) {
    //Find a user with a given id and delete
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('users')->with('message', 'Selected category has been deleted successfully!');
    }

    public function my_account() {
      $id                     = Auth::user()->id;
      $user                   = User::findOrFail($id); //Get user with specified id
      $data                   = [];
      $data['countries']      = Country::orderBy('name')->get();
      $data['states']         = State::where('country_id', $user->country_id)->orderBy('name')->get();
      $data['cities']         = City::where('state_id', $user->state_id)->orderBy('name')->get();
      $data['is_reload_btn']  = 0;
      $data['is_plus_icon']   = 0;
      $data['sub_heading']    = 'My Account';
      $data['page_title']     = 'My Account - National Installations Portal';
      $data['user']           = $user;
      return view('accounts.index', $data);
    }
}
