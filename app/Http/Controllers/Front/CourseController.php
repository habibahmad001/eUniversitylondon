<?php

namespace App\Http\Controllers\Front;

use App\Coupan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use App\CourseWithUser;
use App\MexamWithUser;
use App\CourseProgram;
use App\CourseStarted;
use App\ExamWithUser;
use App\Comments;
use App\MockExam;
use App\Ratings;
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

    public function Detail($course_title){
        $data         = [];

        $data['sub_heading']  = 'Course Detail Page';
        $data['page_title']   = $this->header_title;

        $filter_title   =   strtolower(str_replace('-', ' ', $course_title));
        $filter_title   =   str_replace('   ', ' - ', $filter_title);

        $data['course']              = Courses::where("course_title", $filter_title)->first();
        $data['AllCourse']           = Courses::where("course_status", "yes")->get();
        $data['MainComments']            = Comments::where("course_id", $data['course']->id)->where("subComment", 0)->orderBy("id", "desc")->where("isActive", "yes")->get();
        $data['CourseProgram']       = CourseProgram::where("course_id", $data['course']->id)->where("cp_status", "yes")->orderBy("cp_placement", "asc")->get();

        return view('frontend.course-detail', $data);
    }

    public static function GetSubComment($cid){
        $Comments            = Comments::where("subComment", $cid)->orderBy("id", "desc")->where("isActive", "yes")->get();
        return $Comments;
    }

    public function LikeThis($cid){
        if(!Auth::user()) {
            $data = [];
            $data["id"] = $cid;
            $data["cont"] = "login";
            return $data;
        } else {
            $Comments            = Comments::where("id", $cid)->first();
            if($Comments) {
                $resArr = json_decode($Comments->liked, true);
                if(array_key_exists($cid, $resArr["likeIDs"])) {
                    if(in_array(Auth::user()->id, $resArr["likeIDs"][$cid])) {
                        $resArr["likes"] = $resArr["likes"]-1;
                        if (($key = array_search(Auth::user()->id, $resArr["likeIDs"][$cid])) !== false) {
                            unset($resArr["likeIDs"][$cid][$key]);
                        }
                    } else {
                        $resArr["likes"] = $resArr["likes"]+1;
                        $resArr["likeIDs"][$cid][] = Auth::user()->id;
                    }
                } else {
                    $resArr["likeIDs"][$cid] = array();
                    if (in_array(Auth::user()->id, $resArr["likeIDs"][$cid])) {
                        $resArr["likes"] = $resArr["likes"]-1;
                        if (($key = array_search(Auth::user()->id, $resArr["likeIDs"][$cid])) !== false) {
                            unset($resArr["likeIDs"][$cid][$key]);
                        }
                    } else {
                        $resArr["likes"] = $resArr["likes"]+1;
                        $resArr["likeIDs"][$cid][] = Auth::user()->id;
                    }
                }
            }
            $Comments->liked = json_encode($resArr);
            $Comments->save();
        }

        return json_decode($Comments->liked, true)["likes"];
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
            if($session_result->promo) {
                $promo = Coupan::find($session_result->promo);
                if($promo) {
                    if(strtotime($promo->endsTo) >= strtotime(Carbon::now())) {
                        $data["Total"] = ($Total - (($promo->value)/100)*$Total);
                        $data['promo'] = $promo->title;
                    }
                }
            }
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
        $data         = [];

        $data['sub_heading']  = 'Mock Exam Page';
        $data['page_title']   = $this->header_title;

        $data['cid']   = $mcid;
        $data['DBTable']   = "MockExam";

        return view('frontend.exam', $data);
    }

    public function Exam($cid) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Exam Page';
        $data['page_title']   = $this->header_title;

        $data['cid']   = $cid;
        $data['DBTable']   = "Exam";

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

    public function ReviewsPage(Request $request) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Review\'s Page';
        $data['page_title']   = $this->header_title;

        $data['cid']  = $request->cid;

        return view('frontend.reviewsPage', $data);
    }

    public function NewSubscription($cid) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Finish Quiz Page';
        $data['page_title']   = $this->header_title;

        $data['cid']   = $cid;

        $data['retake']   = "yes";

        $data['ShowMSG']   = "Your 3 attempts to clear this exam is over, Now you need to pay £19 for further attempts to clear this exam!!!";

        return view('frontend.finishquiz', $data);
    }

    public function CourseResult(Request $request) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Quiz Result Detail Page';
        $data['page_title']   = $this->header_title;

        $course_id  =   $request->cid;
        $exam_id    =   $request->eid;

        $ResOBJ     =   Result::where("course_id", $course_id)->where("exam_id", $exam_id)->where("examType", $request->type)->get();

        $res        =   json_decode($ResOBJ[0]->result, true);

        $data['ResultResultset']   = $res["ResultData"];
//        echo $res["ResultData"][2]["CorrectAns"];

        $data['cid']   = $course_id;
        return view('frontend.quizresultsdetail', $data);
    }

    public function ExamResult(Request $request) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Quiz Result Page';
        $data['page_title']   = $this->header_title;

        $course_id  =   $request->cid;

        $data['ResultData']         =   Result::where("course_id", $course_id)->where("user_id", Auth::user()->id)->where("examType", "Exam")->get();
        $data['MockResultData']     =   Result::where("course_id", $course_id)->where("user_id", Auth::user()->id)->where("examType", "MockExam")->get();

        $data['cid']   = $course_id;
        $data['DBTable']   = "MockExam";
//        echo "<script>alert('Hi');</script>";


        return view('frontend.quizresults', $data);
    }
    public function SaveRatings(Request $request) {

        $this->validate($request, [
            'star_val'=>'required',
            'ccomments'=>'required'
        ]);

        $Rating         = Ratings::firstOrNew(array('course_id' => $request->cid, "user_id" => Auth::user()->id));

        $Rating->course_id      = $request->cid;
        $Rating->user_id        = Auth::user()->id;
        $Rating->rating         = $request->star_val;
        $Rating->ccomment       = $request->ccomments;
        $Rating->commentlevel   = 0;

        $saved          = $Rating->save();
        if ($saved) {
            $request->session()->flash('message', 'Rating has been saved successfully!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('message', 'Couldn\'t saved ratings!');
        }
    }

    public static function GetStars($cid) {

        $data   =   [];

        $RatingRES         = Ratings::where("course_id", $cid)->get();
        $Rating =   0;
        $TotalRating    =   0;
        $RatingPercent    =   0;
        if(count($RatingRES) > 0) {
            foreach($RatingRES as $v) {
                $Rating =   $Rating + $v->rating;
                $TotalRating++;
            }
            $RatingPercent = ($Rating/($TotalRating*5))*100;
        }

        if($RatingPercent > 0 and $RatingPercent <= 20) {
            $data["ratingcount"]  =   "one-star";
        } elseif($RatingPercent > 20 and $RatingPercent <= 40) {
            $data["ratingcount"]  =   "two-star";
        } elseif($RatingPercent > 40 and $RatingPercent <= 60) {
            $data["ratingcount"]  =   "three-star";
        } elseif($RatingPercent > 60 and $RatingPercent <= 80) {
            $data["ratingcount"]  =   "four-star";
        } elseif($RatingPercent > 80) {
            $data["ratingcount"]  =   "five-star";
        } else {
            $data["ratingcount"]  =   $RatingPercent;
        }

        $data["ratingpercent"]  =   $RatingPercent;
//        $data["ratingcount"]    =   $Rating;

        return $data;
    }

    public static function StudentCount($cid) {
        $Student_Count        =  CourseWithUser::where('course_id', $cid)->count();
        return $Student_Count;
    }

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
        $results["Result"]          =   ""; // User Result


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
        $results["ResultData"]      =   $ResultData;
        $results["MarksObtain"]     =   $totalmax;
        $results["Result"]          =   ($totalmax > 195) ? "PASSED" : "FAILED";
        $ResData = json_encode($results);
        /********** Result Data ***********/

        /********** Store Results ********/
//        $ResOBJ                 = Result::firstOrNew(array('course_id' => $request->course, "exam_id" => $request->exam, "user_id" => Auth::user()->id));
        $ResOBJ                 = new Result();

        $ResOBJ->course_id  =   $request->course;
        $ResOBJ->exam_id    =   $request->exam;
        $ResOBJ->user_id    =   Auth::user()->id;
        $ResOBJ->examType   =   $request->DBTable;
        $ResOBJ->result     =   $ResData;

        $saved              =   $ResOBJ->save();
        /********** Store Results ********/

        /********** Store data in courese with user ********/
//        $ewuOBJ                 = ExamWithUser::firstOrNew(array('exam_id' => $request->exam, "user_id" => Auth::user()->id));
        if($request->DBTable == "Exam"){
            $ewuOBJ                 = new ExamWithUser();
            $ewuOBJ->exam_id    =   $request->exam;
            $ewuOBJ->user_id    =   Auth::user()->id;
        } else {
            $ewuOBJ                 = new MexamWithUser();
            $ewuOBJ->mexam_id    =   $request->exam;
            $ewuOBJ->user_id     =   Auth::user()->id;
        }
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

        $chkResult  =   Result::where("user_id", Auth::user()->id)->where("examType", "Exam")->count();

        if($chkResult >= 3) {
            return redirect()->intended('/user/newsubscription/' . $cid);
        } else {
            $data['ExamData']          =   Exam::where("course_id", $cid)->orderBy("id", "asc")->get();
            if(count($data['ExamData']) > 0) {
                foreach($data['ExamData'] as $v) {
                    if($this->ResultCHK($cid, $v->id) == "no") {
                        $data['ExamData']           =   Exam::where("id", $v->id)->get();
                        $data['QandAData']          =   QandA::where("exam_qa_id", $v->id)->where("table_name", "Exam")->where("qa_cid", 0)->get();
                        $data['cid']   = $cid;
                        $data['DBTable']   = "Exam";

                        return view('frontend.takequiz', $data);
                    }
                }
                $data['QandAData']          =   QandA::where("exam_qa_id", $data['ExamData'][0]->id)->where("table_name", "Exam")->where("qa_cid", 0)->get();
                $data['cid']   = $cid;
                $data['DBTable']   = "Exam";

                return view('frontend.takequiz', $data);
            }

            $data['QandAData'] = array();
            $data['cid']   = $cid;
            $data['DBTable']   = "Exam";

            return view('frontend.takequiz', $data);
        }
    }

    public function MockExamStart($cid) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'MockExam Page';
        $data['page_title']   = $this->header_title;

        $chkResult  =   Result::where("user_id", Auth::user()->id)->where("examType", "MockExam")->count();


        if($chkResult >= 3) {
            return redirect()->intended('/user/newsubscription/' . $cid);
        } else {
            $data['ExamData']          =   MockExam::where("course_id", $cid)->orderBy("id", "asc")->get();
            if(count($data['ExamData']) > 0) {
                foreach($data['ExamData'] as $v) {
                    if($this->ResultCHKMock($cid, $v->id) == "no") {
                        $data['ExamData']           =   MockExam::where("id", $v->id)->orderBy("id", "asc")->get();
                        $data['QandAData']          =   QandA::where("exam_qa_id", $v->id)->where("table_name", "MockExam")->where("qa_cid", 0)->get();
                        $data['cid']   = $cid;
                        $data['DBTable']   = "MockExam";

                        return view('frontend.takequiz', $data);
                    }
                }
                $data['QandAData']          =   QandA::where("exam_qa_id", $data['ExamData'][0]->id)->where("table_name", "MockExam")->where("qa_cid", 0)->get();
                $data['cid']   = $cid;
                $data['DBTable']   = "MockExam";

                return view('frontend.takequiz', $data);
            }
            $data['QandAData'] = array();
            $data['cid']   = $cid;
            $data['DBTable']   = "MockExam";

            return view('frontend.takequiz', $data);
        }
    }

    public function ResultCHK($course_id, $exam_id) {
        $chkResult  =   Result::where("course_id", $course_id)->where("exam_id", $exam_id)->where("user_id", Auth::user()->id)->where("examType", "Exam")->get();
        if(count($chkResult) > 0) {
            return "yes";
        } else {
            return "no";
        }
    }

    public function StoreComments(Request $request) {

        $Comments         = new Comments;

        $this->validate($request, [
            'cuser'=>'required',
            'cemail'=>'required',
            'ccomment'=>'required'
        ]);
        $Comments->name         = $request->cuser;
        $Comments->email        = $request->cemail;
        if(isset($request->commentid)) {
            $Comments->subComment   = $request->commentid;
            $this->AddcommentID($request->commentid);
        } else {
            $Comments->subComment   = 0;
        }
        $Comments->message      = $request->ccomment;
        $Comments->course_id    = $request->cid;
        $Comments->liked        = json_encode(array("likes" => 0, "Comments" => 0, "likeIDs" => array("postID" => array("userID")), "CommentIDs" => array("postID" => array("userID"))));
        if(!Auth::user()) {
            $Comments->isActive    = "no";
        }

        $save   =   $Comments->save();
        if($save) {
            return redirect()->back()->with('message', 'Comment has been added successfully !!!');
        } else {
            return redirect()->back()->with('message', 'Faild to add comment !!!');
        }
    }

    public function AddcommentID($cid=0) {
        $Comments            = Comments::where("id", $cid)->first();
        if($Comments) {
            $resArr = json_decode($Comments->liked, true);
            $resArr["Comments"] = $resArr["Comments"]+1;
        }
        $Comments->liked = json_encode($resArr);
        $Comments->save();
    }

    public function ResultCHKMock($course_id, $exam_id) {
        $chkResult  =   Result::where("course_id", $course_id)->where("exam_id", $exam_id)->where("user_id", Auth::user()->id)->where("examType", "MockExam")->get();
        if(count($chkResult) > 0) {
            return "yes";
        } else {
            return "no";
        }
    }

    public static function GetQuizResult($exam_id, $examType="Exam") {
        $Result  =   Result::where("exam_id", $exam_id)->where("user_id", Auth::user()->id)->where("examType", $examType)->first();
        return $Result;
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
