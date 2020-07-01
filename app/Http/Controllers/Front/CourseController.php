<?php

namespace App\Http\Controllers\Front;

use App\CourseWithUser;
use App\MexamWithUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use App\CourseProgram;
use App\CourseStarted;
use App\ExamWithUser;
use App\MockExam;
use App\Courses;
use App\Result;
use App\QandA;
use App\Exam;
use App\cart;

use Auth;

use Session;

class CourseController extends Controller
{
    public function __construct() {
        $this->header_title = "eUniversitylondon";
    }

    public function index() {

        $data['sub_heading']  = 'Category';
        $data['page_title']   = 'eUniversitylondon Category';
        $data['categories']   =  Categories::where("category_cid", 0)->paginate(10);
        $data['ALLCats']      =  Categories::where("category_cid", 0)->get();

        return view('categories/index', $data);
    }

    public function Detail($id){
        $data         = [];

        $data['sub_heading']  = 'Course Detail Page';
        $data['page_title']   = $this->header_title;

        $data['course']              = Courses::where("id", $id)->first();
        $data['AllCourse']           = Courses::where("course_status", "yes")->get();
        $data['CourseProgram']       = CourseProgram::where("course_id", $data['course']->id)->where("cp_status", "yes")->orderBy("cp_placement", "asc")->get();

        return view('frontend.course-detail', $data);
    }

    public static function CartItemsGlobal() {

        $data = [];

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->first();
        if($session_result === null) {
            $data["CartItems"] = "emp";
        } else {
            $CartItems = (array) json_decode($session_result->val, true);
            $data["CartItems"] = $CartItems;
            /*************** Totals *************/
            $SubTotal = 0;
            $Total = 0;
            foreach($CartItems as $v) {
                $SubTotal = $SubTotal + ($v[3]*$v[2]);
                $Total = $Total + ($v[3]*$v[2]);
            }
            $data["SubTotal"] = $SubTotal;
            $data["Total"] = $Total;
            /*************** Totals *************/
        }

        return $data;
    }

    public function GetCPPDF($id) {

        $RES              =     [];

        $Data             = CourseProgram::where("id", $id)->first();

        $UserProgramData  = CourseStarted::where('course_id', $Data->course_id)->where('user_id', Auth::user()->id)->get();

        if(count($UserProgramData) > 0) {
              if($id > $UserProgramData[0]->CourseProgramID) {
                    /************* Get Next CP ***********/
                    $res_CP     =   CourseProgram::where("course_id", $Data->course_id)->orderBy("id", "asc")->pluck('id')->toArray();
                    if(count($res_CP) > 0) {
                        foreach($res_CP as $k=>$v) {
                            if($v == $UserProgramData[0]->CourseProgramID) {
                                $key = $k+1;
                            }
                        }
                    }
                    /************* Get Next CP ***********/
                    if(array_key_exists($key, $res_CP)) {
                        if($id > $res_CP[$key]) {
                            $RES["msg"]  =  "wrongstep";
                            $RES["pdf"]  =   $Data->pdf;
                            return $RES;
                        } else {
                            /************* Update Next CP ***********/
                            $CourseStarted      = CourseStarted::where('course_id', $Data->course_id)->where('user_id', Auth::user()->id)->first();
                            $CourseStarted->CourseProgramID         =   $res_CP[$key];

                            $save                                   =   $CourseStarted->save();
                            /************* Update Next CP ***********/
                            if($save) {
                                $RES["msg"]  =  "updated";
                                $RES["pdf"]  =   $Data->pdf;
                                return $RES;
                            }
                        }
                    } else {
                        $RES["msg"]  =  "notexist";
                        $RES["pdf"]  =   $Data->pdf;
                        return $RES;
                    }
              } else {
                  $RES["msg"]  =  "less";
                  $RES["pdf"]  =   $Data->pdf;
                  return $RES;
              }
        } else {
            $CPFirstID          =   CourseProgram::where("course_id", $Data->course_id)->orderBy("id", "asc")->pluck('id')->toArray();
            if(count($CPFirstID) > 0) {
                /********** Insert in Course Program *********/
                $CourseStarted      =   CourseStarted::firstOrNew(array('course_id' => $Data->course_id, 'user_id' => Auth::user()->id, 'CourseProgramID' => $id));

                $CourseStarted->course_id               =   $Data->course_id;
                $CourseStarted->user_id                 =   Auth::user()->id;
                $CourseStarted->CourseProgramID         =   $CPFirstID[0];

                $save                                   =   $CourseStarted->save();
                /********** Insert in Course Program *********/

                $RES["msg"]  =  "newitem";
                $RES["pdf"]  =   $Data->pdf;
                return $RES;
            } else {
                $RES["msg"]  =  "nocp";
                $RES["pdf"]  =   $Data->pdf;
                return $RES;
            }
        }
    }

    public function MockExam($mcid) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Mock Exam Page';
        $data['page_title']   = $this->header_title;

        $data['cid']   = $mcid;

        return view('frontend.mexam', $data);
    }

    public function Exam($cid) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Exam Page';
        $data['page_title']   = $this->header_title;

        $data['cid']   = $cid;

        return view('frontend.exam', $data);
    }

    public function FinishQuiz($status = "unsuccessful-1") {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Finish Quiz Page';
        $data['page_title']   = $this->header_title;
        $InputArr    =   explode("-", $status);
        $data['cid']   = $InputArr[1];

        $data['status']   = $InputArr[0];

        if($InputArr[0] == "success") {
            $data['ShowMSG']   = "Congratulations, you have passed the final exam.<br />Now you complete the final exam and your are certified successfully.";
        } else {
            $data['ShowMSG']   = "Unfortunately, you have failed the final exam.<br />You can retake the exam at any time, simply visit the link below to pay a £19 retake fee.";
        }

        return view('frontend.finishquiz', $data);
    }

    public function CourseResult(Request $request) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Exam Page';
        $data['page_title']   = $this->header_title;

        $course_id  =   $request->cid;
        $exam_id    =   $request->eid;

        $ResOBJ     =   Result::where("course_id", $course_id)->where("exam_id", $exam_id)->get();

        $res        =   json_decode($ResOBJ[0]->result, true);

        print_r($res["ResultData"]);
//        echo $res["ResultData"][2]["CorrectAns"];

        $data['cid']   = $course_id;

    }

//    public function SaveResult(Request $request) {
//
//        if(!Auth::user()) {
//            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
//        }
//
//        $data         = [];
//
//        $data['sub_heading']        = 'Exam Result Page';
//        $data['page_title']         = $this->header_title;
//
//        $results                    =   [];
//
//        $RequestData                =   [];
//        $AnswerDataarr              =   [];
//
//        $results["RequestData"]     =   $RequestData; // array(QuestionID => AnswerID)
//        $results["AnswerDataarr"]      =   $AnswerDataarr; // array(QuestionID => AnswerID)
//        $results["MarksObtain"]     =   ""; // User Marks
//
//        /********** Check Exam ***********/
//        $totalmax   =   0;
//
//        $ExamData   =   QandA::where("exam_qa_id", $request->exam)->where("table_name", $request->DBTable)->where("qa_cid", 0)->get();
//
//        if(count($ExamData) > 0) {
//            foreach($ExamData as $q) {
//                $question_id = $q->id;
//                $RequestData[$question_id]       =   $request->input($question_id);
//                $AnswerData          =   QandA::where("qa_cid", $q->id)->get();
//                if(count($AnswerData) > 0) {
//                    foreach($AnswerData as $a) {
//                        if($a->isCorrect == "yes") {
//                            $AnswerDataarr[$question_id]       =   $a->id;
//                            if($a->id == $request->input($question_id)) {
//                                $totalmax   =   $totalmax+10;
//                            }
//                        }
//                    }
//                }
//            }
//        }
//        /********** Check Exam ***********/
//
//        /********** Result Data ***********/
//        $results["RequestData"]     =   $RequestData; // array(QuestionID => AnswerID)
//        $results["AnswerDataarr"]   =   $AnswerDataarr; // array(QuestionID => AnswerID)
//        $results["MarksObtain"]     =   $totalmax; // User Marks
//        $ResData = json_encode($results);
//        /********** Result Data ***********/
//
//        /********** Store Results ********/
//        $ResOBJ                 = Result::firstOrNew(array('course_id' => $request->course, "exam_id" => $request->exam, "user_id" => Auth::user()->id));
//
//        $ResOBJ->course_id  =   $request->course;
//        $ResOBJ->exam_id    =   $request->exam;
//        $ResOBJ->user_id    =   Auth::user()->id;
//        $ResOBJ->result     =   $ResData;
//
//        $saved              =   $ResOBJ->save();
//        /********** Store Results ********/
//
//        if($totalmax > 40)
//            return redirect()->intended('/pass')->withErrors(['email' => 'Please login first !!!']);
//        else
//            return redirect()->intended('/fail')->withErrors(['email' => 'Please login first !!!']);
//    }

    public function SaveResult(Request $request) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']        = 'Exam Result Page';
        $data['page_title']         = $this->header_title;

        $ResultData                 =   [];
        $AnswerArr                  =   []; // array(UserAns => 2, CorrectAns => 3)

        $results["ResultData"]      =   $ResultData; // array(QuestionID => $AnswerArr)
        $results["MarksObtain"]     =   ""; // User Marks


        /********** Check Exam ***********/
        $totalmax   =   0;

        $ExamData   =   QandA::where("exam_qa_id", $request->exam)->where("table_name", $request->DBTable)->where("qa_cid", 0)->get();

        if(count($ExamData) > 0) {
            foreach($ExamData as $q) {
                $question_id = $q->id;
                $AnswerArr["UserAns"]       =   $request->input($question_id);
                $AnswerData          =   QandA::where("qa_cid", $q->id)->get();
                $cans         =     0;
                if(count($AnswerData) > 0) {
                    foreach($AnswerData as $a) {
                        if($a->isCorrect == "yes") {
                            $cans       =   $a->id;
                            if($a->id == $request->input($question_id)) {
                                $totalmax   =   $totalmax+10;
                            }
                        }
                    }
                }
                $AnswerArr["CorrectAns"]       =   $cans;
                $ResultData[$question_id]   =   $AnswerArr;
            }
        }
//        echo "<pre>" . print_r($ResultData) . "</pre>";exit();
        /********** Check Exam ***********/

        /********** Result Data ***********/
        $results["ResultData"]     =   $ResultData;
        $results["MarksObtain"]     =   $totalmax;
        $ResData = json_encode($results);
        /********** Result Data ***********/

        /********** Store Results ********/
        $ResOBJ                 = Result::firstOrNew(array('course_id' => $request->course, "exam_id" => $request->exam, "user_id" => Auth::user()->id));

        $ResOBJ->course_id  =   $request->course;
        $ResOBJ->exam_id    =   $request->exam;
        $ResOBJ->user_id    =   Auth::user()->id;
        $ResOBJ->result     =   $ResData;

        $saved              =   $ResOBJ->save();
        /********** Store Results ********/

        /********** Store data in courese with user ********/
        $ewuOBJ                 = ExamWithUser::firstOrNew(array('exam_id' => $request->exam, "user_id" => Auth::user()->id));

        $ewuOBJ->exam_id    =   $request->exam;
        $ewuOBJ->user_id    =   Auth::user()->id;

        $saved              =   $ewuOBJ->save();
        /********** Store data in courese with user ********/

        if($totalmax > 40) //195
            return redirect()->intended('/finishquiz/success-' . $request->course);
        else
            return redirect()->intended('/finishquiz/unsuccessful-' . $request->course);
    }

    public function ExamStart($cid) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Exam Page';
        $data['page_title']   = $this->header_title;

        $data['ExamData']          =   Exam::where("course_id", $cid)->get();

        if(count($data['ExamData']) > 0) {
            $data['QandAData']          =   QandA::where("exam_qa_id", $data['ExamData'][0]->id)->where("table_name", "Exam")->where("qa_cid", 0)->get();
        }

        $data['cid']   = $cid;
        $data['DBTable']   = "Exam";

        return view('frontend.takequiz', $data);
    }

    public static function GetAnswer($eid, $type, $qid) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $AnswerData          =   QandA::where("exam_qa_id", $eid)->where("table_name", $type)->where("qa_cid", $qid)->get();

        return $AnswerData;
    }

    public function FinishCourse($cid) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $CourseStarted                    =   CourseStarted::where("course_id", $cid)->where("user_id", Auth::user()->id)->first();

        if($CourseStarted === null) {
            $CPFirstID          =   CourseProgram::where("course_id", $cid)->orderBy("id", "asc")->pluck('id')->toArray();
            if(count($CPFirstID) > 0) {
                $CourseStarted = new CourseStarted();

                $CourseStarted->course_id       = $cid;
                $CourseStarted->user_id         = Auth::user()->id;
                $CourseStarted->CourseProgramID = $CPFirstID[0];
                $CourseStarted->CourseCompleted = "yes";

                $save = $CourseStarted->save();
            }
        } else {
            $CourseStarted->CourseCompleted  =   "yes";

            $save                            =   $CourseStarted->save();
        }


        $CourseData                    =   Courses::where("id", $cid)->first();
        if($save)
            return redirect()->back()->with('message', 'PLEASE COMPLETE THE QUIZ: FINAL EXAM:' . $CourseData->course_title);
        else
            return redirect()->back()->with('message', 'Faild to Update this information !!!');
    }

    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with('message', 'Selected category has been deleted successfully!');
    }

}
