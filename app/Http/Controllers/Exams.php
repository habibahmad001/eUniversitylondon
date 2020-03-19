<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\Exam;
use App\Courses;

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
        $data['Exams']        =  Exam::paginate(10);
        $data['Courses']        =  Courses::All();
        return view('exam/index', $data);
    }

    public function ExamsAdd(Request $request){
        $Exam         = new Exam;
        $this->validate($request, [

            'exe_title'=>'required',
            'exe_content'=>'required',
            'cour_id'=>'required'
        ]);
        $Exam->exam_title  = $request->exe_title;
        $Exam->exam_content  = $request->exe_content;
        $Exam->course_id  = $request->cour_id;
        $saved          = $Exam->save();
        if ($saved) {
            $request->session()->flash('message', 'Exam successfully added!');
            return redirect('/admin/exam');
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
            return redirect('/admin/exam');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Exams!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Exam = Exam::findOrFail($id);
        $Exam->delete();
        return redirect('/admin/exam')->with('message', 'Selected Exam has been deleted successfully!');
    }

}
