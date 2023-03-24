@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
<h1>利用者登録</h1>
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
            <form method="POST" action="{{ url('/users/create') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">利用者名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="必須入力" value="{{ old('name') }}">
                    </div>


                    <div class="form-group">
                        <label for="price">メールアドレス</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="必須入力" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="必須入力">
                    </div>

                    <div class="form-group">
                        <label for="confirm">パスワード（確認用）</label>
                        <input type="password" class="form-control" id="confirm" name="confirm" placeholder="必須入力">
                    </div>

                    <div class="form-group">
                        <label for="role">権限設定</label><br>
                        <select name="role" class="form-control w-50">
                            <option value="0">一般</option>
                            <option value="1">管理者</option>
                        </select>
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
@stop

@section('js')
@stop