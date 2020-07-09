<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


use Auth;
use App\QandA;
use App\Exam;
use App\MockExam;

class QandAController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index(Request $request) {

        $data['sub_heading']  = 'Question & Answer';
        $data['page_title']   = 'eUniversitylondon Question & Answer';

        if(isset($request->eid)) {
            if(collect(request()->segments())->first() == 'instructor') {
                $data['QandA']        =  QandA::where("qa_cid", 0)->where("exam_qa_id", $request->eid)->where("qa_user_id", Auth::user()->id)->paginate(30);
                $data['QandAALL']     =  QandA::where("qa_cid", 0)->where("exam_qa_id", $request->eid)->where("qa_user_id", Auth::user()->id)->get();
            } else {
                $data['QandA']        =  QandA::where("qa_cid", 0)->where("exam_qa_id", $request->eid)->paginate(30);
                $data['QandAALL']     =  QandA::where("qa_cid", 0)->where("exam_qa_id", $request->eid)->get();
            }
        } else {
            if(collect(request()->segments())->first() == 'instructor') {
                $data['QandA']        =  QandA::where("qa_cid", 0)->where("qa_user_id", Auth::user()->id)->paginate(10);
                $data['QandAALL']     =  QandA::where("qa_cid", 0)->where("qa_user_id", Auth::user()->id)->get();
            } else {
                $data['QandA']        =  QandA::where("qa_cid", 0)->paginate(10);
                $data['QandAALL']     =  QandA::where("qa_cid", 0)->get();
            }
        }

        $data['ExamList']     =  Exam::All();

        return view('qa/index', $data);
    }

    public function ChildItem(Request $request){

        $id  = $request->id;
        $data['sub_heading']    = 'Question & Answer';
        $data['page_title']     = 'eUniversitylondon Question & Answer';
        if(collect(request()->segments())->first() == 'instructor') {
            $data['QandA']          =  QandA::where('qa_cid', $id)->paginate(10);
            $data['QandAALL']       =  QandA::where("qa_cid", 0)->get();
        } else {
            $data['QandA']          =  QandA::where('qa_cid', $id)->paginate(10);
            $data['QandAALL']       =  QandA::where("qa_cid", 0)->get();
        }
        $data['id']     =   $id;
        $data['ExamList']       =  Exam::All();

        return view('qa/index', $data);

    }

    public function qandaAdd(Request $request){ // exit(collect(request()->segments())->pull(1));
        $QandA         = new QandA;
        if($request->sel_txt == 0) {
            $this->validate($request, [
                'qa_title' => 'required',
                'qa_content' => 'required',
                'sel_table' => 'required',
                'sel_ex_id' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'qa_title' => 'required',
                'qa_content' => 'required'
            ]);
        }
        $QandA->qa_title    = $request->qa_title;
        $QandA->qa_desc     = $request->qa_content;
        if($request->page_name == 'questionlist') {
            $QandA->qa_cid      = 0;
        } else {
            $QandA->qa_cid      = $request->sel_txt;
        }

        if($request->sel_txt != 0) {
            $res_set_exm        = QandA::where("id", $request->sel_txt)->first();
            $QandA->table_name  = $res_set_exm->table_name;
            if($request->page_name == 'questionlist') {
                $QandA->exam_qa_id = $request->sel_txt;
            } else {
                $QandA->exam_qa_id = $res_set_exm->exam_qa_id;
            }
        } else {
            $QandA->table_name  = $request->sel_table;
            $QandA->exam_qa_id  = $request->sel_ex_id;
        }
        $QandA->qa_user_id  = Auth::user()->id;

        $saved              = $QandA->save();
        if ($saved) {
            $request->session()->flash('message', 'Question & Answer successfully added!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Question & Answer!');
        }
    }

    public function Getqanda($id){
        $data           = [];
        $QandA          = QandA::find($id);
        $data['QandA']  = $QandA;//exit($QandA->qa_desc);
        $data['qa_desc']  = html_entity_decode($QandA->qa_desc);
        return Response::json($data);
    }

    public static function QuestionCount($eid){
        $RES          = QandA::where('qa_cid', 0)->where('exam_qa_id', $eid)->count();
        return $RES;
    }

    public static function ExamData($qid){
        $RES          = Exam::find($qid);
        return $RES;
    }

    public static function QuestionData($qid){
        $RES          = QandA::find($qid);
        return $RES;
    }
    public function UpdateANSStatus($id){

        $QandA          = QandA::find($id);

        if($QandA->isCorrect  == "yes")
            $QandA->isCorrect  = "no";
        else
            $QandA->isCorrect  = "yes";

        $saved  =   $QandA->save();

        if($saved)
            return redirect()->back()->with('error', 'Operation executed successfully!');
        else
            return redirect()->back()->with('error', 'Couldn\'t able to process this operation!');
    }

    public static function HasItems($id){

        $Res_qa          = QandA::where("qa_cid", $id)->get();
        if(count($Res_qa) > 0)
            $res  = 1;
        else
            $res  = 0;
        return $res;
    }

    public static function AnswerCount($id){

        $Res_qa          = QandA::where("qa_cid", $id)->count();
        return $Res_qa;
    }

    public static function QAonID($id){
        if(isset($id) && $id!=0) {
            $Res_qa          = QandA::where("id", $id)->first();
            return $Res_qa->qa_title;
        }

    }

    public function GeQAExam($table_name){
        $data           = [];
        if($table_name == "MockExam") {
            $resulset       = MockExam::where("mexam_user_id", Auth::user()->id)->get();
            if(Auth::user()->user_type == "admin") {
                $resulset       = MockExam::All();
            }
            $ret_msg = 'Please first create <a href="/' . collect(request()->segments())->first() . '/mexam">Mock Exam</a>';
        } else {
            $resulset       = Exam::where("exam_user_id", Auth::user()->id)->get();
            if(Auth::user()->user_type == "admin") {
                $resulset       = Exam::All();
            }
            $ret_msg = 'Please first create <a href="/' . collect(request()->segments())->first() . '/exam">Exam</a>';
        }
        if(count($resulset) > 0) {
            $res_var = '<select name="sel_ex_id" id="sel_ex_id" class="half-width">';
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

    public function Updateqanda(Request $request){
        $id              =        $request->cat_id;
        if($request->sel_txt == 0) {
            $this->validate($request, [
                'qa_title' => 'required',
                'qa_content' => 'required',
                'sel_table' => 'required',
                'sel_ex_id' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'qa_title' => 'required',
                'qa_content' => 'required'
            ]);
        }
        $QandA              = QandA::find($id);
        $QandA->qa_title    = $request->qa_title;
        $QandA->qa_desc     = $request->qa_content;
        if($request->page_name == 'questionlist') {
            $QandA->qa_cid      = 0;
        } else {
            $QandA->qa_cid      = $request->sel_txt;
        }
        if($request->sel_txt != 0) {
            $res_set_exm        = QandA::where("id", $request->sel_txt)->first();
            $QandA->table_name  = $res_set_exm->table_name;
            if($request->page_name == 'questionlist') {
                $QandA->exam_qa_id = $request->sel_txt;
            } else {
                $QandA->exam_qa_id = $res_set_exm->exam_qa_id;
            }
        } else {
            $QandA->table_name  = $request->sel_table;
            $QandA->exam_qa_id  = $request->sel_ex_id;
        }
        $saved              = $QandA->save();
        if ($saved) {
            $request->session()->flash('message', 'Question & Answer was successful edited!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Question & Answer!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $QandA = QandA::findOrFail($id);
        $QandA->delete();
        return redirect()->back()->with('message', 'Selected Question & Answer has been deleted successfully!');
    }

}