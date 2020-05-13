<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\Courses;
use App\Exam;
use App\MockExam;
use App\CourseCurriculum;
use App\ExamWithUser;
use App\CourseWithUser;
use App\MexamWithUser;

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
        $data['users']        =  User::orderBy('id', 'desc')->take(5)->get();
        $data['learner']      =  User::where("user_type", "learner")->orderBy('id', 'desc')->take(5)->get();
        $data['instructor']   =  User::where("user_type", "instructor")->orderBy('id', 'desc')->take(5)->get();
        $data['courses']      =  Courses::where('course_status', "yes")->orderBy('id', 'desc')->take(5)->get();

        return view('admindashboard', $data);
    }

    public function InstructorDashboard() {

        $data['sub_heading']    = 'Dashborard';
        $data['page_title']     = 'eUniversitylondon Dashborard';
        $data['courses']               =  Courses::where('course_user_id', Auth::user()->id)->where('course_status', "yes")->orderBy('id', 'desc')->take(5)->get();
        $data['exam']                  =  Exam::where('exam_user_id', Auth::user()->id)->orderBy('id', 'desc')->take(5)->get();
        $data['mexam']                 =  MockExam::where('mexam_user_id', Auth::user()->id)->orderBy('id', 'desc')->take(5)->get();
        $data['coursecurriculum']      =  CourseCurriculum::where('curriculum_user_id', Auth::user()->id)->orderBy('id', 'desc')->take(5)->get();

        return view('instructordashboard', $data);
    }

    public function LearnerDashboard() {

        $data['sub_heading']    = 'Dashborard';
        $data['page_title']     = 'eUniversitylondon Dashborard';
        $data['courses']               =  CourseWithUser::join('tablecourses', 'tableuserwithcourse.course_id', '=', 'tablecourses.id')
                                                        ->select('*')
                                                        ->where('tableuserwithcourse.user_id', '=', Auth::user()->id)
                                                        ->orderBy('tablecourses.id', 'desc')
                                                        ->take(5)->get();
        $data['exam']                  =  ExamWithUser::join('tableexam', 'tableexamwithuser.exam_id', '=', 'tableexam.id')
                                                        ->select('*')
                                                        ->where('tableexamwithuser.user_id', '=', Auth::user()->id)
                                                        ->orderBy('tableexam.id', 'desc')
                                                        ->take(5)->get();

        $data['mexam']                 =  MexamWithUser::join('tablemockexam', 'tablemexamwithuser.mexam_id', '=', 'tablemockexam.id')
                                                        ->select('*')
                                                        ->where('tablemexamwithuser.user_id', '=', Auth::user()->id)
                                                        ->orderBy('tablemockexam.id', 'desc')
                                                        ->take(5)->get();

        return view('learnerdashboard', $data);
    }

}
