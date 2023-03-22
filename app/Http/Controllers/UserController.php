<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {

        $users=User::all();

        return view('user.index',['users'=>$users]);

    }

    public function add(Request $request)
    {

            

        
        return view('user.add');
    }
}
