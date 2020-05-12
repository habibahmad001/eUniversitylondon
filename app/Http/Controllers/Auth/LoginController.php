<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\CreateLocationTable;
use App\JobsTable;
use App\cart;

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

    public function homelogin(Request $request) {
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required',
        ]);

        /********** Old Session ID Starts *************/
        $Old_Sess_ID = session()->getId();
        /********** Old Session ID Ends *************/

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
            /********** Update Cart Session ID Starts *************/
            $update_session                 = cart::firstOrNew(array('session_id' => $Old_Sess_ID));
            $update_session->session_id     = session()->getId();

            $update_session->save();
            /********** Update Cart Session ID Ends *************/
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
                return redirect()->intended('/')->withErrors(['email' => 'Invalid username or password!']);
            }

        }
    }


    public function LearnerLogin(Request $request) {
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        /********** Old Session ID Starts *************/
        $Old_Sess_ID = session()->getId();
        /********** Old Session ID Ends *************/

        if (Auth::attempt(['email' => $email, 'password' => $password, 'user_type' => 'learner'])) {

            /********** Update Cart Session ID Starts *************/
            $update_session                 = cart::firstOrNew(array('session_id' => $Old_Sess_ID));
            $update_session->session_id     = session()->getId();

            $update_session->save();
            /********** Update Cart Session ID Ends *************/

            if(Auth::user()->status == 'inactive')
            {
                Auth::logout();
                return redirect()->intended('/reviewcart')->withErrors(['email' => 'Admin did not approve you yet!!!']);
            } else {
                return redirect()->intended('/reviewcart');
            }
        }
        else
        {
            return redirect()->intended('/reviewcart')->withErrors(['email' => 'Invalid Email or password!']);
        }
    }

    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;

        /********** Old Session ID Starts *************/
        $Old_Sess_ID = session()->getId();
        /********** Old Session ID Ends *************/

        if (Auth::attempt(['email' => $email, 'password' => $password, 'user_type' => 'admin'])) {
//            exit($password);
            if($request->formtype == "administrator") {
                return redirect()->intended('/admin/home');
            } else {
                Auth::logout();
                return redirect()->intended('/' . $request->formtype )->withErrors(['email' => 'Invalid username or password!']);
            }
        } 
        else if(Auth::attempt(['email' => $email, 'password' => $password, 'user_type' => 'instructor']))
        {
            if(Auth::user()->status == 'inactive')
            {
                return redirect()->intended('/instructor');
            } else {
                if($request->formtype == "instructor") {
                    return redirect()->intended('/instructor/home');
                } else {
                    Auth::logout();
                    return redirect()->intended('/' . $request->formtype )->withErrors(['email' => 'Invalid username or password!']);
                }

            }
        }
        else if(Auth::attempt(['email' => $email, 'password' => $password, 'user_type' => 'learner']))
        {
            /********** Update Cart Session ID Starts *************/
            $update_session                 = cart::firstOrNew(array('session_id' => $Old_Sess_ID));
            $update_session->session_id     = session()->getId();

            $update_session->save();
            /********** Update Cart Session ID Ends *************/

            if(Auth::user()->status == 'inactive')
            {
                return redirect()->intended('/learner');
            } else {
                if($request->formtype == "learner") {
                    return redirect()->intended('/learner/home');
                } else {
                    Auth::logout();
                    return redirect()->intended('/' . $request->formtype )->withErrors(['email' => 'Invalid username or password!']);
                }

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
