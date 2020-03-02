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
        $data['users']        =  User::where('user_type','user')->orwhere('user_type', 'instructor')->orwhere('user_type', 'learner')->paginate(10);
        return view('users/index', $data);
    }
}
