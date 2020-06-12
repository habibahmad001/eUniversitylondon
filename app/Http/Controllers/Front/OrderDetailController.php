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

class OrderDetailController extends Controller
{
    public function __construct() {
        $this->header_title = "eUniversitylondon";
    }

    public function index() {
        $data                   = [];

        $data['sub_heading']    = 'Order Detail';
        $data['page_title']     = 'eUniversitylondon Order Detail';

        $session_result = cart::where('session_id', session()->getId())->where("key", "cartItem")->whereDate('created', Carbon::today())->first();
        if($session_result === null) {
            $data["CartItems"] = "emp";
        } else {
            $CartItems = (array) json_decode($session_result->val, true);
            $data["CartItems"] = $CartItems;
        }

        return view('frontend.order-detail', $data);
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with('message', 'Selected category has been deleted successfully!');
    }

}
