<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\Courses;
use App\Categories;
use App\CourseWithUser;

use Auth;

use Session;

class CoursesController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']        = 'Courses';
        $data['page_title']         = 'eUniversitylondon Courses';
        if(collect(request()->segments())->first() == 'instructor')
            $data['Courses']        =  Courses::where('course_user_id', Auth::user()->id)->paginate(10);
        elseif(collect(request()->segments())->first() == 'learner')
            $data['Courses']        =  CourseWithUser::join('tablecourses', 'tableuserwithcourse.course_id', '=', 'tablecourses.id')
                                        ->select('*')
                                        ->where('tableuserwithcourse.user_id', '=', Auth::user()->id)
                                        ->paginate(10);
        else
            $data['Courses']        =  Courses::paginate(10);

        /**************** Get User Count **************/
        $Array_User_Count           =  array();
        foreach($data['Courses'] as $course_v) {
            $User_Count        =  CourseWithUser::where('course_id', $course_v->id)->count();
            if(isset($Course_Name->course_title)) {
                $Array_User_Count[$course_v->id] = $User_Count;
            }
        }
        $data['Array_User_Count']           =  $Array_User_Count;
        /**************** Get User Count **************/

        /**************** Get instructor Name **************/
        $Array_Instructor_Name           =  array();

            foreach($data['Courses'] as $course_data) {
                if(!empty($course_data->course_user_id)) {
                    $Instructor_Name        =  User::where('id', $course_data->course_user_id)->first();
                    if(isset($Instructor_Name->first_name)) {
                        $Array_Instructor_Name[$course_data->id] = $Instructor_Name->first_name . " " . $Instructor_Name->last_name;
                    }
                }
            }
            $data['Array_Instructor_Name']           =  $Array_Instructor_Name;

        /**************** Get instructor Name **************/

        $data['Category']           =  Categories::All();
        return view('course/index', $data);
    }

    public function CourseAdd(Request $request){
        $Courses         = new Courses;
        $this->validate($request, [

            'cou_title'=>'required',
            'cou_desc'=>'required',
            'cou_company'=>'required',
            'cou_what_you_learn'=>'required',
            'cou_includes'=>'required',
            'cou_requirements'=>'required',
            'cou_course_for'=>'required',
            'youtube'=>'required',
            'cou_price'=>'required',
            'cou_discounted_price'=>'required',
            'cou_avatar'  => 'required',
            'cou_category'=>'required'
        ]);
        $Courses->course_title  = $request->cou_title;
        $Courses->course_desc  = $request->cou_desc;
        $Courses->created_company  = $request->cou_company;
        $Courses->what_you_learn  = $request->cou_what_you_learn;
        $Courses->course_includes  = $request->cou_includes;
        $Courses->course_requirements  = $request->cou_requirements;
        $Courses->course_for  = $request->cou_course_for;
        $Courses->youtube  = $request->youtube;
        $Courses->course_price  = $request->cou_price;
        $Courses->course_discounted_price  = $request->cou_discounted_price;
        $Courses->course_user_id  = Auth::user()->id;
        /************ Image Upload ***********/
        if(!empty($request->file('cou_avatar'))) {
            $CoursesImage = $request->file('cou_avatar');
            $CoursesImage_new_name = rand() . '.' . $CoursesImage->getClientOriginalExtension();
            $Courses->course_avatar = $CoursesImage_new_name;
            $CoursesImage->move('uploads/pavatar', $CoursesImage_new_name);
        }
        /************ Image Upload ***********/
        $Courses->category_id  = $request->cou_category;

        $saved          = $Courses->save();
        if ($saved) {
            $request->session()->flash('message', 'Course successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/course');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Course!');
        }
    }

    public function GetCourse($id){
        $data         = [];
        $Courses         = Courses::find($id);
        $data['Courses'] = $Courses;
        return Response::json($data);
    }

    public function UpdateCourse(Request $request){
        $id              =        $request->cou_id;
        $this->validate($request, [
            'cou_title'=>'required',
            'cou_desc'=>'required',
            'cou_company'=>'required',
            'cou_what_you_learn'=>'required',
            'cou_includes'=>'required',
            'cou_requirements'=>'required',
            'cou_course_for'=>'required',
            'youtube'=>'required',
            'cou_price'=>'required',
            'cou_discounted_price'=>'required',
            'cou_category'=>'required'
        ]);
        $Courses              = Courses::find($id);
        $Courses->course_title  = $request->cou_title;
        $Courses->course_desc  = $request->cou_desc;
        $Courses->created_company  = $request->cou_company;
        $Courses->what_you_learn  = $request->cou_what_you_learn;
        $Courses->course_includes  = $request->cou_includes;
        $Courses->course_requirements  = $request->cou_requirements;
        $Courses->course_for  = $request->cou_course_for;
        $Courses->youtube  = $request->youtube;
        $Courses->course_price  = $request->cou_price;
        $Courses->course_discounted_price  = $request->cou_discounted_price;
        /************ Image Upload ***********/
        if(!empty($request->file('cou_avatar'))) {
            unlink('uploads/pavatar/' . $Courses->course_avatar);
            $CoursesImage = $request->file('cou_avatar');
            $CoursesImage_new_name = rand() . '.' . $CoursesImage->getClientOriginalExtension();
            $Courses->course_avatar  = $CoursesImage_new_name;
            $CoursesImage->move('uploads/pavatar', $CoursesImage_new_name);
        }
        /************ Image Upload ***********/
        $Courses->category_id  = $request->cou_category;

        $saved              = $Courses->save();
        if ($saved) {
            $request->session()->flash('message', 'Course was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/course');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Courses!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Courses = Courses::findOrFail($id);
        unlink('uploads/pavatar/' . $Courses->course_avatar);
        $Courses->delete();
        return redirect('/' . collect(request()->segments())->first() . '/course')->with('message', 'Selected Courses has been deleted successfully!');
    }

}
