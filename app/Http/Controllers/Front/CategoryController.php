<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use App\User;
use App\Categories;
use App\Courses;

use Auth;

use Session;

class CategoryController extends Controller
{
    public function __construct() {
        $this->header_title = "eUniversitylondon";
    }

    public function index() {

        $data['sub_heading']  = 'Category';
        $data['page_title']   = 'eUniversitylondon Category';
        $data['ALLCats']      =  Categories::where("category_cid", 0)->get();

        return view('frontend.catlog', $data);
    }

    public function GetCategories($page_slug){
        $data         = [];

        $data['sub_heading']  = 'Category Page';
        $data['page_title']   = $this->header_title;


        $categories         = Categories::where("page_slug", $page_slug)->first();
        $data['categories'] = $categories;
        $data['Courses']    = Courses::where("course_status", "yes")->get();
        $AllCategories      = Categories::where("category_status", "yes")->get();

        /********** Course in categories starts ************/
        $course_cat_arr = [];
        foreach($AllCategories as $CatID) {
            $course_count = 0;
            foreach($data['Courses'] as $v) {
                if(in_array($CatID->id, (array) json_decode($v->category_id))) {
                    $course_count++;
                }
            }
            $course_cat_arr[$CatID->id] = $course_count;
        }
        $data['course_cat'] = $course_cat_arr;
        /********** Course in categories Ends ************/

        return view('frontend.category-detail', $data);
    }

    public function SearchCourse() {

        $Courses              = Courses::where("course_status", "yes")->get();

        return Response::json($Courses);
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with('message', 'Selected category has been deleted successfully!');
    }

}
