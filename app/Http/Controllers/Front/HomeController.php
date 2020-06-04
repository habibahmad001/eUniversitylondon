<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use App\User;
use App\Courses;
use App\Testimonial;
use App\Clients;
use App\Categories;
use Illuminate\Support\Facades\Mail;

use Auth;

use Session;

class HomeController extends Controller
{
    public function __construct() {
        $this->header_title = "eUniversitylondon";
    }

    public function index() {

        $data['sub_heading']  = 'Home page';
        $data['page_title']   = 'Home';

        $data['AllLearner']         = User::where("user_type", "learner")->count();
        $data['AllInstructor']      = User::where("user_type", "instructor")->count();
        $data['AllCourses']         = Courses::where("course_status","yes")->count();
        $data['AllParents']         = Categories::where("category_cid", 0)->take(6)->get();
        $data['AllTestimonial']     = Testimonial::where("testimonial_status","yes")->orderBy('id', 'desc')->get();
        $data['AllClients']         = Clients::where("client_status","yes")->orderBy('id', 'desc')->get();
        $data['Courses']            = Courses::where("course_status","yes")->take(10)->orderBy('id', 'desc')->get();

        return view('frontend.home', $data);
    }

    public function ForgotPassword() {

        $data['sub_heading']  = 'Forgot Password Page';
        $data['page_title']   = 'Forgot Password';

        return view('frontend.forgotpass', $data);
    }

    public function ContactUS() {

        $data['sub_heading']  = 'Contact US Page';
        $data['page_title']   = 'Contact US';

        return view('frontend.contactus', $data);
    }

    public function AboutUS() {

        $data['sub_heading']  = 'About US Page';
        $data['page_title']   = 'About US';

        $data['AllClients']         = Clients::where("client_status","yes")->orderBy('id', 'desc')->get();

        return view('frontend.aboutus', $data);
    }

    public function UpdatePassword($id) {

        $data['sub_heading']  = 'Forgot Password Page';
        $data['page_title']   = 'Forgot Password';

        $data['id']   = $id;

        return view('frontend.updatepass', $data);
    }

    public function ResetEmail(Request $request) {

        $email = $request->account_email;

        $User_Data         = User::where("email", $email)->get();

        if(count($User_Data) > 0) {
            $usertype   = $User_Data[0]->user_type;
            $first_name = $User_Data[0]->first_name;
            $userID     = $User_Data[0]->id;

            Mail::send('emails.ResetPassword', ['first_name' => $first_name, 'usertype' => $usertype, "userID" => $userID], function($message)  use ($email){
                $message->to($email);
                $message->subject("eUniversityLondon Account password reset email !!!");
            });

            return redirect()->intended('/')->withErrors(['email' => 'Please check your email !!!']);
        }

        return redirect()->intended('/')->withErrors(['email' => 'Email does not exist !!!']);
    }

    public function Search(Request $request){
        $data         = [];

        $term = $request->search;

        $data['sub_heading']  = 'Search Page';
        $data['page_title']   = $this->header_title;


        $data['Courses']    = Courses::where("course_status", "yes")->get();
        $AllCategories      = Categories::where("category_status", "yes")->get();
        $data['Search']     = Courses::where("course_status", "yes")->where('course_title', 'LIKE', '%' . $term . '%')->orWhere('course_desc', 'LIKE', '%' . $term . '%')->get();

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

        return view('frontend.search', $data);
    }

    public function SearchType($term){
        $data         = [];

        $data['sub_heading']  = 'Search Page';
        $data['page_title']   = $this->header_title;


        $data['Courses']    = Courses::where("course_status", "yes")->get();
        $AllCategories      = Categories::where("category_status", "yes")->get();
        $data['Search']     = Courses::where("course_status", "yes")->where('course_title', 'LIKE', '%' . $term . '%')->orWhere('course_desc', 'LIKE', '%' . $term . '%')->get();

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

        return view('frontend.search', $data);
    }

    public function ResetPassword(Request $request) {

        $id              =        $request->user_id;
        $this->validate($request, [
            'new_password'     => 'required',
            'confirm_password'     => 'required|same:new_password'
        ]);
        $users              = User::find($id);
        $users->password    = bcrypt($request->new_password);
        $users->passupdated = "yes";

        $saved              = $users->save();
        if ($saved) {
            $request->session()->flash('message', 'Password has been updated Successfully !!!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Couldn\'t update Password !!!');
        }
    }

}
