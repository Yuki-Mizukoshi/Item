<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item
            ::where('items.status', 'active')
            ->select()
            ->get();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'type'=>'required',
                'price'=>'required',
                'stock'=>'required',
                'detail'=>'required'
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'price'=>$request->price,
                'stock'=>$request->stock,
                'detail' => $request->detail,
            ]);

            return redirect('/items')->with('msg','作成完了しました');
        }

        return view('item.add');
    }

    public function edit($id)
    {
        // dd($id);
       $item=Item::find($id);

        return view('item.edit',['item'=>$item]);
    }

    public function update(Request $request,$id)
    {
        // dd($id);

        $request->validate([
            'name' => 'required|max:100',
                'type'=>'required',
                'price'=>'required',
                'stock'=>'required',
                'detail'=>'required'
        ]);
       
        $item=Item::find($id);
        $item->name=$request->name;
        $item->type=$request->type;
        $item->price=$request->price;
        $item->stock=$request->stock;
        $item->detail=$request->detail;

        return redirect('/items')->with('msg','編集完了しました');
    }

    public function delete($id)
    {
        // dd($id);
       $item=Item::find($id);
       $item->delete();

        return redirect('/items')->with('msg','削除しました');
    }


}
