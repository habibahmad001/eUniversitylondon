<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use App\Courses;
use App\CourseProgram;
use App\CourseStarted;

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

    public function GetCPPDF($id) {

        $RES              =     [];

        $Data             = CourseProgram::where("id", $id)->first();

        $UserProgramData  = CourseStarted::where('course_id', $Data->course_id)->where('user_id', Auth::user()->id)->get();

        if(count($UserProgramData) > 0) {
              if($id > $UserProgramData[0]->CourseProgramID) {
                    /************* Get Next CP ***********/
                    $res_CP     =   CourseProgram::where("course_id", $Data->course_id)->orderBy("id", "asc")->pluck('id')->toArray();;
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
            /********** Insert in Course Program *********/
            $CourseStarted      = CourseStarted::firstOrNew(array('course_id' => $Data->course_id, 'user_id' => Auth::user()->id, 'CourseProgramID' => $id));

            $CourseStarted->course_id               =   $Data->course_id;
            $CourseStarted->user_id                 =   Auth::user()->id;
            $CourseStarted->CourseProgramID         =   $id;

            $save                                   =   $CourseStarted->save();
            /********** Insert in Course Program *********/
        }

        $RES["msg"]  =  "newitem";
        $RES["pdf"]  =   $Data->pdf;
        return $RES;
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with('message', 'Selected category has been deleted successfully!');
    }

}
