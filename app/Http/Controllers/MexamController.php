<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\MockExam;
use App\Courses;

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
        $data['Exams']        =  MockExam::paginate(10);
        $data['Courses']        =  Courses::All();
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

        $saved          = $Exam->save();
        if ($saved) {
            $request->session()->flash('message', 'Mock Exam successfully added!');
            return redirect('/admin/mexam');
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
            return redirect('/admin/mexam');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Mock Exams!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Exam = MockExam::findOrFail($id);
        $Exam->delete();
        return redirect('/admin/mexam')->with('message', 'Selected Mock Exam has been deleted successfully!');
    }

}
