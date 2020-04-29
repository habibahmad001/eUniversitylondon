<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use DB;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


use App\User;
use Auth;
use App\CourseWithUser;
//use Image;

//Enables us to output flash messaging
use Session;

class UserController extends Controller {

    public function __construct() {
        $this->middleware(['auth']); // isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
   
    public function index() {

        $data['sub_heading']  = 'Users';
        $data['page_title']   = 'eUniversitylondon Users';
        $data['users']        =  User::where('user_type','user')->orwhere('user_type', 'instructor')->orwhere('user_type', 'learner')->paginate(10);
        return view('users/index', $data);
    }

    public function User_enrolled_in_course(Request $request) { // exit($request->cid);

        $data['sub_heading']  = 'Users';
        $data['page_title']   = 'eUniversitylondon Users';

        $data['users'] = DB::table('tableuserwithcourse')
            ->join('users', 'tableuserwithcourse.user_id', '=', 'users.id')
            ->select('*')
            ->where('tableuserwithcourse.course_id', '=', $request->cid)
            ->paginate(10);


        return view('users/index', $data);
    }

    public function instructor() {

        $data['sub_heading']  = 'Instructor';
        $data['page_title']   = 'eUniversitylondon Instructor';
        $data['users']        =  User::where('user_type','user')->orwhere('user_type', 'instructor')->paginate(10);
        return view('users/index', $data);
    }

    public function learner() {

        $data['sub_heading']  = 'Learner';
        $data['page_title']   = 'eUniversitylondon Learner';
        $data['users']        =  User::where('user_type','user')->orwhere('user_type', 'learner')->paginate(10);
        return view('users/index', $data);
    }

    public function user_create() {
        return view('users.create');
    }

    public function getusers($id){
        $data         = [];
        $user         = User::find($id);
        $data['user'] = $user;
        return Response::json($data);
    }

    public function reset_password(Request $request)
    {
      $password = Auth::user()->password;
      $validator = Validator::make($request->all(), [
        'old_password'     => 'required',
        'new_password'     => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
      ]);

     

      if ($validator->passes()) {
        
          //echo bcrypt($request->old_password).'__'.$password; exit;
         if(!Hash::check($request->old_password, $password)){
          $data['error']  = 'The specified password does not match the database password';
           return response()->json(['error'=>'The specified password does not match the database password']);
        }else{
          
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return response()->json(['error'=>'null']);
      }
     }else{

       return response()->json(['error'=>$validator->errors()->all()]); 
      }

     

    }

    public function store_test(Request $request) {
      $organization             = new Organization;
      $organization->name       = $request->name;
      $organization->email      = $request->email;
      $organization->phone      = $request->phone;
      $organization->country_id = $request->country;
      $organization->state_id   = $request->state;
      $organization->city_id    = $request->city;
      $saved                    = $organization->save();
      if ($saved) {
       return redirect()->back()->with('message', 'Organization has been created successfully!');
      } else {
       return redirect()->back()->with('error', 'Couldn\'t create organization!');
      }
     }

    public function create_user(Request $request){
      $users              = new User;

      $users->first_name  = $request->first_name;
      $users->last_name   = $request->last_name;
      $users->phone       = $request->phone;
      $users->user_type   = $request->user_type;
      $users->status      = $request->status;
      $users->username    = $this->getUsername($request->first_name,$request->last_name);
      $users->email       = $request->email;
      $users->password    = bcrypt($request->password);
      $saved              = $users->save();
     if ($saved) {
         $usertype = $request->user_type;
         $first_name = $request->first_name;
         $pass = $request->password;
         $email = $request->email;
         Mail::send('emails.SendPassword', ['first_name' => $first_name, 'usertype' => $usertype, 'pass'=> $pass, "email" => $email], function($message)  use ($usertype, $email){
             $message->to($email);
             $message->subject("Your " . $usertype . " account has been created successfully!!!");
         });

       $request->session()->flash('alert-success', 'User was successful added!');
       return redirect('/admin/users');
      } else {
       return redirect()->back()->with('error', 'Couldn\'t create organization!');
      }

    }

    public function edit_user($id){
        $user           = User::find($id); //Get user with specified id
        $data['user']   =   $user;
        return view('users.edit',$data); //pass user and roles data to view
    }

    public function update_user(Request $request){
       $id              =        $request->user_id;
       $this->validate($request, [
            'first_name'=>'required|max:120',
            'last_name'=>'required|max:120',
            'user_type'=>'required',
            'status'=>'required',
            'email'=>'required|email|unique:users,email,'.$id
        ]); 
      $users              = User::find($id);
      $users->first_name  = $request->first_name;
      $users->last_name   = $request->last_name;
      $users->phone       = $request->phone;
      $users->user_type   = $request->user_type;
      $users->email       = $request->email;
      $users->status      = $request->status;
      $saved              = $users->save(); 
      if ($saved) {
       $request->session()->flash('message', 'User was successful edited!');
       return redirect('/admin/users');
      } else {
       return redirect()->back()->with('error', 'Couldn\'t create organization!');
      } 
    }

    public function isEmailExist(Request $request) {
      $email            = $request->email;
      $id               = $request->id;
      $exist            = false;
      if($id > 0){
        $user           = User::where('email', $email)->where('id', '!=', $id)->first();
        if($user){
          $exist        = true;
        }
      } else {
          $user         = User::where('email', $email)->first();
          if($user){
            $exist      = true;
          }
      }
      return Response::json(['exist'=> $exist]);
    }

    public function getUsername($firstName, $lastName) {
        $username     = Str::slug($firstName . "-" . $lastName);
        $userRows     = User::whereRaw("username REGEXP '^{$username}(-[0-9]*)?$'")->get();
        $countUser    = count($userRows) + 1;
        return ($countUser > 1) ? "{$username}-{$countUser}" : $username;
    }

    public function delete_user($id,Request $request) {
          //Find a user with a given id and delete
          $user       = User::findOrFail($id);
          $user_type = $user['user_type'];
          $user->delete();
          $request->session()->flash('alert-success', 'User was successful deleted!');
          if($user_type == "instructor") {
              return redirect('/admin/instructor');
          } else if($user_type == "learner") {
              return redirect('/admin/learner');
          } else {
              return redirect('/admin/dashboard');
          }

    }


    public function store(Request $request) {

    //Validate name, email and password fields
        $this->validate($request, [
            'first_name'=>'required|max:120',
            'last_name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $user       = User::create($request->only('email', 'first_name', 'last_name', 'password')); //Retrieving only the email and password data
        $roles      = $request['roles']; //Retrieving the roles field
    //Checking if a role was selected
        if (isset($roles)) {

            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();
            $user->assignRole($role_r); //Assigning role to user
            }
        }
    //Redirect to the users.index view and display message
        return redirect()->route('users.index')
            ->with('message',
             'User successfully added.');
    }





    
    public function show($id) {
        return redirect('/admin/users');
    }

    
    public function edit($id) {
        $user           = User::find($id); //Get user with specified id
        $data['user']   =   $user;
        return view('users.edit',$data); //pass user and roles data to view
    }

    public function update(Request $request, $id = null) {

        if(!$id) $id = Auth::user()->id;
        $user = User::findOrFail($id); //Get role specified by id
        //Validate name, email and password fields
        $this->validate($request, [
            'first_name'=>'required|max:120',
            'last_name'=>'required|max:120',
            'username'=>'unique:users,username,'.$id,
            'email'=>'required|email|unique:users,email,'.$id
        ]);

        
        $input = $request->only(['first_name', 'last_name', 'email']); 
        if($request->password) {
          $input['password'] = bcrypt($request->password);
        }
        if($request->hasFile('avatar')){


        if($user->avatar!='default.jpg'){
        unlink(public_path() . '/uploads/avatars/'.$user->avatar);
        }


        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        //Image::make($avatar)->resize(90, 90)->save( public_path('/uploads/avatars/' . $filename ) );
        $request->file('avatar')->move('uploads/avatars', $filename);
        $input['avatar'] = $filename;

        }


        if($user->fill($input)->save()){
        $request->session()->flash('message', 'User was successful Edited!');
        return redirect('/admin/my-account');
        }else{
        return redirect()->back()->with('error', 'Couldn\'t create organization!');

        }

    }

    
    public function destroy($id) {
    //Find a user with a given id and delete
        $user = User::findOrFail($id);
        $user_type = $user['user_type'];
        $user->delete();
        if($user_type == "instructor") {
            return redirect('/admin/instructor')->with('message', 'Selected category has been deleted successfully!');
        } else if($user_type == "learner") {
            return redirect('/admin/learner')->with('message', 'Selected category has been deleted successfully!');
        } else {
            return redirect('/admin/users')->with('message', 'Selected category has been deleted successfully!');
        }
    }

    public function my_account() {
      $id                     = Auth::user()->id;
      $user                   = User::findOrFail($id); //Get user with specified id
      $data                   = [];
      
      $data['is_reload_btn']  = 0;
      $data['is_plus_icon']   = 0;
      $data['sub_heading']    = 'My Account';
      $data['page_title']     = 'My Account - National Installations Portal';
      $data['user']           = $user;
      return view('accounts.index', $data);
    }
}
