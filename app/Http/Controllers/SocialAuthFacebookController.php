<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Socialite;
use App\User;
use Auth;
// use App\Http\Controllers\Auth\RegisterController;
// use namespace\Auth\RegisterController;

class SocialAuthFacebookController extends Controller
{
   public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback()
    {

    	$user = Socialite::driver('facebook')->stateless()->user();
        $named 	=	explode(' ',$user->name);
        $first_name 	=	 $named[0];
        $last_name 		=	 $named[1];

        $data = array(
            'first_name' => $first_name,
            'last_name' =>  $last_name,
            'email' 	=> 	$user->email,
            'username'	=>	$this->getUsername($first_name,$last_name), 
            'remember_token' => $user->token,
            'user_type' => 'user',
            'status' 	=> 	'active',

        );
      
		$user = User::where(['email' => $data['email']])->first();

		if(count($user) > 0)
		{
			Auth::loginUsingId($user->id);
			return redirect('/dashboard#');
		}

		else
		{
			$result = new User($data);
			if($result->save())
			{
				if(Auth::loginUsingId($result->id))
				{
					return redirect('/dashboard#');
				}
			}

		}

       
    }

    public function getUsername($firstName, $lastName) {
        $username     = Str::slug($firstName . "-" . $lastName);
        $userRows     = User::whereRaw("username REGEXP '^{$username}(-[0-9]*)?$'")->get();
        $countUser    = count($userRows) + 1;
        return ($countUser > 1) ? "{$username}-{$countUser}" : $username;
    }
}
