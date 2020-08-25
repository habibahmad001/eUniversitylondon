<?php

namespace App\Http\Controllers;

use App\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\CourseProgram;
use App\Courses;
use App\CourseWithUser;

use Auth;

use Session;

class CourseProgramController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'content/Units';
        $data['page_title']   = 'eUniversitylondon content/Units';
        if(collect(request()->segments())->first() == 'instructor') {
            $data['CourseProgram']          =  CourseProgram::join('tablecourses', 'tablecourseprogram.course_id', '=', 'tablecourses.id')
                                                                ->select('*')
                                                                ->where('tablecourses.course_user_id', '=', Auth::user()->id)
                                                                ->orderBy('tablecourses.id', 'asc')
                                                                ->paginate(10);
            $data['Courses']                =  Courses::where('course_user_id', Auth::user()->id)->paginate(10);
        } else {
            $data['CourseProgram']          =  CourseProgram::where('cp_status', "yes")->paginate(10);
            $data['Courses']                =  Courses::where('course_status', "yes")->get();
        }

        /**************** Get Course Name **************/
        $Array_Course_Name           =  array();
        foreach($data['CourseProgram'] as $CourseProgram_data) {
            if(!empty($CourseProgram_data->course_id)) {
                $Course_Name        =  Courses::where('id', $CourseProgram_data->course_id)->first();
                if(isset($Course_Name->course_title)) {
                    $Array_Course_Name[$CourseProgram_data->id] = $Course_Name->course_title;
                }
            }
        }
        $data['Array_Course_Name']           =  $Array_Course_Name;
        /**************** Get Course Name **************/

        return view('courseprogram/index', $data);
    }

    public function CPListing(Request $request) {

        $data['sub_heading']  = 'content/Units';
        $data['page_title']   = 'eUniversitylondon content/Units';
        if(collect(request()->segments())->first() == 'instructor') {
            $data['CourseProgram']          =  CourseProgram::join('tablecourses', 'tablecourseprogram.course_id', '=', 'tablecourses.id')
                                        ->select('*')
                                        ->where('tablecourses.course_user_id', '=', Auth::user()->id)
                                        ->where('tablecourseprogram.course_id', '=', $request->cid)
                                        ->orderBy('tablecourses.id', 'asc')
                                        ->paginate(10);
            $data['Courses']        =  Courses::where('course_user_id', Auth::user()->id)->paginate(10);
        } elseif(collect(request()->segments())->first() == 'admin') {
            $data['CourseProgram']          =  CourseProgram::where('cp_status', "yes")->where('course_id', $request->cid)->paginate(10);
            $data['Courses']        =  Courses::where('course_status', "yes")->get();
        }

        /**************** Get Course Name **************/
        $Array_Course_Name           =  array();
        foreach($data['CourseProgram'] as $CourseProgram_data) {
            if(!empty($CourseProgram_data->course_id)) {
                $Course_Name        =  Courses::where('id', $CourseProgram_data->course_id)->first();
                if(isset($Course_Name->course_title)) {
                    $Array_Course_Name[$CourseProgram_data->id] = $Course_Name->course_title;
                }
            }
        }
        $data['Array_Course_Name']           =  $Array_Course_Name;
        /**************** Get Course Name **************/

        return view('courseprogram/index', $data);
    }

    public function Units(Request $request) {

        $data['sub_heading']  = 'Content / Units';
        $data['page_title']   = 'eUniversitylondon Content / Units';

        $id              =        $request->cid;

        $CourseProgram              = CourseProgram::find($id);

        if(!empty($CourseProgram->cp_desc)){
            $data["Units"]  =   json_decode($CourseProgram->cp_desc, true);
        }

        return view('courseprogram/units', $data);
    }

    public function CourseProgramAdd(Request $request){
        $CourseProgram         = new CourseProgram;
        $this->validate($request, [

            'title'=>'required',
            'placement'=>'required',
            'cour_id'=>'required'
        ]);

        $CourseProgram->cp_title  = $request->title;
        $CourseProgram->cp_placement  = $request->placement;
        $CourseProgram->course_id  = $request->cour_id;

        /************ Image PDF ***********/
        if(!empty($request->file('cou_pdf'))) {
            $CoursesPDF = $request->file('cou_pdf');
            $CoursesPDF_new_name = rand() . '.' . $CoursesPDF->getClientOriginalExtension();
            $CourseProgram->pdf = $CoursesPDF_new_name;
            $CoursesPDF->move('uploads/courseprogrampdf', $CoursesPDF_new_name);
        }
        /************ Image PDF ***********/

        /************ Doc Upload ***********/
        if(!empty($request->file('cou_doc'))) {
            $CoursesDOC = $request->file('cou_doc');
            $CoursesDOC_new_name = rand() . '.' . $CoursesDOC->getClientOriginalExtension();
            $CourseProgram->doc = $CoursesDOC_new_name;
            $CoursesDOC->move('uploads/courseprogramdoc', $CoursesDOC_new_name);
        }
        /************ Doc Upload ***********/

        /************ Zip Upload ***********/
        if(!empty($request->file('cou_zip'))) {
            $CoursesZIP = $request->file('cou_zip');
            $CoursesZIP_new_name = rand() . '.' . $CoursesZIP->getClientOriginalExtension();
            $CourseProgram->OtherData = $CoursesZIP_new_name;
            $CoursesZIP->move('uploads/courseprogramzip', $CoursesZIP_new_name);
        }
        /************ Zip Upload ***********/

        $saved          = $CourseProgram->save();
        if ($saved) {
            $request->session()->flash('message', 'Course content/Units successfully added!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Course content/Units!');
        }
    }

    public function GetCourseProgram($id){
        $data         = [];
        $CourseProgram         = CourseProgram::find($id);
        $data['CourseProgram'] = $CourseProgram;
        return Response::json($data);
    }

    public static function GetCPONID($id){
        $CourseProgram         = CourseProgram::find($id);
        return $CourseProgram;
    }

    public static function TotalRatingOnCourse($id){
        $TRating         = Ratings::where("course_id", $id)->get();
        return $TRating;
    }

    public function UpdateCourseProgram(Request $request){
        $id              =        $request->cp_id;
        $this->validate($request, [
            'title'=>'required',
            'placement'=>'required',
            'cour_id'=>'required'
        ]);
        $CourseProgram              = CourseProgram::find($id);

        $CourseProgram->cp_title  = $request->title;
        $CourseProgram->cp_placement  = $request->placement;
        $CourseProgram->course_id  = $request->cour_id;

        /************ Image PDF ***********/
        if(!empty($request->file('cou_pdf'))) {
            if(!empty($CourseProgram->pdf)) {
                (file_exists('uploads/courseprogrampdf/' . $CourseProgram->pdf)) ? unlink('uploads/courseprogrampdf/' . $CourseProgram->pdf) : "";
            }
            $CoursesPDF = $request->file('cou_pdf');
            $CoursesPDF_new_name = rand() . '.' . $CoursesPDF->getClientOriginalExtension();
            $CourseProgram->pdf = $CoursesPDF_new_name;
            $CoursesPDF->move('uploads/courseprogrampdf', $CoursesPDF_new_name);
        }
        /************ Image PDF ***********/

        /************ Doc Upload ***********/
        if(!empty($request->file('cou_doc'))) {
            if(!empty($CourseProgram->doc)) {
                (file_exists('uploads/courseprogramdoc/' . $CourseProgram->doc)) ? unlink('uploads/courseprogramdoc/' . $CourseProgram->doc) : "";
            }
            $CoursesDOC = $request->file('cou_doc');
            $CoursesDOC_new_name = rand() . '.' . $CoursesDOC->getClientOriginalExtension();
            $CourseProgram->doc = $CoursesDOC_new_name;
            $CoursesDOC->move('uploads/courseprogramdoc', $CoursesDOC_new_name);
        }
        /************ Doc Upload ***********/

        /************ Zip Upload ***********/
        if(!empty($request->file('cou_zip'))) {
            if(!empty($CourseProgram->OtherData)) {
                (file_exists('uploads/courseprogramzip/' . $CourseProgram->OtherData)) ? unlink('uploads/courseprogramzip/' . $CourseProgram->OtherData) : "";
            }
            $CoursesZIP = $request->file('cou_zip');
            $CoursesZIP_new_name = rand() . '.' . $CoursesZIP->getClientOriginalExtension();
            $CourseProgram->OtherData = $CoursesZIP_new_name;
            $CoursesZIP->move('uploads/courseprogramzip', $CoursesZIP_new_name);
        }
        /************ Zip Upload ***********/

        $saved              = $CourseProgram->save();

        if ($saved) {
            $request->session()->flash('message', 'Course content/Units was successful edited!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Course content/Units!');
        }
    }

    public function UpdateUnits(Request $request){
        $id              =        $request->cpid;
        $this->validate($request, [
            'title'=>'required',
            'type'=>'required',
        ]);

        $DESDATA    =   [];
//        $DESDATA    =   array("Item" => array("Title" => "Some", "Type" => "Video", "Content" => "img.jpg", "Duration" => "2:30"));

        /********* Loop On type *********/
        $counter = 0;
        foreach($request->type as $v) {
            $DESDATA[$counter]["Title"]       =   $request->title[$counter];
            $DESDATA[$counter]["Type"]        =   $v;
            if($v == "Content_".$counter) {
                $DESDATA[$counter]["Content"]     =   $request->contentarr[$counter];
                $DESDATA[$counter]["Duration"]    =   $request->contentdur[$counter];
            } else if($v == "Iframe_".$counter) {
                $DESDATA[$counter]["Content"]     =   $request->iframearr[$counter];
                $DESDATA[$counter]["Duration"]    =   $request->iframedur[$counter];
            } else if($v == "Youtube_".$counter) {
                $DESDATA[$counter]["Content"]     =   $request->youtubearr[$counter];
                $DESDATA[$counter]["Duration"]    =   $request->youtubedur[$counter];
            } else if($v == "Video_".$counter) {
                /************ Video Upload ***********/
                if(!empty($request->file('videoarr')[$counter])) {
                    $CoursesVIDEO = $request->file('videoarr')[$counter];
                    $CoursesVIDEO_new_name = rand() . '.' . $CoursesVIDEO->getClientOriginalExtension();
                    $DESDATA[$counter]["Content"]     =   $CoursesVIDEO_new_name;
                    $CoursesVIDEO->move('uploads/courseprogramVIDEO', $CoursesVIDEO_new_name);
                } else {
                    $DESDATA[$counter]["Content"]     =   $request->oldvid[$counter];
                }
                /************ Video Upload ***********/
                $DESDATA[$counter]["Duration"]    =   $request->videodur[$counter];
            } else if($v == "Image_".$counter) {
                /************ Image Upload ***********/
                if(!empty($request->file('imgarr')[$counter])) {
                    $CoursesIMG = $request->file('imgarr')[$counter];
                    $CoursesIMG_new_name = rand() . '.' . $CoursesIMG->getClientOriginalExtension();
                    $DESDATA[$counter]["Content"]     =   $CoursesIMG_new_name;
                    $CoursesIMG->move('uploads/courseprogramIMG', $CoursesIMG_new_name);
                } else {
                    $DESDATA[$counter]["Content"]     =   $request->oldimg[$counter];
                }
                /************ Image Upload ***********/
                $DESDATA[$counter]["Duration"]    =   $request->imgdur[$counter];
            }

            $counter++;
        }
//        exit(json_encode($DESDATA));
        /********* Loop On type *********/

        $CourseProgram              = CourseProgram::find($id);

        $CourseProgram->cp_desc  = json_encode($DESDATA);


        $saved              = $CourseProgram->save();

        if ($saved) {
            $request->session()->flash('message', 'Course content/Units was successful edited!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Course content/Units!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $CourseProgram = CourseProgram::findOrFail($id);
        if(!empty($CourseProgram->pdf)) {
            (file_exists('uploads/courseprogrampdf/' . $CourseProgram->pdf)) ? unlink('uploads/courseprogrampdf/' . $CourseProgram->pdf) : "";
        }
        $CourseProgram->delete();
        return redirect('/' . collect(request()->segments())->first() . '/courseprogram')->with('message', 'Selected Course content/Units has been deleted successfully!');
    }

}
