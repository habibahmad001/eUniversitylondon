<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\Exam;
use App\Courses;
use App\ExamWithUser;

use Auth;

use Session;

class Exams extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Exam';
        $data['page_title']   = 'eUniversitylondon Exam';
        if(collect(request()->segments())->first() == 'instructor') {
            $data['Exams']        =  Exam::where('exam_user_id', Auth::user()->id)->paginate(10);
            $data['Courses']        =  Courses::where('course_status', "yes")->where('course_user_id', Auth::user()->id)->get();
        } elseif(collect(request()->segments())->first() == 'learner') {
            $data['Exams']        =  ExamWithUser::join('tableexam', 'tableexamwithuser.exam_id', '=', 'tableexam.id')
                ->select('*')
                ->where('tableexamwithuser.user_id', '=', Auth::user()->id)
                ->paginate(10);
            $data['Courses']        =  Courses::where('course_status', "yes")->get();
        } else {
            $data['Exams']        =  Exam::paginate(10);
            $data['Courses']        =  Courses::where('course_status', "yes")->get();
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
            if(!empty($course_data->exam_user_id)) {
                $Instructor_Name        =  User::where('id', $course_data->exam_user_id)->first();
                if(isset($Instructor_Name->first_name)) {
                    $Array_Instructor_Name[$course_data->id] = $Instructor_Name->first_name . " " . $Instructor_Name->last_name;
                }
            }
        }
        $data['Array_Instructor_Name']           =  $Array_Instructor_Name;
        /**************** Get instructor Name **************/

        return view('exam/index', $data);
    }

    public function ExamsAdd(Request $request){
        $Exam         = new Exam;
        $this->validate($request, [

            'exe_title'=>'required',
            'exe_content'=>'required',
            'cour_id'=>'required'
        ]);
        $Exam->exam_title    = $request->exe_title;
        $Exam->exam_content  = $request->exe_content;
        $Exam->course_id     = $request->cour_id;
        $Exam->exam_user_id  = Auth::user()->id;
        $saved               = $Exam->save();
        if ($saved) {
            $request->session()->flash('message', 'Exam successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/exam');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Exam!');
        }
    }

    public function GetExams($id){
        $data         = [];
        $Exam         = Exam::find($id);
        $data['Exams'] = $Exam;
        return Response::json($data);
    }

    public function UpdateExams(Request $request){
        $id              =        $request->exe_id;
        $this->validate($request, [
            'exe_title'=>'required',
            'exe_content'=>'required',
            'cour_id'=>'required'
        ]);

        $Exam              = Exam::find($id);
        $Exam->exam_title  = $request->exe_title;
        $Exam->exam_content  = $request->exe_content;
        $Exam->course_id  = $request->cour_id;

        $saved              = $Exam->save();
        if ($saved) {
            $request->session()->flash('message', 'Exams was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/exam');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Exams!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Exam = Exam::findOrFail($id);
        $Exam->delete();
        return redirect('/' . collect(request()->segments())->first() . '/exam')->with('message', 'Selected Exam has been deleted successfully!');
    }

}
