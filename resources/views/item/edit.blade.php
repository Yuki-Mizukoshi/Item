@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
<h1>編集画面</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        <!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif -->

        <div class="card card-primary">
            <form method="POST" action="{{ url('/items/update/'.$item->id)}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{ $item->name }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">タイプ</label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="" selected disabled>選択してください</option>
                            @foreach(\App\Models\Item::TYPES as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">金額（税込）</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $item->price }}">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock">在庫数</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ $item->stock }}">
                        @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <textarea name="detail" id="detail" cols="10" rows="5" class="form-control @error('detail') is-invalid @enderror">{{ $item->detail }}</textarea>
                        @error('detail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </div>
            </form>
            <div class="ml-3 mb-3">
                <button class="btn btn-primary"><a href="{{ url('/items') }}">戻る</a></button>
            </div>
        </div>
    </div>

</div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/mizukoshi.css">
@stop

@section('js')
@stop