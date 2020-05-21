<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\UserAddress;
use App\Order;
use App\User;

use Auth;

use Session;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {
        $data         = [];

        $data['sub_heading']  = 'Order Page';
        $data['page_title']   = "eUniversityLondon";

        $data['Orders']              = Order::orderBy("id", "desc")->paginate(10);

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

        return view('order.index', $data);
    }

    public static function GetUserOnID($id) {
        /*************** User Info *************/
        $UserInfo = User::find($id);
        /*************** User Info *************/

        return $UserInfo;
    }

    public function ViewOrder($id) {

        $data                   = [];

        $data['sub_heading']    = 'Order';
        $data['page_title']     = 'eUniversitylondon';



        $session_result = Order::where("id", $id)->where("key", "cartItem")->first();
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
        $data['addressData']    = UserAddress::where("user_id", $session_result->user_id)->get();
        /*************** Billing Info *************/


        return view('order.view', $data);
    }

    public function destroy($id) {
        //Find a user with a given id and delete
        $Order = Order::findOrFail($id);
        $Order->delete();
        return redirect()->back()->with('message', 'Selected Order has been deleted successfully!');
    }

}
