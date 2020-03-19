<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\Courses;

use Auth;

use Session;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Dashborard';
        $data['page_title']   = 'eUniversitylondon Dashborard';
        $data['users']        =  User::take(5)->get();
        $data['learner']      =  User::where("user_type", "learner")->take(5)->get();
        $data['instructor']   =  User::where("user_type", "instructor")->take(5)->get();
        $data['courses']      =  Courses::orderBy('id', 'desc')->take(5)->get();

        return view('admindashboard', $data);
    }

    public function InstructorDashboard() {

        $data['sub_heading']  = 'Dashborard';
        $data['page_title']   = 'eUniversitylondon Dashborard';
        $data['users']        =  User::take(5)->get();
        $data['learner']      =  User::where("user_type", "learner")->take(5)->get();
        $data['instructor']   =  User::where("user_type", "instructor")->take(5)->get();
        $data['courses']      =  Courses::orderBy('id', 'desc')->take(5)->get();

        return view('instructordashboard', $data);
    }

}
