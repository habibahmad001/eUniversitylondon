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
        if(collect(request()->segments())->first() == 'instructor')
            $data['Curriculums']        =  CourseCurriculum::where('curriculum_user_id', Auth::user()->id)->paginate(10);
        else
            $data['Curriculums']        =  CourseCurriculum::paginate(10);
        $data['Courses']        =  Courses::All();
        /**************** Get Course Name **************/
        $Array_Course_Name           =  array();
        foreach($data['Curriculums'] as $Curriculums_data) {
            if(!empty($Curriculums_data->course_id)) {
                $Course_Name        =  Courses::where('id', $Curriculums_data->course_id)->first();
                $Array_Course_Name[$Curriculums_data->id] = $Course_Name->course_title;
            }
        }
        $data['Array_Course_Name']           =  $Array_Course_Name;
        /**************** Get Course Name **************/

        /**************** Get instructor Name **************/
        $Array_Instructor_Name           =  array();
        foreach($data['Curriculums'] as $course_data) {
            if(!empty($course_data->curriculum_user_id)) {
                $Instructor_Name        =  User::where('id', $course_data->curriculum_user_id)->first();
                $Array_Instructor_Name[$course_data->id] = $Instructor_Name->first_name . " " . $Instructor_Name->last_name;
            }
        }
        $data['Array_Instructor_Name']           =  $Array_Instructor_Name;
        /**************** Get instructor Name **************/
        return view('curriculum/index', $data);
    }

    public function CurriCulumAdd(Request $request){
        $CurriCulums         = new CourseCurriculum;
        $this->validate($request, [

            'cur_title'=>'required',
            'cur_content'=>'required',
            'cour_id'=>'required'
        ]);
        $CurriCulums->curriculum_title  = $request->cur_title;
        $CurriCulums->curriculum_content  = $request->cur_content;
        $CurriCulums->course_id  = $request->cour_id;
        $CurriCulums->curriculum_user_id  = Auth::user()->id;
        $saved          = $CurriCulums->save();
        if ($saved) {
            $request->session()->flash('message', 'Curriculum successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/curriculum');
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
            return redirect('/' . collect(request()->segments())->first() . '/curriculum');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create CurriCulums!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $CurriCulums = CourseCurriculum::findOrFail($id);
        $CurriCulums->delete();
        return redirect('/' . collect(request()->segments())->first() . '/curriculum')->with('message', 'Selected Curriculum has been deleted successfully!');
    }

}
