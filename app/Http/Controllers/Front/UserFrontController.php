<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use App\User;
use App\Order;
use App\UserAddress;
use App\Courses;

use Auth;

use Session;

class UserFrontController extends Controller
{
    public function __construct() {
        $this->header_title = "eUniversitylondon";

        /************ Only for Auth User ************/
        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }
        /************ Only for Auth User ************/
    }

    public function index() {

        $data['sub_heading']  = 'Category';
        $data['page_title']   = 'eUniversitylondon Category';

        if(Auth::user()) {
            $data['user']              = User::where("id", Auth::user()->id)->first();
        } else {
            return redirect('/')->with(['email' => 'Please login first !!!']);
        }


        return view('frontend.dashboard', $data);
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

    public function ViewOrder($id) {

        $data                   = [];

        $data['sub_heading']    = 'Order';
        $data['page_title']     = 'eUniversitylondon Order';



        $session_result = Order::where("id", $id)->where("user_id", Auth::user()->id)->where("key", "cartItem")->first();
        $data['OrderInfo']     = $session_result;
        if($session_result === null) {
            $data["CartItems"] = "emp";
        } else {
            $CartItems = (array) json_decode($session_result->val, true);
            $data["CartItems"] = $CartItems;
            /*************** Totals *************/
            $SubTotal = 0;
            $Total = 0;
            foreach($CartItems as $v) {
                $SubTotal = $SubTotal + ($v[3]*$v[2]);
                $Total = $Total + ($v[3]*$v[2]);
            }
            $data["SubTotal"] = $SubTotal;
            $data["Total"] = $Total;
            /*************** Totals *************/
        }

        /*************** Billing Info *************/
        if(Auth::user()) {
            $data['addressData']    = UserAddress::where("user_id", Auth::user()->id)->get();
        } else {
            $data['addressData']    = array();
        }
        /*************** Billing Info *************/


        return view('frontend.vieworder', $data);
    }

    public function Orders(){
        $data         = [];

        $data['sub_heading']  = 'Order Page';
        $data['page_title']   = $this->header_title;

        if(Auth::user()) {
            $data['Orders']              = Order::where("user_id", Auth::user()->id)->orderBy("id", "desc")->get();

            /*************** Totals *************/
            if(count($data['Orders']) > 0) {
                $Tot_Arr = [];
                foreach($data['Orders'] as $val) {
                    $CartItems = (array) json_decode($val->val, true);

                    $Total = 0;
                    foreach($CartItems as $v) {
                        $Total = $Total + ($v[3]*$v[2]);
                    }
                    $Tot_Arr[$val->id] = $Total;
                }
                $data['TotalPrice'] = $Tot_Arr;
            }

            /*************** Totals *************/
        } else {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        return view('frontend.order', $data);
    }

    public static function GetCourseOnID($id){
        $Courses         = Courses::find($id);
        return $Courses;
    }

    public function OrderAgain($id) {

        $data                   = [];

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $addressData    = UserAddress::where("user_id", Auth::user()->id)->get();
        if(count($addressData) > 0) {
            $data['addressData']    = $addressData;
        } else {
            return redirect()->intended('/addressinfo')->with('message', 'Please setup billing & shipping information first !!!');
        }

        $session_result = order::where("id", $id)->where("user_id", Auth::user()->id)->where("key", "cartItem")->first();
        if($session_result === null) {
            $data["CartItems"] = "emp";
        } else {
            $CartItems = (array) json_decode($session_result->val, true);
            $data["CartItems"] = $CartItems;
        }

        $data['OrderAgain']     = 'yes';

        $data['sub_heading']    = 'Paypal';
        $data['page_title']     = 'eUniversitylondon Paypal';

        return view('frontend.paypal', $data);
    }

    public function OGSuccess() {
        return redirect()->intended('/learner/course')->withErrors(['email' => 'You have successfully purchase these courses again !!!']);
    }


    public function AccountDetail(){
        $data         = [];

        $data['sub_heading']  = 'Account Detail Page';
        $data['page_title']   = $this->header_title;

        if(Auth::user()) {
            $data['user']              = User::where("id", Auth::user()->id)->first();
        } else {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        return view('frontend.accountdetail', $data);
    }

    public function UpdateUser(Request $request) {
        if(Auth::user()) {
            $id              =        $request->user_id;
            $this->validate($request, [
                'account_first_name'=>'required',
                'account_last_name'=>'required',
                'account_email'=>'required|email|unique:users,email,'.$id
            ]);
            $users              = User::find($id);
            $users->first_name  = $request->account_first_name;
            $users->last_name   = $request->account_last_name;
            $users->email       = $request->account_email;
            if(isset($request->password_current)) {
                $this->validate($request, [
                    'password_current'     => 'required',
                    'password_1'     => 'required|min:6',
                    'password_2' => 'required|same:password_1',
                ]);
                $users->password    = bcrypt($request->password_1);
                $users->passupdated = "yes";
            }

            $saved              = $users->save();
            if ($saved) {
                $request->session()->flash('message', 'User information has been updated Successfully !!!');
                return redirect()->back();
            } else {
                return redirect()->back()->with('error', 'Couldn\'t update user info !!!');
            }
        } else {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }
    }

    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with('message', 'Selected category has been deleted successfully!');
    }

}
