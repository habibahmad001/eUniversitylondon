<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\CMS;

use Auth;

use Session;

class cmsc extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'CMS';
        $data['page_title']   = 'eUniversitylondon CMS';
        $data['cms']        =  CMS::where("cms_status", "yes")->paginate(7);
        return view('cms/index', $data);
    }

    public function SelectPage($cms_pid) {

        $data['sub_heading']  = 'CMS';
        $data['page_title']   = 'eUniversitylondon CMS';
        $data['cms']        =  CMS::where("cms_status", "yes")->where("cms_pid", $cms_pid)->paginate(10);
        return view('cms/index', $data);
    }

    public function CMSAdd(Request $request){ //exit($request->axaxa);
        $cms         = new CMS;
        $this->validate($request, [

            'cms_title'=>'required',
            'cms_desc'=>'required'
        ]);
        $cms->cms_title  = $request->cms_title;
        $cms->cms_desc  = $request->cms_desc;

        $saved          = $cms->save();
        if ($saved) {
            $request->session()->flash('message', 'CMS successfully added!');
            return redirect('/admin/cms');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create CMS!');
        }
    }

    public function GetCMS($id){
        $data         = [];
        $cms         = CMS::find($id);
        $data['cms'] = $cms;
        return Response::json($data);
    }

    public function UpdateCMS(Request $request){
        $id              =        $request->cms_id;
        $this->validate($request, [
            'cms_title'=>'required',
            'cms_desc'=>'required'
        ]);
        $cms              = CMS::find($id);
        $cms->cms_title  = $request->cms_title;
        $cms->cms_desc  = $request->cms_desc;
        $saved              = $cms->save();
        if ($saved) {
            $request->session()->flash('message', 'CMS was successful edited!');
            return redirect('/admin/cms');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create CMS!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = CMS::findOrFail($id);
        $categories->delete();
        return redirect('/admin/cms')->with('message', 'Selected category has been deleted successfully!');
    }

}
