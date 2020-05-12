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

use Auth;

class AssignmentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Assignment';
        $data['page_title']   = 'eUniversitylondon Assignment';
        $data['Assignment']   =  Assignment::where("id", Auth::user()->id)->paginate(10);
        
        return view('assignment/index', $data);
    }

    public function AssignmentAdd(Request $request){
        $Assignment         = new Assignment;
        $this->validate($request, [

            'ass_title'=>'required',
            'tab_name'=>'required',
            'exam_id'=>'required'
        ]);

        $Assignment->assignment_title  = $request->ass_title;
        $Assignment->table_name  = $request->tab_name;
        $Assignment->exam_id  = $request->exam_id;

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

    public function GetAssignment($id){
        $data         = [];
        $Assignment         = Assignment::find($id);
        $data['assignment'] = $Assignment;
        if($Assignment->table_name == "Exam")
            $Exm_data =  ExamWithUser::join('tableexam', 'tableexamwithuser.exam_id', '=', 'tableexam.id')
                ->select('*')
                ->where('tableexamwithuser.user_id', '=', Auth::user()->id)
                ->get();
        else
            $Exm_data =  MexamWithUser::join('tablemockexam', 'tablemexamwithuser.mexam_id', '=', 'tablemockexam.id')
                ->select('*')
                ->where('tablemexamwithuser.user_id', '=', Auth::user()->id)
                ->get();
        $data["Exm_data"] = $Exm_data;
        return Response::json($data);
    }


    public function GetAssignmentExam($table_name){
        $data           = [];
        if($table_name == "MockExam") {
            $resulset       = MexamWithUser::join('tablemockexam', 'tablemexamwithuser.mexam_id', '=', 'tablemockexam.id')
                ->select('*')
                ->where('tablemexamwithuser.user_id', '=', Auth::user()->id)
                ->get();
            if(Auth::user()->user_type == "admin") {
                $resulset       = MockExam::All();
            }
            $ret_msg = 'First please join any Mock Exam';
        } else {
            $resulset       = ExamWithUser::join('tableexam', 'tableexamwithuser.exam_id', '=', 'tableexam.id')
                ->select('*')
                ->where('tableexamwithuser.user_id', '=', Auth::user()->id)
                ->get();
            if(Auth::user()->user_type == "admin") {
                $resulset       = Exam::All();
            }
            $ret_msg = 'First please join any Exam';
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
            'tab_name'=>'required',
            'exam_id'=>'required'
        ]);
        $Assignment              = Assignment::find($id);
        $Assignment->assignment_title  = $request->ass_title;
        $Assignment->table_name  = $request->tab_name;
        $Assignment->exam_id  = $request->exam_id;

        /************ File Upload ***********/
        if(!empty($request->file('assignment_f'))) {
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
        $Assignment->delete();
        return redirect('/' . collect(request()->segments())->first() . '/assignment')->with('message', 'Selected Assignment has been deleted successfully!');
    }
}
