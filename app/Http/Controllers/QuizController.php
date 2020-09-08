<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\Quiz;
use App\Courses;
use App\MexamWithUser;

use Auth;

use Session;

class QuizController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Quiz';
        $data['page_title']   = 'eUniversitylondon Quiz';
        if(collect(request()->segments())->first() == 'instructor') {
            $data['Quizs']        =  Quiz::where('mexam_user_id', Auth::user()->id)->paginate(10);
            $data['Courses']        =  Courses::where('course_user_id', Auth::user()->id)->where('course_status', "yes")->get();
        } elseif(collect(request()->segments())->first() == 'learner') {
            $data['Quizs']        =  MexamWithUser::join('tablemockexam', 'tablemexamwithuser.mexam_id', '=', 'tablemockexam.id')
                ->select('*')
                ->where('tablemexamwithuser.user_id', '=', Auth::user()->id)
                ->paginate(10);
            $data['Courses']        =  Courses::where('course_status', "yes")->get();
        } else {
            $data['Quizs']        =  Quiz::paginate(10);
            $data['Courses']        =  Courses::where('course_status', "yes")->get();
        }
        /**************** Get Course Name **************/
        $Array_Course_Name           =  array();
        foreach($data['Quizs'] as $exam_data) {
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
        foreach($data['Quizs'] as $course_data) {
            if(!empty($course_data->mexam_user_id)) {
                $Instructor_Name        =  User::where('id', $course_data->mexam_user_id)->first();
                if(isset($Instructor_Name->first_name)) {
                    $Array_Instructor_Name[$course_data->id] = $Instructor_Name->first_name . " " . $Instructor_Name->last_name;
                }
            }
        }
        $data['Array_Instructor_Name']           =  $Array_Instructor_Name;
        /**************** Get instructor Name **************/
        return view('quiz/index', $data);
    }

    public function QuizListing(Request $request) {

        $data['sub_heading']  = 'Quiz';
        $data['page_title']   = 'eUniversitylondon Quiz';
        if(collect(request()->segments())->first() == 'instructor') {
            $data['Quizs']          =  Quiz::where('exam_user_id', Auth::user()->id)->where('course_id', $request->cid)->paginate(10);
            $data['Courses']        =  Courses::where('course_status', "yes")->where('course_user_id', Auth::user()->id)->get();
        } elseif(collect(request()->segments())->first() == 'admin') {
            $data['Quizs']          =  Quiz::where('course_id', $request->cid)->paginate(10);
            $data['Courses']        =  Courses::where('course_status', "yes")->get();
        }
        /**************** Get Course Name **************/
        $Array_Course_Name           =  array();
        foreach($data['Quizs'] as $exam_data) {
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
        foreach($data['Quizs'] as $course_data) {
            if(!empty($course_data->exam_user_id)) {
                $Instructor_Name        =  User::where('id', $course_data->exam_user_id)->first();
                if(isset($Instructor_Name->first_name)) {
                    $Array_Instructor_Name[$course_data->id] = $Instructor_Name->first_name . " " . $Instructor_Name->last_name;
                }
            }
        }
        $data['Array_Instructor_Name']           =  $Array_Instructor_Name;
        /**************** Get instructor Name **************/

        return view('quiz/index', $data);
    }

    public function QuizAdd(Request $request){
        $Quiz         = new Quiz;
        $this->validate($request, [

            'exe_title'=>'required',
            'exe_content'=>'required',
            'cour_id'=>'required'
        ]);
        $Quiz->quiz_title  = $request->exe_title;
        $Quiz->quiz_content  = $request->exe_content;
        $Quiz->course_id  = $request->cour_id;
        $Quiz->quiz_user_id  = Auth::user()->id;

        $saved          = $Quiz->save();
        if ($saved) {
            $request->session()->flash('message', 'Quiz successfully added!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Quiz!');
        }
    }

    public function GetQuiz($id){
        $data         = [];
        $Quiz         = Quiz::find($id);
        $data['Quizs'] = $Quiz;
        return Response::json($data);
    }

    public static function GetQuizOnCourse($id){
        $Quiz         = Quiz::where("course_id", $id)->get();
        return $Quiz;
    }

    public function UpdateQuiz(Request $request){
        $id              =        $request->exe_id;
        $this->validate($request, [
            'exe_title'=>'required',
            'exe_content'=>'required',
            'cour_id'=>'required'
        ]);

        $Quiz              = Quiz::find($id);
        $Quiz->quiz_title  = $request->exe_title;
        $Quiz->quiz_content  = $request->exe_content;
        $Quiz->course_id  = $request->cour_id;

        $saved              = $Quiz->save();
        if ($saved) {
            $request->session()->flash('message', 'Quiz was successful edited!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Quiz!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Quiz = Quiz::findOrFail($id);
        $Quiz->delete();
        return redirect()->back()->with('message', 'Selected Quiz has been deleted successfully!');
    }

}
