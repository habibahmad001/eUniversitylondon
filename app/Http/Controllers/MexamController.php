<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\MockExam;
use App\Courses;
use App\MexamWithUser;

use Auth;

use Session;

class MexamController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Exam';
        $data['page_title']   = 'eUniversitylondon Exam';
        if(collect(request()->segments())->first() == 'instructor') {
            $data['Exams']        =  MockExam::where('mexam_user_id', Auth::user()->id)->paginate(10);
            $data['Courses']        =  Courses::where('course_user_id', Auth::user()->id)->get();
        } elseif(collect(request()->segments())->first() == 'learner') {
            $data['Exams']        =  MexamWithUser::join('tablemockexam', 'tablemexamwithuser.mexam_id', '=', 'tablemockexam.id')
                ->select('*')
                ->where('tablemexamwithuser.user_id', '=', Auth::user()->id)
                ->paginate(10);
            $data['Courses']        =  Courses::All();
        } else {
            $data['Exams']        =  MockExam::paginate(10);
            $data['Courses']        =  Courses::All();
        }
        /**************** Get Course Name **************/
        $Array_Course_Name           =  array();
        foreach($data['Exams'] as $exam_data) {
            if(!empty($exam_data->course_id)) {
                $Course_Name        =  Courses::where('id', $exam_data->course_id)->first();
                if(isset($Course_Name->course_title)) {
                    $Array_Course_Name[$exam_data->id] = $Course_Name->course_title;
                }
            }
        }
        $data['Array_Course_Name']           =  $Array_Course_Name;
        /**************** Get Course Name **************/

        /**************** Get instructor Name **************/
        $Array_Instructor_Name           =  array();
        foreach($data['Exams'] as $course_data) {
            if(!empty($course_data->mexam_user_id)) {
                $Instructor_Name        =  User::where('id', $course_data->mexam_user_id)->first();
                if(isset($Instructor_Name->first_name)) {
                    $Array_Instructor_Name[$course_data->id] = $Instructor_Name->first_name . " " . $Instructor_Name->last_name;
                }
            }
        }
        $data['Array_Instructor_Name']           =  $Array_Instructor_Name;
        /**************** Get instructor Name **************/
        return view('mockexam/index', $data);
    }

    public function MexamsAdd(Request $request){
        $Exam         = new MockExam;
        $this->validate($request, [

            'exe_title'=>'required',
            'exe_content'=>'required',
            'cour_id'=>'required'
        ]);
        $Exam->exam_title  = $request->exe_title;
        $Exam->exam_content  = $request->exe_content;
        $Exam->course_id  = $request->cour_id;
        $Exam->mexam_user_id  = Auth::user()->id;

        $saved          = $Exam->save();
        if ($saved) {
            $request->session()->flash('message', 'Mock Exam successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/mexam');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Mock Exam!');
        }
    }

    public function GetMexams($id){
        $data         = [];
        $Exam         = MockExam::find($id);
        $data['Exams'] = $Exam;
        return Response::json($data);
    }

    public function UpdateMexams(Request $request){
        $id              =        $request->exe_id;
        $this->validate($request, [
            'exe_title'=>'required',
            'exe_content'=>'required',
            'cour_id'=>'required'
        ]);

        $Exam              = MockExam::find($id);
        $Exam->exam_title  = $request->exe_title;
        $Exam->exam_content  = $request->exe_content;
        $Exam->course_id  = $request->cour_id;

        $saved              = $Exam->save();
        if ($saved) {
            $request->session()->flash('message', 'Mock Exams was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/mexam');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Mock Exams!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Exam = MockExam::findOrFail($id);
        $Exam->delete();
        return redirect('/' . collect(request()->segments())->first() . '/mexam')->with('message', 'Selected Mock Exam has been deleted successfully!');
    }

}
