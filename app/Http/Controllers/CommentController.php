<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Ratings;
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

        $data['sub_heading']  = 'Reviews';
        $data['page_title']   = 'eUniversitylondon Reviews';

        $data['Comment']        =  Ratings::paginate(10);
        $data['Courses']        =  Courses::where('course_status', "yes")->get();

        return view('comment/index', $data);
    }

    public function CommentAdd(Request $request){
        $Rating         = new Ratings;

        $this->validate($request, [
            'star_val'=>'required',
            'ccomments'=>'required'
        ]);

        $Rating->course_id      = $request->cid;
        $Rating->user_id        = Auth::user()->id;
        $Rating->name           = Auth::user()->first_name . " " . Auth::user()->last_name;
        $Rating->rating         = $request->star_val;
        $Rating->ccomment       = $request->ccomments;
        $Rating->commentlevel   = 0;

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
        $data['Comment'] = Ratings::find($id);

        return Response::json($data);
    }

    public function CommentsBlocked(Request $request){
        $msg_sts = "";
        $Comment = Ratings::find($request->id);
        if($Comment) {
            if($Comment->status == "yes") {
                $Comment->status      = "no";
                $msg_sts = "Blocked";
            } else {
                $Comment->status      = "yes";
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
            'star_val'=>'required',
            'ccomments'=>'required'
        ]);
        $Rating               = Ratings::find($id);

        $Rating->course_id      = $request->cid;
        $Rating->user_id        = Auth::user()->id;
        $Rating->name           = Auth::user()->first_name . " " . Auth::user()->last_name;
        $Rating->rating         = $request->star_val;
        $Rating->ccomment       = $request->ccomments;
        $Rating->commentlevel   = 0;

        $saved                  = $Rating->save();

        if ($saved) {
            $request->session()->flash('message', 'Comment was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/comment');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Comment!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Comment = Ratings::findOrFail($id);
        $Comment->delete();
        return redirect('/' . collect(request()->segments())->first() . '/comment')->with('message', 'Selected Comment has been deleted successfully!');
    }

}
