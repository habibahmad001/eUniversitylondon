<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Mail;

class User extends Authenticatable
{
    use Notifiable;
    protected $dates = ['created_at','updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'first_name','last_name','username', 'email','phone', 'password','status','user_type','avatar','remember_token','confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function sendVerificationEmail()
    {
      
         //optionally check if the user has a verification code here

         Mail::send('emails.verify', ['first_name'=>$this->first_name,'confirmation_code' => $this->confirmation_code], function($message){

             $message->to($this->email, $this->first_name);
             $message->subject('Please verify your email');
           
           });
     
    }

}
