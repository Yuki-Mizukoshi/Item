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
        // $users = User::sortable()->get();
        $admin = User::where('role', 1)->get();

        $admin = count($admin);

        $id=Auth::user()->id;

        if (!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        }

        if (Auth::user()->role == 0) {
            $query->where('id', Auth::id());
        }

        $users = $query->sortable()->paginate(3);

        if ($users === null) {
            return redirect('/users')->with('msg', '入力されたキーワードは存在しません');
        }

        return view('user.index', ['users' => $users, 'admin' => $admin,'id'=>$id]);
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
        if (Auth::user()->id == $user->id || Auth::user()->role == 1) {
            return view('user.edit', ['user' => $user]);
        } else {
            return abort('404', 'not found');
        }
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        //一般ユーザー：自分自身
        if ($user->id == Auth::user()->id && $user->role == 0) {
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email',
                'password' => 'min:8',
                'confirm' => 'required|same:password',

            ]); //管理者かつ自分自身
        } elseif ($user->id == Auth::user()->id && $user->role == 1) {
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email',
                'password' => 'min:8',
                'confirm' => 'required|same:password',
                'role' => 'required',
            ]);
        } else { //管理者かつ自分以外
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email',
                'role' => 'required',
            ]);
        }

        if (strlen($request->password) >= 8) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        //管理者
        if (Auth::user()->role == 1) {
            $user->role = $request->role;
        }
        $user->save();

        return redirect('/users')->with('msg', 'ID:' . $user->id . $user->name . 'を編集しました');
    }

    public function delete($id)
    {
        // dd($id);

        //
        $user = User::find($id);

        //管理者の抽出
        $admin = User::where('role', 1)->get();
        $admin = count($admin);

       
        
        //URL直打ち対策：管理者が１人の時、削除できない
        if ($admin == 1 && Auth::user()->id==$id && Auth::user()->role===1) {
            return redirect('/users')->with('msg', '管理者自身は削除できません');
        }


        // dd($id, Auth::user()->role, Auth::user()->id);
        //ログイン一般ユーザーかつログイン中ユーザーIDが削除対象
        if (Auth::user()->role === 0 && Auth::user()->id==$id) {
            $user->delete();
            return redirect('/register');
            //管理者かつユーザー数が０人より多い場合、ユーザー一覧画面に遷移する
        } elseif (Auth::user()->role === 1) {
            $user->delete();
            return redirect('/users')->with('msg', 'ID:' . $user->id . $user->name . 'を削除しました');
        } 
        return redirect('/users')->with('msg', '権限がありません');
    }
}
