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
        $data['categories']        =  Categories::paginate(10);
        return view('categories/index', $data);
    }

    public function ChildItem(Request $request){

        $id  = $request->id;
        $data['sub_heading']  = 'Category';
        $data['page_title']   = 'eUniversitylondon Category';
        $data['categories']   =  Categories::where('category_cid', $id)->paginate(10);
        return view('categories/index', $data);

    }

    public function CategoryAdd(Request $request){ //exit($request->axaxa);
        $categories         = new Categories;
        $this->validate($request, [

            'cat_title'=>'required',
            'c_content'=>'required'
        ]);
        $categories->category_title  = $request->cat_title;
        $categories->category_desc  = $request->c_content;
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
            'c_content'=>'required'
        ]);
        $categories              = Categories::find($id);
        $categories->category_title  = $request->cat_title;
        $categories->category_desc  = $request->c_content;
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
        return redirect('category')->with('message', 'Selected category has been deleted successfully!');
    }

}
