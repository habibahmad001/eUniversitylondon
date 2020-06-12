<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Categories;

use App\cart;
use Auth;
use App\CMS;

use Session;

class CMSController extends Controller
{
    public function __construct() {
        $this->header_title = "eUniversitylondon";
    }

    public function index() {

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

    public static function CMSPageItems($id) {

        $cms      = CMS::where("id", $id)->first();

        return $cms;
    }

    public static function cmsBTN($content_id, $page_id) {
        if(isset(Auth::user()->user_type) && Auth::user()->user_type == "admin") {
            echo "<div style='float: right; vertical-align: top; position: absolute; display: inline-block; right: 0;'><button type='button' name='cms' class='btn btn-outline-success' style='max-height: 35px; max-width: 50px; padding: 5px; font-size: 15px;' data-pid='".$page_id."' data-id='".$content_id."' data-toggle=\"modal\" data-target=\"#cmsModal\">Edit</button></div>";
        }
    }

    public function SaveCMS(Request $request) {

        $cms      = CMS::firstOrNew(array('id' => $request->id));

        $cms->cms_title                 =   $request->cms_title;
        $cms->cms_desc                  =   $request->cms_desc;
        $cms->cms_pid                   =   $request->pid;

        $saved                          =   $cms->save();

        if ($saved) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Courses!');
        }
    }

    public function PageReload($name) {
        if($name == "home")
            return redirect()->intended("/");
        else
            return redirect()->intended("/" . $name);
    }


    public function GetCMS($id) {

        $data         = [];
        $cms         = CMS::find($id);
        $data['CMS'] = $cms;

        return Response::json($data);
    }

    public function CMSPageContent($pid) {

        $cms         = CMS::where("cms_pid", $pid)->get();

        return $cms;
    }

    public function CMSUpdate($id) {

        $data       =   [];

        $data["cms"]         = CMS::find($id);

        return view('frontend.cmsupdate', $data);
    }

    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with('message', 'Selected category has been deleted successfully!');
    }

}
