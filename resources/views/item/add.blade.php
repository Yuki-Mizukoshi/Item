@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
<h1>商品登録</h1>
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
            <form method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="名前">
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
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="金額">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock">在庫数</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="在庫数">
                        @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">

                        <label for="detail">詳細</label>
                        <textarea name="detail" id="detail" cols="10" rows="5" class="form-control @error('detail') is-invalid @enderror" placeholder="詳細情報入力"></textarea>
                        @error('detail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="ml-3  mb-3">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
            <div class="ml-3 mb-3">
                <button class="btn btn-primary" onclick="history.back()">戻る</button>
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