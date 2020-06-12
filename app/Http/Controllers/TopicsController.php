<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;

use App\User;
use App\Topics;

use Auth;

use Session;

class TopicsController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Topics';
        $data['page_title']   = 'eUniversitylondon Topics';
        $data['Topics']        =  Topics::paginate(10);
        return view('topics/index', $data);
    }

    public function TopicsAdd(Request $request){
        $Topics         = new Topics;
        $this->validate($request, [

            'tns_title'=>'required',
            'iconval'=>'required',
            'tns_desc'=>'required'
        ]);
        $Topics->topics_title  = $request->tns_title;
        $Topics->selectedicon  = $request->iconval;
        $Topics->topics_desc  = $request->tns_desc;

        $saved          = $Topics->save();
        if ($saved) {
            $request->session()->flash('message', 'Topics successfully added!');
            return redirect('/admin/topics');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Topics!');
        }
    }

    public function GetTopics($id){
        $data         = [];
        $Topics         = Topics::find($id);
        $data['Topics'] = $Topics;
        return Response::json($data);
    }

    public function UpdateTopics(Request $request){
        $id              =        $request->tns_id;
        $this->validate($request, [
            'tns_title'=>'required',
            'iconval'=>'required',
            'tns_desc'=>'required'
        ]);
        $Topics              = Topics::find($id);
        $Topics->topics_title  = $request->tns_title;
        $Topics->selectedicon  = $request->iconval;
        $Topics->topics_desc  = $request->tns_desc;

        $saved              = $Topics->save();
        if ($saved) {
            $request->session()->flash('message', 'Topics was successful edited!');
            return redirect('/admin/topics');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Topics!');
        }
    }

    public function sendmail()
    {
        /*Mail::send('emails.mailExample', ['name' => "Habib",'email'=> "habibahmed001@gmail.com"], function($message) {
            $message->to("habibahmed001@gmail.com");
            $message->subject('Super Quiz reminder');
        });*/


        /*Mail::send('emails.verify', ['first_name' => "Habib", 'confirmation_code'=> "asasasa"], function($message) {
            $message->to("habibahmed001@gmail.com");
            $message->subject('Super Quiz reminder');
        });*/

        $usertype = "learner";
        $first_name = "Habib";
        $pass = "123456";
        $email = "Test@gmail.com";
        Mail::send('emails.SendPassword', ['first_name' => $first_name, 'usertype' => $usertype, 'pass'=> $pass, "email" => $email], function($message)  use ($usertype){
            $message->to("habibahmed001@gmail.com");
            $message->subject("Your " . $usertype . " account has been created successfully!!!");
        });
        return 'Email has been sent to habibahmed001@gmail.com';
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Topics = Topics::findOrFail($id);
        $Topics->delete();
        return redirect('/admin/topics')->with('message', 'Selected Topics has been deleted successfully!');
    }

}
