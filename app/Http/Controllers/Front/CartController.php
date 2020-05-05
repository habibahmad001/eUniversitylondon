<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\User;
use App\Categories;
use App\Courses;
use App\cart;

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

        $data['sub_heading']    = 'Cart';
        $data['page_title']     = 'eUniversitylondon Cart';

        $data                   = [];

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->whereDate('created', Carbon::today())->first();
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

    public function ReviewCart() {

        $data['sub_heading']    = 'Cart';
        $data['page_title']     = 'eUniversitylondon Cart';

        return view('frontend.reviewcart', $data);
    }

    public function AddCart(Request $request){

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->whereDate('created', Carbon::today())->get();
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

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->whereDate('created', Carbon::today())->get();
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

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->whereDate('created', Carbon::today())->get();
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

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->whereDate('created', Carbon::today())->get();
        if(count($session_result) > 0) {
            /************ Update After Delete Item ************/
            $sess         = cart::firstOrNew(array('session_id' => session()->getId()));
            $sess->val = $session_result[0]->undo_field;

            $sess->save();
            /************ Update After Delete Item ************/

            return redirect()->intended('/cart')->with('message', 'Back to previous state!!!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with('message', 'Selected category has been deleted successfully!');
    }

}
