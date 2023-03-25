@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
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
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea name="detail" id="detail" cols="10" rows="5" class="form-control" placeholder="詳細情報入力"></textarea>
                            
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                        <button class="btn btn-primary" onclick="history.back()">戻る</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="/css/mizukoshi.css">
@stop


@section('js')
@stop
