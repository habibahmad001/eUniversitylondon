<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\User;

use Auth;

use Session;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Comment';
        $data['page_title']   = 'eUniversitylondon Comment';

        $data['Comment']        =  Comments::where('status', "yes")->paginate(10);
        $data['Courses']        =  Courses::where('course_status', "yes")->get();

        return view('comment/index', $data);
    }

    public function CommentAdd(Request $request){
        $Comment         = new Comments;

        $this->validate($request, [
            'cuser'=>'required',
            'cemail'=>'required',
            'ccomments'=>'required'
        ]);

        $Comment->name         = $request->cuser;
        $Comment->email        = $request->cemail;
        $Comment->subComment   = 0;
        $Comment->message      = $request->ccomments;
        $Comment->course_id    = $request->cour_id;
        $Comment->liked        = json_encode(array("likes" => 0, "Comments" => 0));

        $saved                  = $Comment->save();

        if ($saved) {
            $request->session()->flash('message', 'Comment successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/comment');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Comment!');
        }
    }

    public function GetComment($id){
        $data           = [];
        $data['Comment'] = Comments::find($id);

        return Response::json($data);
    }

    public function CommentsBlocked(Request $request){
        $msg_sts = "";
        $Comment = Comments::find($request->id);
        if($Comment) {
            if($Comment->isActive == "yes") {
                $Comment->isActive      = "no";
                $msg_sts = "Blocked";
            } else {
                $Comment->isActive      = "yes";
                $msg_sts = "Approved";
            }
            $saved                  = $Comment->save();
        }

        if ($saved) {
            $request->session()->flash('message', 'Comment has been ' . $msg_sts . '!');
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Some backend issue to update status!');
        }
    }

    public function UpdateComment(Request $request){
        $id              =        $request->cid;

        $this->validate($request, [
            'cuser'=>'required',
            'cemail'=>'required',
            'ccomments'=>'required'
        ]);
        $Comment               = Comments::find($id);
        $Comment->name         = $request->cuser;
        $Comment->email        = $request->cemail;
        $Comment->subComment   = 0;
        $Comment->message      = $request->ccomments;
        $Comment->course_id    = $request->cour_id;
        $Comment->liked        = json_encode(array("likes" => 0, "Comments" => 0));

        $saved                  = $Comment->save();

        if ($saved) {
            $request->session()->flash('message', 'Comment was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/comment');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Comment!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Comment = Comments::findOrFail($id);
        $Comment->delete();
        return redirect('/' . collect(request()->segments())->first() . '/comment')->with('message', 'Selected Comment has been deleted successfully!');
    }

}
