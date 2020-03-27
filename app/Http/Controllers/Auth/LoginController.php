<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\CreateLocationTable;
use App\JobsTable;

class LoginController extends Controller {
    /*
            |--------------------------------------------------------------------------
            | Login Controller
            |--------------------------------------------------------------------------
            |
            | This controller handles authenticating users for the application and
            | redirecting them to your home screen. The controller uses a trait
            | to conveniently provide its functionality to your applications.
            |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/stores';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() {
        //return view('auth/login');

        $data['sub_heading']  = 'Home page';
        $data['page_title']   = 'Home';

        return view('welcome', $data);
    }

    public function showAdminLoginForm() {
        return view('auth/admin/login');
    }

    public function showInstructorLoginForm() {
        return view('auth/instructor/login');
    }

    public function showLearnerLoginForm() {
        return view('auth/learner/login');
    }

    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'user_type' => 'admin'])) {
            //exit($password);
            return redirect()->intended('/admin/home');
        } 
        else if(Auth::attempt(['email' => $email, 'password' => $password, 'user_type' => 'instructor']))
        {
            if(Auth::user()->status == 'inactive')
            {
                return redirect()->intended('/instructor');
            } else {
                return redirect()->intended('/instructor/home');
            }
        }
        else if(Auth::attempt(['email' => $email, 'password' => $password, 'user_type' => 'learner']))
        {
            if(Auth::user()->status == 'inactive')
            {
                return redirect()->intended('/learner');
            } else {
                return redirect()->intended('/learner/home');
            }
        }
        else
        {
            if($request->login_flag == "admin") {
                return redirect()->intended('/administrator')->withErrors(['email' => 'Invalid username or password!']);
            } else {
                return redirect()->intended('/login')->withErrors(['email' => 'Invalid username or password!']);
            }

        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->intended('/');
    }

     

    public function verifyEmail(Request $request, $confirmation_code)
    {
     
       //check if verificationCode exists
       if (!$valid = User::where('confirmation_code', $confirmation_code)->first()) {
           return redirect('/login')->withErrors(['that verification code does not exist, try again']);
       }
     
       $conditions = [
         'status' => 'inactive',
         'confirmation_code' => $confirmation_code
       ];
     
       if ($valid = User::where($conditions)->first()) {
     
        $valid->status = 'active';
        $valid->save();
        return redirect('/login')
             ->withInput(['email' => $valid->email]);
       }
     
       return redirect('/login')->with('message','Your account is already validated');
    }

}
