<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;



use App\Assignment;
use App\Exam;
use App\MockExam;
use App\ExamWithUser;
use App\MexamWithUser;
use App\CourseWithUser;
use App\Courses;

use Auth;

class AssignmentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Assignment';
        $data['page_title']   = 'eUniversitylondon Assignment';
        $data['Assignment']   =  Assignment::where("user_id", Auth::user()->id)->paginate(10);
        $data['Courses']      =  Courses::where('course_status', "yes")->get();
        
        return view('assignment/index', $data);
    }

    public function AssignmentAdd(Request $request){
        $Assignment         = new Assignment;
        $this->validate($request, [

            'ass_title'=>'required',
            'contents'=>'required',
            'cour_id'=>'required'
        ]);

        $Assignment->assignment_title  = $request->ass_title;
        $Assignment->contents  = $request->contents;
        $Assignment->course_id  = $request->cour_id;
        $Assignment->user_id  = Auth::user()->id;

//        $Assignment->table_name  = $request->tab_name;
//        $Assignment->exam_id  = $request->exam_id;

        /************ File Upload ***********/
        if(!empty($request->file('assignment_f'))) {
            $AssignmentFile = $request->file('assignment_f');
            $AssignmentFile_new_name = rand() . '.' . $AssignmentFile->getClientOriginalExtension();
            $Assignment->assignment_file = $AssignmentFile_new_name;
            $AssignmentFile->move('uploads/assignment', $AssignmentFile_new_name);
        }
        /************ File Upload ***********/

        $saved          = $Assignment->save();

        if ($saved) {
            $request->session()->flash('message', 'Assignment successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/assignment');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Assignment!');
        }
    }

//    public function GetAssignment($id){
//        $data         = [];
//        $Assignment         = Assignment::find($id);
//        $data['assignment'] = $Assignment;
//        if($Assignment->table_name == "Exam") {
//            /****** Select course Enrolled by User ************/
//            $User_Course = [];
//            $Res_Course = CourseWithUser::where("user_id", Auth::user()->id)->get();
//            if(count($Res_Course) > 0) {
//                foreach($Res_Course as $val) {
//                    $User_Course[] = $val->course_id;
//                }
//                $Exm_data = Exam::whereIn("course_id", $User_Course)->get();
//            }
//            /****** Select course Enrolled by User ************/
//        } else {
//            /****** Select course Enrolled by User ************/
//            $User_Course = [];
//            $Res_Course = CourseWithUser::where("user_id", Auth::user()->id)->get();
//            if(count($Res_Course) > 0) {
//                foreach($Res_Course as $val) {
//                    $User_Course[] = $val->course_id;
//                }
//                $Exm_data = MockExam::whereIn("course_id", $User_Course)->get();
//            }
//            /****** Select course Enrolled by User ************/
//        }
//        $data["Exm_data"] = $Exm_data;
//        return Response::json($data);
//    }

    public function GetAssignment($id){
        $data         = [];
        $data["Assignment"]         = Assignment::find($id);
        return Response::json($data);
    }


    public function GetAssignmentExam($table_name){
        $data           = [];
        if($table_name == "MockExam") {

            /****** Select course Enrolled by User ************/
            $User_Course = [];
            $Res_Course = CourseWithUser::where("user_id", Auth::user()->id)->get();
            if(count($Res_Course) > 0) {
                foreach($Res_Course as $val) {
                    $User_Course[] = $val->course_id;
                }
                $resulset       = MockExam::whereIn("course_id", $User_Course)->get();
            } else {
                $ret_msg = 'Your courses does not have any Mock Exam yet !!!';
            }
            /****** Select course Enrolled by User ************/

            if(Auth::user()->user_type == "admin") {
                $resulset       = MockExam::All();
            }

        } else {
            /****** Select course Enrolled by User ************/
            $User_Course = [];
            $Res_Course = CourseWithUser::where("user_id", Auth::user()->id)->get();
            if(count($Res_Course) > 0) {
                foreach($Res_Course as $val) {
                    $User_Course[] = $val->course_id;
                }
                $resulset       = Exam::whereIn("course_id", $User_Course)->get();
            } else {
                $ret_msg = 'Your courses does not have any Exam yet !!!';
            }
            /****** Select course Enrolled by User ************/
            if(Auth::user()->user_type == "admin") {
                $resulset       = Exam::All();
            }

        }
        if(count($resulset) > 0) {
            $res_var = '<select name="exam_id" id="exam_id" class="full-width">';
            foreach($resulset as $v){
                $res_var .= '<option value="' . $v->id . '">' . $v->exam_title . '</option>';
            }
            $res_var .= '</select>';
        } else {
            $res_var = $ret_msg;
        }

        $data['ResponseData']  = $res_var;
//        echo $res_var;
        return Response::json($data);
    }

    public function UpdateAssignment(Request $request){
        $id              =        $request->a_id;
        $this->validate($request, [
            'ass_title'=>'required',
            'contents'=>'required',
            'cour_id'=>'required'
        ]);
        $Assignment              = Assignment::find($id);
        $Assignment->assignment_title  = $request->ass_title;
        $Assignment->contents  = $request->contents;
        $Assignment->course_id  = $request->cour_id;
        $Assignment->user_id  = Auth::user()->id;
//        $Assignment->table_name  = $request->tab_name;
//        $Assignment->exam_id  = $request->exam_id;

        /************ File Upload ***********/
        if(!empty($request->file('assignment_f'))) {
            if(!empty($Assignment->assignment_file)) {
                (file_exists('uploads/assignment/' . $Assignment->assignment_file)) ? unlink('uploads/assignment/' . $Assignment->assignment_file) : "";
            }
            $AssignmentFile = $request->file('assignment_f');
            $AssignmentFile_new_name = rand() . '.' . $AssignmentFile->getClientOriginalExtension();
            $Assignment->assignment_file = $AssignmentFile_new_name;
            $AssignmentFile->move('uploads/assignment', $AssignmentFile_new_name);
        }
        /************ File Upload ***********/

        $saved              = $Assignment->save();

        if ($saved) {
            $request->session()->flash('message', 'Assignments was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/assignment');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Assignment!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Assignment = Assignment::findOrFail($id);
        if(!empty($Assignment->assignment_file)) {
            (file_exists('uploads/assignment/' . $Assignment->assignment_file)) ? unlink('uploads/assignment/' . $Assignment->assignment_file) : "";
        }
        $Assignment->delete();
        return redirect('/' . collect(request()->segments())->first() . '/assignment')->with('message', 'Selected Assignment has been deleted successfully!');
    }
}
