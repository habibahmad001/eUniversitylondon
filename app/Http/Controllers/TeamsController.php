<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;



use App\Teams;

use Auth;

class TeamsController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Teams';
        $data['page_title']   = 'eUniversitylondon Teams';
        $data['Teams']        =  Teams::paginate(10);
        
        return view('teams/index', $data);
    }

    public function TeamsAdd(Request $request){
        $Teams         = new Teams;
        $this->validate($request, [

            't_name'=>'required',
            't_desc'=>'required',
            't_role'=>'required'
        ]);

        $Teams->teams_name  = $request->t_name;
        $Teams->teams_desc  = $request->t_desc;
        $Teams->teams_role  = $request->t_role;

        /************ Image Upload ***********/
        if(!empty($request->file('t_img'))) {
            $TeamsImg = $request->file('t_img');
            $TeamsImg_new_name = rand() . '.' . $TeamsImg->getClientOriginalExtension();
            $Teams->teams_img = $TeamsImg_new_name;
            $TeamsImg->move('uploads/teams', $TeamsImg_new_name);
        }
        /************ Image Upload ***********/

        $saved          = $Teams->save();

        if ($saved) {
            $request->session()->flash('message', 'Teams successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/teams');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Teams!');
        }
    }

    public function GetTeams($id){
        $data         = [];
        $Teams         = Teams::find($id);
        $data['Teams'] = $Teams;
        return Response::json($data);
    }


    public function UpdateTeams(Request $request){
        $id              =        $request->t_id;
        $this->validate($request, [
            't_name'=>'required',
            't_desc'=>'required',
            't_role'=>'required'
        ]);
        $Teams              = Teams::find($id);
        $Teams->teams_name  = $request->t_name;
        $Teams->teams_desc  = $request->t_desc;
        $Teams->teams_role  = $request->t_role;

        /************ Image Upload ***********/
        if(!empty($request->file('t_img'))) {
            if(!empty($Teams->teams_img)) {
                (file_exists('uploads/teams/' . $Teams->teams_img)) ? unlink('uploads/teams/' . $Teams->teams_img) : "";
            }
            $TeamsImg = $request->file('t_img');
            $TeamsImg_new_name = rand() . '.' . $TeamsImg->getClientOriginalExtension();
            $Teams->teams_img = $TeamsImg_new_name;
            $TeamsImg->move('uploads/teams', $TeamsImg_new_name);
        }
        /************ Image Upload ***********/

        $saved              = $Teams->save();

        if ($saved) {
            $request->session()->flash('message', 'Teams was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/teams');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Teams!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Teams = Teams::findOrFail($id);
        if(!empty($Teams->teams_img)) {
            (file_exists('uploads/teams/' . $Teams->teams_img)) ? unlink('uploads/teams/' . $Teams->teams_img) : "";
        }
        $Teams->delete();
        return redirect('/' . collect(request()->segments())->first() . '/teams')->with('message', 'Selected Teams has been deleted successfully!');
    }
}
