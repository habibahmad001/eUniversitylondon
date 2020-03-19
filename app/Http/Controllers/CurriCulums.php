<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\CourseCurriculum;
use App\Courses;

use Auth;

use Session;

class CurriCulums extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Curriculum';
        $data['page_title']   = 'eUniversitylondon Curriculum';
        $data['Curriculums']        =  CourseCurriculum::paginate(10);
        $data['Courses']        =  Courses::All();
        return view('curriculum/index', $data);
    }

    public function CurriCulumAdd(Request $request){ //exit($request->axaxa);
        $CurriCulums         = new CourseCurriculum;
        $this->validate($request, [

            'cur_title'=>'required',
            'cur_content'=>'required',
            'cour_id'=>'required'
        ]);
        $CurriCulums->curriculum_title  = $request->cur_title;
        $CurriCulums->curriculum_content  = $request->cur_content;
        $CurriCulums->course_id  = $request->cour_id;
        $saved          = $CurriCulums->save();
        if ($saved) {
            $request->session()->flash('message', 'Curriculum successfully added!');
            return redirect('/admin/curriculum');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Curriculum!');
        }
    }

    public function GetCurriCulum($id){
        $data         = [];
        $CurriCulums         = CourseCurriculum::find($id);
        $data['CurriCulums'] = $CurriCulums;
        return Response::json($data);
    }

    public function UpdateCurriCulum(Request $request){
        $id              =        $request->cc_id;
        $this->validate($request, [
            'cur_title'=>'required',
            'cur_content'=>'required',
            'cour_id'=>'required'
        ]);
        $CurriCulums              = CourseCurriculum::find($id);
        $CurriCulums->curriculum_title  = $request->cur_title;
        $CurriCulums->curriculum_content  = $request->cur_content;
        $CurriCulums->course_id  = $request->cour_id;
        $saved              = $CurriCulums->save();
        if ($saved) {
            $request->session()->flash('message', 'CurriCulums was successful edited!');
            return redirect('/admin/curriculum');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create CurriCulums!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $CurriCulums = CourseCurriculum::findOrFail($id);
        $CurriCulums->delete();
        return redirect('/admin/curriculum')->with('message', 'Selected Curriculum has been deleted successfully!');
    }

}
