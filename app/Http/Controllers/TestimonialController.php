<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;



use App\Testimonial;

use Auth;

class TestimonialController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index() {

        $data['sub_heading']  = 'Testimonial';
        $data['page_title']   = 'eUniversitylondon Testimonial';
        $data['Testimonial']        =  Testimonial::paginate(10);
        
        return view('testimonial/index', $data);
    }

    public function TestimonialAdd(Request $request){
        $Testimonial         = new Testimonial;
        $this->validate($request, [

            't_name'=>'required',
            't_desc'=>'required',
            't_role'=>'required'
        ]);

        $Testimonial->testimonial_name  = $request->t_name;
        $Testimonial->testimonial_desc  = $request->t_desc;
        $Testimonial->testimonial_role  = $request->t_role;

        /************ Image Upload ***********/
        if(!empty($request->file('t_img'))) {
            $TestimonialImg = $request->file('t_img');
            $TestimonialImg_new_name = rand() . '.' . $TestimonialImg->getClientOriginalExtension();
            $Testimonial->testimonial_img = $TestimonialImg_new_name;
            $TestimonialImg->move('uploads/testimonial', $TestimonialImg_new_name);
        }
        /************ Image Upload ***********/

        $saved          = $Testimonial->save();

        if ($saved) {
            $request->session()->flash('message', 'Testimonial successfully added!');
            return redirect('/' . collect(request()->segments())->first() . '/testimonial');
        } else {
            return redirect()->back()->with('message', 'Couldn\'t create Testimonial!');
        }
    }

    public function GetTestimonial($id){
        $data         = [];
        $Testimonial         = Testimonial::find($id);
        $data['Testimonial'] = $Testimonial;
        return Response::json($data);
    }


    public function UpdateTestimonial(Request $request){
        $id              =        $request->t_id;
        $this->validate($request, [
            't_name'=>'required',
            't_desc'=>'required',
            't_role'=>'required'
        ]);
        $Testimonial              = Testimonial::find($id);
        $Testimonial->testimonial_name  = $request->t_name;
        $Testimonial->testimonial_desc  = $request->t_desc;
        $Testimonial->testimonial_role  = $request->t_role;

        /************ Image Upload ***********/
        if(!empty($request->file('t_img'))) {
            $TestimonialImg = $request->file('t_img');
            $TestimonialImg_new_name = rand() . '.' . $TestimonialImg->getClientOriginalExtension();
            $Testimonial->testimonial_img = $TestimonialImg_new_name;
            $TestimonialImg->move('uploads/testimonial', $TestimonialImg_new_name);
        }
        /************ Image Upload ***********/

        $saved              = $Testimonial->save();

        if ($saved) {
            $request->session()->flash('message', 'Testimonials was successful edited!');
            return redirect('/' . collect(request()->segments())->first() . '/testimonial');
        } else {
            return redirect()->back()->with('error', 'Couldn\'t create Testimonial!');
        }
    }


    public function destroy($id) {
        //Find a user with a given id and delete
        $Testimonial = Testimonial::findOrFail($id);
        $Testimonial->delete();
        return redirect('/' . collect(request()->segments())->first() . '/testimonial')->with('message', 'Selected Testimonial has been deleted successfully!');
    }
}
