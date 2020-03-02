<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        
    }

    public function reset_password(Request $request){


        $this->validate($request, [
            'email'=>'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);
        
        $reset = DB::table("password_resets")->where('email', $request->email)->first();
            
        if(\Hash::check($request->token, $reset->token)){
        $returnrow  =   DB::table('users')
            ->where('email', $request->email)
            ->update(['password' => bcrypt($request->password)]);
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect('/login')->withErrors(['Password has been successfully updated']);

        }else{        
        return redirect('/login')->withErrors(['Your token did not match']);

        }
      


    }
}
