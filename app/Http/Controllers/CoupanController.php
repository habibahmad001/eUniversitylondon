<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;
use App\Coupan;

use Auth;

use Session;

class CoupanController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Coupan';
        $data['page_title']   = 'eUniversitylondon Coupan';

        $data['Coupan']        =  Coupan::where('status', "yes")->paginate(10);

        return view('Coupan/index', $data);
    }

    public function CoupanAdd(Request $request){
        $Coupan         = new Coupan;

        $this->validate($request, [

            'title'=>'required',
            'value'=>'required',
            'startsFrom'=>'required',
            'endsTo'=>'required',
            'ccomments'=>'required'
        ]);
        $Coupan->title          = $request->title;
        $Coupan->value          = $request->value;
        $Coupan->startsFrom     = $request->startsFrom;
        $Coupan->endsTo         = $request->endsTo;
        $Coupan->ccomments      = $request->ccomments;

        $saved                  = $Coupan->save();

        if ($saved) {
            $request->session()->flash('message', 'Coupan successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/coupan');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Coupan!');
        }
    }

    public function GetCoupan($id){
        $data           = [];
        $data['Coupan'] = Coupan::find($id);

        return Response::json($data);
    }

    public function UpdateCoupan(Request $request){
        $id              =        $request->c_id;

        $this->validate($request, [

            'title'=>'required',
            'value'=>'required',
            'startsFrom'=>'required',
            'endsTo'=>'required',
            'ccomments'=>'required'
        ]);
        $Coupan                 = Coupan::find($id);
        $Coupan->title          = $request->title;
        $Coupan->value          = $request->value;
        $Coupan->startsFrom     = $request->startsFrom;
        $Coupan->endsTo         = $request->endsTo;
        $Coupan->ccomments      = $request->ccomments;

        $saved                  = $Coupan->save();

        if ($saved) {
            $request->session()->flash('message', 'Coupan was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/coupan');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Coupan!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Coupan = Coupan::findOrFail($id);
        $Coupan->delete();
        return redirect('/' . collect(request()->segments())->first() . '/coupan')->with('message', 'Selected Coupan has been deleted successfully!');
    }

}
