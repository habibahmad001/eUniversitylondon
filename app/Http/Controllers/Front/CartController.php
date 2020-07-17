<?php

namespace App\Http\Controllers\Front;

use App\CourseProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\User;
use App\Categories;
use App\Courses;
use App\cart;
use App\Country;
use App\State;
use App\UserAddress;
use App\CourseWithUser;
use App\Order;
use App\CourseStarted;

use Auth;

use Session;

class CartController extends Controller
{
    public function __construct() {
        $this->header_title = "eUniversitylondon";

        /************** Cart Delete all values less then today **************/
        $carts = cart::where('created', "<", Carbon::today())->get();
        foreach($carts as $cv) {
            $cv->delete();
        }
        /************** Cart Delete all values less then today **************/
    }

    public function index() {

        $data                   = [];

        $data['sub_heading']    = 'Cart';
        $data['page_title']     = 'eUniversitylondon Cart';

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->first();
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
        $data['Courses']            = Courses::where("course_status","yes")->take(10)->orderBy('id', 'desc')->get();

        return view('frontend.cart', $data);
    }

    public static function CartTotal() {

        $Total = "";
        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->first();
        if($session_result === null) {
            $Total = "emp";
        } else {
            $CartItems = (array) json_decode($session_result->val, true);
            /*************** Totals *************/
            $Total = 0;
            foreach($CartItems as $v) {
                $Total = $Total + ($v[3]*$v[2]);
            }
            $Total = $Total;
            /*************** Totals *************/

            return $Total;
        }
    }

    public function ReviewCart() {

        $data                   = [];

        $data['sub_heading']    = 'Cart';
        $data['page_title']     = 'eUniversitylondon Cart';

        if((isset(Auth::user()->user_type) && Auth::user()->user_type == "instructor") or (isset(Auth::user()->user_type) && Auth::user()->user_type == "admin")) {
            Auth::logout();
            return redirect()->intended('/')->withErrors(['email' => 'Please login with the learner account to purchase any course !!!']);
        }

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->first();
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

        $data["datenow"] = Carbon::today();

        return view('frontend.reviewcart', $data);
    }

    public function AddressInfo() {

        $data                   = [];

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data['sub_heading']    = 'Cart';
        $data['page_title']     = 'eUniversitylondon Cart';

        $data['Country']        = Country::where("status", "yes")->get();
        $data['State']          = State::where("status", "yes")->get();
        $data['addressData']    = UserAddress::where("user_id", Auth::user()->id)->get();

        return view('frontend.addressinfo', $data);
    }

    public function Paypal() {

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

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->first();
        if($session_result === null) {
            $data["CartItems"] = "emp";
        } else {
            $CartItems = (array) json_decode($session_result->val, true);
            $data["CartItems"] = $CartItems;
        }

        $data['sub_heading']    = 'Paypal';
        $data['page_title']     = 'eUniversitylondon Paypal';

        return view('frontend.paypal', $data);
    }


    public function PayPalSuccess() {

//        echo "<pre>" . print_r($request) . "</pre>";exit();

        if((isset(Auth::user()->user_type) && Auth::user()->user_type == "instructor") or (isset(Auth::user()->user_type) && Auth::user()->user_type == "admin")) {
            Auth::logout();
            return redirect()->intended('/')->withErrors(['email' => 'Please login with the learner account to purchase any course !!!']);
        }

        /************** Set order Table ********/
        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->first();
        if($session_result === null) {
            $data["CartItems"] = "emp";
        } else {
            $CartItems = (array) json_decode($session_result->val, true);

            $Order         = new Order;

            $Order->user_id         =  Auth::user()->id;
            $Order->key             =  $session_result->key;
            $Order->val             =  $session_result->val;
            $Order->order_id        =  $session_result->id;
            $Order->order_items     =  count($CartItems);
            $Order->order_state     =  "Completed";
            $Order->created         =  $session_result->created;

        }

        $saved          =   $Order->save();

        if ($saved) {
            /************** Remove Item From Cart **************/
            $carts = cart::where('session_id', $session_result->session_id)->first();
            $carts->delete();
            /************** Remove Item From Cart **************/

            /************** Insert User to Course **************/

            if(count($CartItems) > 0) {
                foreach($CartItems as $v) {
                    $CourseWithUser         = new CourseWithUser;
//                    $CourseWithUser = ["user_id" => Auth::user()->id, "course_id" => $v[4]];
//                    \DB::table('tableuserwithcourse')->insert($CourseWithUser);

                    $CourseWithUser->user_id         =  Auth::user()->id;
                    $CourseWithUser->course_id       =  $v[4];

                    $saved                           =   $CourseWithUser->save();
                }
                return redirect()->intended('/learner/course');
            }
            /************** Insert User to Course **************/
        }
        /************** Set order Table ********/
    }

    public function RetakeExam($cid) {

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data         = [];

        $data['sub_heading']  = 'Retake Exam Page';
        $data['page_title']   = $this->header_title;

        $data['cid']   = $cid;

        return view('frontend.retake', $data);
    }

    public function CardAuth() {
        if(!Auth::user()) {
            return redirect()->back()->withErrors(['email' => 'Please login first !!!']);
        }
    }

    public function StartCourse($course_id) {

        $data                   = [];

        $data['sub_heading']            = 'Course Detaile';
        $data['page_title']             = 'eUniversitylondon Course Detaile';

        if(!Auth::user()) {
            return redirect()->intended('/')->withErrors(['email' => 'Please login first !!!']);
        }

        $data['cid']            = $course_id;

        $courewithuser                  = CourseWithUser::where("user_id", Auth::user()->id)->where('course_id', $course_id)->get();
        if(count($courewithuser) > 0) {
            $UserProgramData  = CourseStarted::where('course_id', $course_id)->where('user_id', Auth::user()->id)->get();
            if(count($UserProgramData) > 0) {
                $data['courseData']             = CourseProgram::where("id", $UserProgramData[0]->CourseProgramID)->get();
                $pdfpath    =   "/uploads/courseprogrampdf/";
            } else {
                $data['courseData']             = Courses::where("id", $course_id)->get();
                $pdfpath    =   "/uploads/coursepdf/";
            }
            $data['UserProgramData']            = $UserProgramData;
            $data['courseprogramData']          = CourseProgram::where("course_id", $course_id)->get();
            $data['PDFpath']  = $pdfpath;

            /*************** Number of days left ************/
            $date = new \DateTime();
            $date_dd = $date->format('Y-m-d H:i:s');
            $data['DaysLeft']  = "";
            $created_date = $courewithuser[0]->created_at;
            $diff_in_days = $created_date->diffInDays($date_dd);
            $data['DaysLeft']  = 365 - $diff_in_days;
            /*************** Number of days left ************/
            return view('frontend.startcourse', $data);
        } else {
            return redirect()->intended('/learner/course')->withErrors(['email' => 'Please purchase this course first !!!']);
        }
    }

    public function SaveAddress(Request $request){

        $UserAddress           = UserAddress::firstOrNew(array('user_id' => Auth::user()->id));

        $same = $request->same;

        $this->validate($request, [
            'street'=>'required',
            'count'=>'required',
            'stat'=>'required',
            'city'=>'required',
            'zip'=>'required'
        ]);

        if($same == 1) {
            $UserAddress->user_id = Auth::user()->id;
            $UserAddress->b_street_address = $request->street;
            $UserAddress->b_country = $request->count;
            $UserAddress->b_state = $request->stat;
            $UserAddress->b_city = $request->city;
            $UserAddress->b_zip = $request->zip;
            $UserAddress->s_street_address = $request->street;
            $UserAddress->s_country = $request->count;
            $UserAddress->s_state = $request->stat;
            $UserAddress->s_city = $request->city;
            $UserAddress->s_zip = $request->zip;
        } else {
            $UserAddress->user_id = Auth::user()->id;
            $UserAddress->b_street_address = $request->street;
            $UserAddress->b_country = $request->count;
            $UserAddress->b_state = $request->stat;
            $UserAddress->b_city = $request->city;
            $UserAddress->b_zip = $request->zip;
            $UserAddress->s_street_address = $request->s_street;
            $UserAddress->s_country = $request->s_count;
            $UserAddress->s_state = $request->s_stat;
            $UserAddress->s_city = $request->s_city;
            $UserAddress->s_zip = $request->s_zip;
        }


        $saved          = $UserAddress->save();

        if ($saved) {
            $request->session()->flash('message', 'Billing & Shipping info has been added Successfully !!!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('message', 'Faild to add this information !!!');
        }
    }


    public static function GetCountryName($id){

        $RES          = Country::where("id", $id)->first();
        return $RES;
    }

    public static function GetProductCount(){

        $data = [];
        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->first();
        if($session_result === null) {
            $data["ItemsMSG"] = "emp";
        } else {
            $CartItems = (array) json_decode($session_result->val, true);
            $data["ItemsCount"]      =  count($CartItems);
            $data["ItemsMSG"]        =  "Successss";
        }
        return $data;
    }

    public static function GetStateName($id){

        $RES          = State::where("id", $id)->first();
        return $RES;
    }

    public function SelectState(Request $request) {

        $cid                    = $request->id;

        $States              = State::where("cid", $cid)->where("status", "yes")->get();

        return Response::json($States);
    }

    public function AddCart(Request $request){

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->get();
            if(count($session_result) > 0) {
                $CartItems = (array) json_decode($session_result[0]->val, true);
                if(array_key_exists($request->pid, $CartItems)) {
                    foreach($CartItems as $k=>$v) {
                        if($request->pid == $k) {
                            $CartItems[$k][2] = $v[2]+1;
                            $prod_name = $v[1];
                        }
                    }
                    $sess         = cart::firstOrNew(array('session_id' => session()->getId()));
                    $sess->val = json_encode($CartItems);

                    $sess->save();

                    return redirect()->intended('/cart')->with('message', 'Quantity of "' . $prod_name . '" has been updated!!!');
                } else {
                    $sess           = cart::firstOrNew(array('session_id' => session()->getId()));
                    $prod_data      = Courses::where("id", $request->pid)->first();
                    $CartItems[$request->pid] = array($prod_data->course_avatar, $prod_data->course_title, 1, $prod_data->course_price, $prod_data->id);
                    $sess->val      = json_encode($CartItems);

                    $sess->save();

                    return redirect()->intended('/cart')->with('message', '"' . $prod_data->course_title . '" has been added to Cart!!!');
                }
            } else {
                $cartSession = [];

                $prod_data      = Courses::where("id", $request->pid)->first();
                $cartSession[$request->pid] = array($prod_data->course_avatar, $prod_data->course_title, 1, $prod_data->course_price, $prod_data->id);

                $sessNewItem    = cart::firstOrNew(array('session_id' => session()->getId()));
                $sessNewItem->session_id = session()->getId();
                $sessNewItem->key = "cartItem";
                $sessNewItem->val = json_encode($cartSession);

                $sessNewItem->save();

                return redirect()->intended('/cart')->with('message', 'Cart has setup!!!');
            }


//        $cartSession = [];
//
//        $cartSession[1] = array("01.jpg", "Premium Quality", 2, 55);  // array( "img", "name", "qty", "price", "id");
//        $cartSession[2] = array("02.jpg", "Woo Ninja", 5, 5);
//        $cartSession[3] = array("03.jpg", "Woo Album #3", 1, 99);
//
//        $sess         = cart::firstOrNew(array('session_id' => session()->getId()));
//        $sess->session_id = session()->getId();
//        $sess->key = "cartItem";
//        $sess->val = json_encode($cartSession);
//
//        $sess->save();

    }

    public function UpdateCart(Request $request){

        $quantity = $request->quantity;

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->get();
        if(count($session_result) > 0) {
            $CartItems = (array) json_decode($session_result[0]->val, true);
            $index_item = 0;
            foreach($CartItems as $k=>$v) {
                $CartItems[$k][2] = $quantity[$index_item];
                $index_item++;
            }
            $sess         = cart::firstOrNew(array('session_id' => session()->getId()));
            $sess->val = json_encode($CartItems);

            $sess->save();
            return redirect()->intended('/cart')->with('message', 'Quantity has been updated Successfully!!!');
        }
    }


    public function RemoveItem(Request $request){

        $itemid = $request->itemid;

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->get();
        if(count($session_result) > 0) {
            /************ Update Undo Field ************/
            $sess         = cart::firstOrNew(array('session_id' => session()->getId()));
            $sess->undo_field = $session_result[0]->val;

            $sess->save();
            /************ Update Undo Field ************/

            /************ Update After Delete Item ************/
            $CartItems = (array) json_decode($session_result[0]->val, true);
            unset($CartItems[$itemid]);
            $sess->val = json_encode($CartItems);

            $sess->save();
            /************ Update After Delete Item ************/

            return redirect()->intended('/cart')->with('message', 'Item has been removed from cart Successfully!!!');
        }
    }

    public function UndoItem(){

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->get();
        if(count($session_result) > 0) {
            /************ Update After Delete Item ************/
            $sess         = cart::firstOrNew(array('session_id' => session()->getId()));
            $sess->val = $session_result[0]->undo_field;

            $sess->save();
            /************ Update After Delete Item ************/

            return redirect()->intended('/cart')->with('message', 'Back to previous state!!!');
        }
    }


    public function InsertDataCountries(){

        $file_n = app_path().'/../database/seeds/countriesandstates.json';
//            $file_n = './countriesandstates.json';
        $str = file_get_contents($file_n);
        $json = json_decode($str, true);
        $countindex = 0;
        foreach($json["countries"] as $v) {
            //            echo '<pre>' . $v["country"] . '</pre>';
            //            echo '<pre>' . print_r($v["states"], true) . '</pre>';
            $country_row = ["country_name" => $v["country"]];
            if(count($v["states"]) > 0) {
                $country_id	=	\DB::table('tablecountry')->insertGetId($country_row);
                foreach($v["states"] as $val) {
                    $state_row = ["state_name" => $val, "cid" => $country_id];
                    \DB::table('tablestate')->insert($state_row);
                }

            } else {
                \DB::table('tablecountry')->insert($country_row);
            }
            $countindex++;
        }
        $this->command->info('Country and states data has been successfully inserted !!!');
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with('message', 'Selected category has been deleted successfully!');
    }

}
