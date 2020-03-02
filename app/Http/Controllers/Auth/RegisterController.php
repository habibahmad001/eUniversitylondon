<?php

namespace App\Http\Controllers\Auth;

use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    { 

        $user = User::all();

        if(count($user) > 0)
        {

        $confirmation_code = str_random(30);
        $username          = $this->getUsername($data['first_name'],$data['last_name']);
        return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'username'=>$data['username'],
                'password' => bcrypt($data['password']),
                'status' => 'active',
                'confirmation_code'=>$confirmation_code,
                'user_type' => $data['user_type'],
            ]);



        }

        else
        {
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],

                'username'=>$this->getUsername($data['first_name'],$data['last_name']),

                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
                'status' => 'active',
                'user_type' => 'admin',
            ]);
        }

        
   //      return User::create([
			// 'first_name' => $data['first_name'],
			// 'last_name' => $data['last_name'],
			// 'email' => $data['email'],
   //          'phone' => $data['phone'],
   //          'password' => bcrypt($data['password']),
   //      ]);
    }


    public function getUsername($firstName, $lastName) {
        $username     = Str::slug($firstName . "-" . $lastName);
        $userRows     = User::whereRaw("username REGEXP '^{$username}(-[0-9]*)?$'")->get();
        $countUser    = count($userRows) + 1;
        return ($countUser > 1) ? "{$username}-{$countUser}" : $username;
    }

    public function verifyEmail(Request $request, $confirmation_code)
    {
     
       //check if verificationCode exists
       if (!$valid = User::where('confirmation_code', $confirmation_code)->first()) {
           return redirect('/login')->withErrors('that verification code does not exist, try again');
       }
     
       $conditions = [
         'status' => 'inactive',
         'confirmation_code' => $confirmation_code
       ];
     
       if ($valid = User::where($conditions)->first()) {
     
        $valid->status = 'active';
        $valid->save();
        return redirect('/login')
             ->withErrors('Account is successfully verified');
       }
     
       return redirect('/login')->withErrors('Your account is already validated');
    }


}
