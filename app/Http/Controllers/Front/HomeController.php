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
        $data['AllCourses']         = Courses::All()->count();
        $data['AllTestimonial']     = Testimonial::where("testimonial_status","yes")->orderBy('id', 'desc')->get();
        $data['AllClients']         = Clients::where("client_status","yes")->orderBy('id', 'desc')->get();

        return view('frontend.home', $data);
    }

}
