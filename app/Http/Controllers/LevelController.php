<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Level;
use Auth;

//Enables us to output flash messaging
use Session;

class LevelController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    
    public function index(Request $request){
        $data['sub_heading']  = 'Levels';
        $data['page_title']   = 'Super Quiz Levels';

        $data['levels']       = Level::paginate(10);

        return view('levels.index', $data);
    }

    public function store(Request $request){
        $levels         = new Level;
        $this->validate($request, [

            'level'=>'required|unique:levels',
            'level_name'=>'required'

        ]); 
        $levels->level  = $request->level;
        $levels->name  = $request->level_name;
        $saved          = $levels->save();
        if ($saved) {
         $request->session()->flash('message', 'Level successfully added!');
         return redirect('level');
        } else {
         return redirect()->back()->with('message', 'Couldn\'t create Category!');
        } 

    }

    public function isLevelExist(Request $request) {
      $level_name       = $request->level;  
      $id               = $request->id;
      $exist = false;
      if($id > 0){
        $level_record   = Level::where('level', $level_name)->where('id', '!=', $id)->first();
        if($level_record){
          $exist        = true;
        }

      } else {
          $level_record = Category::where('level', $level_name)->first();
          if($level_record){
            $exist      = true;
          }
      }

      return Response::json(['exist'=> $exist]);

    }

    public function create(){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function getLevel($id){
        $data           = [];   
        $level_record   = Level::find($id);
        $data['levels'] = $level_record;
        return Response::json($data);

    }
    public function update(Request $request){    
        $this->validate($request, [
            'level'=>'required|unique:levels,level,'.$request->level_id
        ]); 
      $level_data         = Level::find($request->level_id);

      $level_data->level  = $request->level;

      $level_data->name  = $request->level_name;

      $level_data->save();
      $request->session()->flash('message', 'Level successfully Edited!');
      return redirect('level');
    }

    public function destroy($id){
        $ids            = explode(',', $id);
        $ids_to_delete  = array_map(function($item){ return $item; }, $ids);
        Level::whereIn('id', $ids_to_delete)->delete();
        return redirect('level')->with('message', 'Selected level has been deleted successfully!');
    }


}
