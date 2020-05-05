<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\steak;
use App\Experience_Points;
use App\User_Question;
use App\Rule_Contents;
use App\User;

class Rules extends Controller
{
    public function index() {

    	$data['sub_heading']  = 'Rules';
    	$data['page_title']   = 'Rules';
    	if (Auth::check()) {
    	
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
        /********* Total and Super Points ********/
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
        /********* Total and Super Points ********/


       }
        $data['rules']        =  Rule_Contents::first();
        return view('userquestion.rules', $data);

       
    }

    public function checkUsername(Request $request){
      $user           = User::where('username', $request->username)->first();
      if($user){
          echo 'false';
      }else{
         echo 'true';
      }

    }

    public function checkUserEmail(Request $request){
      $email           = User::where('email', $request->email)->first();
      if($email){
          echo 'false';
      }else{
         echo 'true';
      }
      
    }

    public function manage_rules(){

      $data['sub_heading']  = 'Manage Rules';
      $data['page_title']   = 'Mange Rules';
      $data['rules']        =  Rule_Contents::where('id',1)->first();

      return view('rules.index', $data); 

    }

    public function post_rule(Request $request){

        $this->validate($request, [

            'page_title'=>'required',
            'content'=>'required'

        ]); 

        if(!empty($request->page_id)){

          $rules              = Rule_Contents::find($request->page_id);
          $rules->page_title  = $request->page_title;
          $rules->content     = $request->content;
          $saved              = $rules->save(); 
          if ($saved) {
           $request->session()->flash('message', 'Page has been successful edited!');
           return redirect('manage-rules');
          } else {
           return redirect()->back()->with('error', 'Error while edit the page');
          } 
        }else{

          $rules              = new Rule_Contents;
          $rules->page_title  = $request->page_title;
          $rules->content     = $request->content;
          $saved              = $rules->save();
          if ($saved) {
           $request->session()->flash('message', 'Page successfully added!');
           return redirect('manage-rules');
          } else {
           return redirect()->back()->with('message', 'Couldn\'t create Page!');
          } 
        }

        

    }

}
