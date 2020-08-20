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

class ReportsController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {
        $data         = [];

        $data['sub_heading']  = 'Reports Page';
        $data['page_title']   = "eUniversityLondon";

        $data['Reports']      = Order::orderBy("id", "desc")->paginate(10);

        /*************** Totals *************/
        if(count($data['Reports']) > 0) {
            $Tot_Arr = [];
            foreach($data['Reports'] as $val) {
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


        return view('reports.index', $data);
    }

    public function InstructorRreports() {
        $data         = [];

        $data['sub_heading']  = 'Reports Page';
        $data['page_title']   = "eUniversityLondon";

        $data['Reports']      = Order::orderBy("id", "desc")->get();

        /*************** Totals *************/
        if(count($data['Reports']) > 0) {
            $Tot_Arr = [];
            foreach($data['Reports'] as $val) {
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


        return view('reports.ireport', $data);
    }

    public function destroy($id) {
        //Find a user with a given id and delete
        $Order = Order::findOrFail($id);
        $Order->delete();
        return redirect()->back()->with('message', 'Selected Order has been deleted successfully!');
    }

}
