@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
<h1>商品一覧</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <br>
                @if (session('msg'))
                <div class="flash_message bg-success text-center py-3 mb-3" id="FlashMessage">
                    {{ session('msg') }}
                </div>
                @endif
                @can('admin')
                <button class="btn btn-primary"><a href="{{ url('items/add') }}">商品登録</a></button>
                @endcan

                <div class="card-tools">

                    <form action="/items" method="get">
                        <div class="inputarea d-flex w-100">
                            <!-- <div>
                                <select name="sort" class="form-control">
                                    <option value="highprice">価格の高い順</option>
                                    <option value="lowprice">価格の低い順</option>
                                    <option value="idasc">ID（昇順）</option>
                                    <option value="iddesc">ID（降順）</option>
                                    <option value="typeasc">タイプ別（昇順）</option>
                                    <option value="typedesc">タイプ別（降順）</option>
                                    <option value="lowcount">在庫の少ない数</option>
                                    <option value="highcount">在庫の多い数</option>
                                </select>
                            </div> -->
                            <div>
                                <input type="search" name="keyword" class="form-control" placeholder="キーワード入力" value="@if(isset($keyword)) {{ $keyword }} @endif">
                            </div>
                            <button type="submit" class="btn btn-primary ml-2">検 索</button>
                            <button class="btn btn-primary ml-3"><a href="{{ url('/items') }}">クリア</a></button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <!-- <th>ID<a href="/items?sort=idasc&keyword=" class="sort">▲</a><a href="/items?sort=iddesc&keyword=" class="sort">▼</a></th> -->
                            <th class="thema" id="hoge" data-bs-placement="top" data-toggle="popover" data-content="項目をクリックすると「昇順⇔降順」と切り替える事ができます">@sortablelink('id', 'ID')</th>
                            <th class="thema">@sortablelink('name', '型番')</th>
                            <th class="thema">@sortablelink('type', 'タイプ')</th>
                            <th class="thema">@sortablelink('price', '金額（税込）')</th>
                            <th class="thema">@sortablelink('stock', '在庫数（個）')</th>
                            <th class="thema">@sortablelink('created_at', '登録日')</th>
                            <th></th>
                            <!-- <th>型番<a href="/items?sort=lowprice&keyword=" class="sort">▲</a><a href="/items?sort=highprice&keyword=" class="sort">▼</a></th>
                            <th>タイプ<a href="/items?sort=typeasc&keyword=" class="sort">▲</a><a href="/items?sort=typedesc&keyword=" class="sort">▼</a></th>
                            <th>料金（税込)<a href="/items?sort=lowprice&keyword=" class="sort">▲</a><a href="/items?sort=highprice&keyword=" class="sort">▼</a></th>
                            <th>在庫数（個）<a href="/items?sort=lowcount&keyword=" class="sort">▲</a><a href="/items?sort=highcount&keyword=" class="sort">▼</a></th> -->
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ \App\Models\Item::TYPES[$item->type]}}</td>
                            <td>{{ number_format($item->price) }}円</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->created_at->format('Y年m月d日') }}</td>
                            <td> <button class="btn btn-primary"><a href="{{ url('/items/detail/'.$item->id) }}">詳細</a></button></td>
                            @can('admin')
                            <td><button class="btn btn-primary"><a href="{{ url('/items/edit/'.$item->id) }}">編集</a></button></td>
                            <td>
                                <form action="{{ url('/items/delete/'.$item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="ml-3">{{ $items->links() }}</div>
            @if (count($items) >0)
            <p class="ml-3">全{{ $items->total() }}件中
                {{ ($items->currentPage() -1) * $items->perPage() + 1}} -
                {{ (($items->currentPage() -1) * $items->perPage() + 1) + (count($items) -1)  }}件のデータが表示されています。
            </p>
            @else
            <p>登録されているデータがありません。</p>
            @endif
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/mizukoshi.css">

@stop

@section('js')
<script>
    //Sessionデータにメッセージが有るかどうかを確認
    if ("{{session('message')}}") {
        //phpのuniqid関数でユニーク値をセット
        const messageIdValue = "{{ uniqid() }}";
        //主要ブラウザはsessionStorageに対応しているが、念のため確認
        if (sessionStorage) {
            //messageIdの値が同じだったら、フラッシュメッセージをdisplay:none;する
            if (sessionStorage.getItem('messageId') === messageIdValue) {
                document.getElementById('#FlashMessage').style.display = "none";
            } else {
                //messageIdがない場合は新しくセット。
                //messageIdは有るが値が違う場合は上書き。
                sessionStorage.setItem('messageId', messageIdValue);
            }
        }
    }

    $(function() {
        $('#hoge').popover({
            trigger: 'hover', // click,hover,focus,manualを選択出来る
        });
    });
</script>
@stop