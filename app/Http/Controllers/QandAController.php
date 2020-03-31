<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\QandA;
use Auth;

class QandAController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Question & Answer';
        $data['page_title']   = 'eUniversitylondon Question & Answer';
        $data['QandA']        =  QandA::where("qa_cid", 0)->paginate(10);
        return view('qa/index', $data);
    }

    public function ChildItem(Request $request){

        $id  = $request->id;
        $data['sub_heading']    = 'Question & Answer';
        $data['page_title']     = 'eUniversitylondon Question & Answer';
        $data['QandA']          =  QandA::where('qa_cid', $id)->paginate(10);
        return view('qa/index', $data);

    }

    public function qandaAdd(Request $request){ //exit($request->axaxa);
        $QandA         = new QandA;
        $this->validate($request, [

            'qa_title'=>'required',
            'qa_content'=>'required'
        ]);
        $QandA->qa_title    = $request->qa_title;
        $QandA->qa_desc     = $request->qa_content;
        $QandA->qa_cid      = $request->sel_txt;
        $saved              = $QandA->save();
        if ($saved) {
            $request->session()->flash('message', 'Question & Answer successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/questionandanswer');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Question & Answer!');
        }
    }

    public function Getqanda($id){
        $data           = [];
        $QandA          = QandA::find($id);
        $data['QAdata']  = $QandA;
        return Response::json($data);
    }

    public function Updateqanda(Request $request){
        $id              =        $request->cat_id;
        $this->validate($request, [
            'qa_title'=>'required',
            'qa_content'=>'required'
        ]);
        $QandA              = QandA::find($id);
        $QandA->qa_title    = $request->qa_title;
        $QandA->qa_desc     = $request->qa_content;
        $QandA->qa_cid      = $request->sel_txt;
        $saved              = $QandA->save();
        if ($saved) {
            $request->session()->flash('message', 'Question & Answer was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/questionandanswer');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Question & Answer!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $QandA = QandA::findOrFail($id);
        $QandA->delete();
        return redirect()->back()->with('message', 'Selected Question & Answer has been deleted successfully!');
    }

}
