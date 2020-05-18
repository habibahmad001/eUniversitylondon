<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use App\Courses;
use App\CourseProgram;

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


    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with('message', 'Selected category has been deleted successfully!');
    }

}
