@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
<h1>編集画面</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card card-primary">
            <form method="POST" action="{{ url('/items/update/'.$item->id)}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                    </div>

                    <div class="form-group">
                        <label for="type">タイプ</label>
                        <select name="type" id="type" class="form-control">
                            <option value="" selected disabled>選択してください</option>
                            @foreach(\App\Models\Item::TYPES as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">金額（税込）</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{ $item->price }}">
                    </div>

                    <div class="form-group">
                        <label for="stock">在庫数</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{ $item->stock }}">
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <textarea name="detail" id="detail" cols="10" rows="5" class="form-control">{{ $item->detail }}</textarea>
                    </div>

                    <div class="card-footer d-flex">
                        <button type="submit" class="btn btn-primary">登録</button>
                        <button class="btn btn-primary" onclick="history.back()">戻る</button>
                    </div>
                </div>
            </form>
            <div>
                <form action="{{ url('/items/delete/'.$item->id) }}" method="POST">
                                @csrf
                 <button type="submit" class="btn btn-danger mr-2 ml-2" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
             </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop