<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\Categories;

use Auth;

use Session;

class Category extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Category';
        $data['page_title']   = 'eUniversitylondon Category';
        $data['categories']   =  Categories::where("category_cid", 0)->paginate(10);
        $data['ALLCats']      =  Categories::where("category_cid", 0)->get();

        return view('categories/index', $data);
    }

    public static function HasSubItem($id){

        $Res_cat          = Categories::where("category_cid", $id)->get();
        if(count($Res_cat) > 0)
            $res  = 1;
        else
            $res  = 0;
        return $res;
    }

    public static function CatID($id){

        $RES          = Categories::where("id", $id)->first();
        return $RES;
    }

    public static function ChildCount($id){

        $Res_cat          = Categories::where("category_cid", $id)->count();
        return $Res_cat;
    }

    public static function AllParentsCat(){

        $Res_cat          = Categories::where("category_cid", 0)->get();
        return $Res_cat;
    }

    public function ChildItem(Request $request){

        $id  = $request->id;
        $data['sub_heading']  = 'Category';
        $data['page_title']   = 'eUniversitylondon Category';
        $data['categories']   =  Categories::where('category_cid', $id)->paginate(10);
        $data['ALLCats']      =  Categories::where("category_cid", 0)->get();

        return view('categories/index', $data);

    }

    public function CategoryAdd(Request $request){ //exit($request->axaxa);
        $categories         = new Categories;
        $this->validate($request, [

            'cat_title'=>'required',
            'c_content'=>'required',
            'iconval'=>'required',
            'p_slug'=>'required',
        ]);
        $categories->category_title  = $request->cat_title;
        $categories->category_desc  = $request->c_content;
        $categories->selectedicon  = $request->iconval;
        $categories->page_slug  = str_replace(" ", "_", strtolower($request->p_slug));
        $categories->category_cid  = $request->sel_txt;
        $saved          = $categories->save();
        if ($saved) {
            $request->session()->flash('message', 'Category successfully added!');
            return redirect('/admin/category');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Category!');
        }
    }

    public function GetCategories($id){
        $data         = [];
        $categories         = Categories::find($id);
        $data['categories'] = $categories;
        return Response::json($data);
    }

    public function UpdateCategory(Request $request){
        $id              =        $request->cat_id;
        $this->validate($request, [
            'cat_title'=>'required',
            'c_content'=>'required',
            'iconval'=>'required',
            'p_slug'=>'required',
        ]);
        $categories              = Categories::find($id);
        $categories->category_title  = $request->cat_title;
        $categories->category_desc  = $request->c_content;
        $categories->selectedicon  = $request->iconval;
        $categories->page_slug  = str_replace(" ", "_", strtolower($request->p_slug));
        $categories->category_cid  = $request->sel_txt;
        $saved              = $categories->save();
        if ($saved) {
            $request->session()->flash('message', 'Categories was successful edited!');
            return redirect('/admin/category');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Categories!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with('message', 'Selected category has been deleted successfully!');
    }

}
