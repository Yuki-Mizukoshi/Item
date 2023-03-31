<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = User::query();
        $users = User::sortable()->get();

        if (!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        }

        if (Auth::user()->role == 0) {
            $query->where('id', Auth::id());
        }

        $users = $query->get();
        if ($users === null) {
            return redirect('/users')->with('msg', '入力されたキーワードは存在しません');
        }

        return view('user.index', ['users' => $users]);
    }


    public function add(Request $request)
    {

        return view('user.add');
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
            'confirm' => 'required|same:password'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/users')->with('msg', 'ID:' . $user->id . $user->name . 'を作成しました');
    }

    public function edit($id)
    {
        // dd($id);

        $user = User::find($id);
        if (Auth::user()->id != $user->id) {
            return abort('404', 'not found');
        }

        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        // dd($id);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'password' => 'min:8',
            'confirm' => 'required|same:password',
        ]);

        if (Auth::user()->id == 1) {
            $request->validate([
                'role' => 'required',
            ]);
        }

        $user = User::find($id);
        if (strlen($request->password) >= 8) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if (Auth::user()->id == 1) {
            $user->role = $request->role;
        }
        $user->save();

        return redirect('/users')->with('msg', 'ID:' . $user->id . $user->name . 'を編集しました');
    }




    public function delete($id)
    {
        // dd($id);
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('msg', 'ID:' . $user->id . $user->name . 'を削除しました');
    }
}
