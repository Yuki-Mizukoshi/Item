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

    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'role'=>'required',
            'confirm'=>'required|same:password'
        ]);

        $user=new User();
        $user->name=$request->name;
        $user->role=$request->role;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->save();

        return redirect('/users');
    }

    public function edit($id)
    {
        // dd($id);
        $user=User::find($id);

        return view('user.edit',['user'=>$user]);

    }

    public function update(Request $request, $id)
    {
        // dd($id);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'password'=>'required',
            'role' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->save();
        

        return redirect('/users')->with('msg', $user->name . '編集完了しました');
    }

    public function delete($id)
    {
        // dd($id);
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('msg', $user->name . 'を削除しました');
    }

}
