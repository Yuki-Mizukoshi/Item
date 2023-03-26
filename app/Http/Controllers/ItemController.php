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
    public function index(Request $request)
    {
        
        $keyword = $request->input('keyword');
        // $sort = $request->input('sort');
        $query = Item::query();

        $items=Item::sortable()->get();

        if (!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('detail', 'LIKE', "%{$keyword}%");
                $items=$query->get();
        }

        // if ($sort == 'highprice') {
        //     $query->orderBy('price', 'desc');
        // } elseif ($sort == 'lowprice') {
        //     $query->orderBy('price', 'asc');
        // } elseif ($sort == 'typeasc') {
        //     $query->orderBy('type', 'asc');
        // } elseif ($sort == 'typedesc') {
        //     $query->orderBy('type', 'desc');
        // } elseif ($sort == 'highcount') {
        //     $query->orderBy('stock', 'desc');
        // } elseif ($sort == 'lowcount') {
        //     $query->orderBy('stock', 'asc');
        // }elseif ($sort == 'idasc') {
        //     $query->orderBy('id', 'asc');
        // } elseif ($sort == 'iddesc') {
        //     $query->orderBy('id', 'desc');
        // }
        // $items = $query->get();
        return view('item.index', ['items'=>$items,'keyword'=>$keyword]);
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
                'type' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'detail' => 'required'
            ]);

            // 商品登録
            // Item::create([
            //     'user_id' => Auth::user()->id,
            //     'name' => $request->name,
            //     'type' => $request->type,
            //     'price'=>$request->price,
            //     'stock'=>$request->stock,
            //     'detail' => $request->detail,
            // ]);

            $item = new Item();
            $item->user_id = Auth::user()->id;
            $item->name = $request->name;
            $item->type = $request->type;
            $item->price = $request->price;
            $item->stock = $request->stock;
            $item->detail = $request->detail;
            $item->save();

            return redirect('/items')->with('msg', $item->name . 'を作成完了しました');
        }

        return view('item.add');
    }

    public function edit($id)
    {
        // dd($id);
        $item = Item::find($id);

        return view('item.edit', ['item' => $item]);
    }

    public function detail($id)
    {
        // dd($id);
        $item = Item::find($id);

        return view('item.detail', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        // dd($id);

        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'detail' => 'required'
        ]);

        $item = Item::find($id);
        $item->name = $request->name;
        $item->type = $request->type;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->detail = $request->detail;
        $item->save();

        return redirect('/items')->with('msg', $item->name . '編集完了しました');
    }

    public function delete($id)
    {
        // dd($id);
        $item = Item::find($id);
        $item->delete();

        return redirect('/items')->with('msg', $item->name . 'を削除しました');
    }
}
