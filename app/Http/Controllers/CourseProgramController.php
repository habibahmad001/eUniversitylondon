<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\CourseProgram;
use App\Courses;

use Auth;

use Session;

class CourseProgramController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Curriculum';
        $data['page_title']   = 'eUniversitylondon Curriculum';
        if(collect(request()->segments())->first() == 'instructor') {
            $data['CourseProgram']          =  CourseProgram::where('cp_status', "yes")->paginate(10);
        } else {
            $data['CourseProgram']          =  CourseProgram::where('cp_status', "yes")->paginate(10);
        }
        $data['Courses']        =  Courses::where('course_status', "yes")->get();

        /**************** Get Course Name **************/
        $Array_Course_Name           =  array();
        foreach($data['CourseProgram'] as $CourseProgram_data) {
            if(!empty($CourseProgram_data->course_id)) {
                $Course_Name        =  Courses::where('id', $CourseProgram_data->course_id)->first();
                if(isset($Course_Name->course_title)) {
                    $Array_Course_Name[$CourseProgram_data->id] = $Course_Name->course_title;
                }
            }
        }
        $data['Array_Course_Name']           =  $Array_Course_Name;
        /**************** Get Course Name **************/

        return view('courseprogram/index', $data);
    }

    public function CourseProgramAdd(Request $request){
        $CourseProgram         = new CourseProgram;
        $this->validate($request, [

            'title'=>'required',
            'desc'=>'required',
            'author'=>'required',
            'placement'=>'required',
            'cour_id'=>'required'
        ]);

        $CourseProgram->cp_title  = $request->title;
        $CourseProgram->cp_desc  = $request->desc;
        $CourseProgram->cp_author  = $request->author;
        $CourseProgram->cp_placement  = $request->placement;
        $CourseProgram->course_id  = $request->cour_id;

        $saved          = $CourseProgram->save();
        if ($saved) {
            $request->session()->flash('message', '$Course Program successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/courseprogram');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Course Program!');
        }
    }

    public function GetCourseProgram($id){
        $data         = [];
        $CourseProgram         = CourseProgram::find($id);
        $data['CourseProgram'] = $CourseProgram;
        return Response::json($data);
    }

    public function UpdateCourseProgram(Request $request){
        $id              =        $request->cp_id;
        $this->validate($request, [
            'title'=>'required',
            'desc'=>'required',
            'author'=>'required',
            'placement'=>'required',
            'cour_id'=>'required'
        ]);
        $CourseProgram              = CourseProgram::find($id);

        $CourseProgram->cp_title  = $request->title;
        $CourseProgram->cp_desc  = $request->desc;
        $CourseProgram->cp_author  = $request->author;
        $CourseProgram->cp_placement  = $request->placement;
        $CourseProgram->course_id  = $request->cour_id;

        $saved              = $CourseProgram->save();

        if ($saved) {
            $request->session()->flash('message', 'Course Program was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/courseprogram');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Course Program!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $CourseProgram = CourseProgram::findOrFail($id);
        $CourseProgram->delete();
        return redirect('/' . collect(request()->segments())->first() . '/courseprogram')->with('message', 'Selected Course Program has been deleted successfully!');
    }

}
