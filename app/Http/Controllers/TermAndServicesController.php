<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;

use App\User;
use App\TermAndServices;

use Auth;

use Session;

class TermAndServicesController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Term And Services';
        $data['page_title']   = 'eUniversitylondon Term And Services';
        $data['TermAndServices']        =  TermAndServices::paginate(10);
        return view('termservices/index', $data);
    }

    public function TermAndServicesAdd(Request $request){
        $TermAndServices         = new TermAndServices;
        $this->validate($request, [

            'tns_title'=>'required',
            'tns_desc'=>'required'
        ]);
        $TermAndServices->termandservices_title  = $request->tns_title;
        $TermAndServices->termandservices_desc  = $request->tns_desc;

        $saved          = $TermAndServices->save();
        if ($saved) {
            $request->session()->flash('message', 'Term And Services successfully added!');
            return redirect('/admin/termservices');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Term And Services!');
        }
    }

    public function GetTermAndServices($id){
        $data         = [];
        $TermAndServices         = TermAndServices::find($id);
        $data['TermAndServices'] = $TermAndServices;
        return Response::json($data);
    }

    public function UpdateTermAndServices(Request $request){
        $id              =        $request->tns_id;
        $this->validate($request, [
            'tns_title'=>'required',
            'tns_desc'=>'required'
        ]);
        $TermAndServices              = TermAndServices::find($id);
        $TermAndServices->termandservices_title  = $request->tns_title;
        $TermAndServices->termandservices_desc  = $request->tns_desc;

        $saved              = $TermAndServices->save();
        if ($saved) {
            $request->session()->flash('message', 'CMS was successful edited!');
            return redirect('/admin/termservices');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create CMS!');
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
        $categories = TermAndServices::findOrFail($id);
        $categories->delete();
        return redirect('/admin/termservices')->with('message', 'Selected category has been deleted successfully!');
    }

}
