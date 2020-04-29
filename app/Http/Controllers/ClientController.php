<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;



use App\Clients;

use Auth;

class ClientController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Client';
        $data['page_title']   = 'eUniversitylondon Client';
        $data['Client']        =  Clients::paginate(10);
        
        return view('client/index', $data);
    }

    public function ClientAdd(Request $request){
        $Client         = new Clients;
        $this->validate($request, [

            'c_name'=>'required',
        ]);

        $Client->client_name  = $request->c_name;

        /************ Logo Upload ***********/
        if(!empty($request->file('c_logo'))) {
            $ClientLogo = $request->file('c_logo');
            $ClientLogo_new_name = rand() . '.' . $ClientLogo->getClientOriginalExtension();
            $Client->client_logo = $ClientLogo_new_name;
            $ClientLogo->move('uploads/client', $ClientLogo_new_name);
        }
        /************ Logo Upload ***********/

        $saved          = $Client->save();

        if ($saved) {
            $request->session()->flash('message', 'Client successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/client');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Client!');
        }
    }

    public function GetClient($id){
        $data         = [];
        $Clients         = Clients::find($id);
        $data['Clients'] = $Clients;
        return Response::json($data);
    }

    public function UpdateClient(Request $request){
        $id              =        $request->c_id;
        $this->validate($request, [
            'c_name'=>'required',
        ]);
        $Client              = Clients::find($id);

        $Client->client_name  = $request->c_name;

        /************ Logo Upload ***********/
        if(!empty($request->file('c_logo'))) {
            $ClientLogo = $request->file('c_logo');
            $ClientLogo_new_name = rand() . '.' . $ClientLogo->getClientOriginalExtension();
            $Client->client_logo = $ClientLogo_new_name;
            $ClientLogo->move('uploads/client', $ClientLogo_new_name);
        }
        /************ Logo Upload ***********/

        $saved              = $Client->save();

        if ($saved) {
            $request->session()->flash('message', 'Clients was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/client');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Client!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Client = Clients::findOrFail($id);
        $Client->delete();
        return redirect('/' . collect(request()->segments())->first() . '/client')->with('message', 'Selected Client has been deleted successfully!');
    }
}
