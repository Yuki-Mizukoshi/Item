@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
<h1>利用者編集画面</h1>
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
            <form method="POST" action="{{ url('/users/update/'.$user->id)}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @if(Auth::user()->id==$user->id)
                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="confirm">パスワード（確認用）</label>
                        <input type="password" class="form-control @error('confirm') is-invalid @enderror" id="confirm" name="confirm" placeholder="必須入力">
                        @error('confirm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endif

                    @can('admin')
                    <div class="form-group">
                        <label for="role">権限設定</label><br>
                        <select name="role" class="form-control w-50 @error('role') is-invalid @enderror">
                            <option value="" disabled selected>選択してください</option>
                            <option value="0" @if($user->role==0) selected @endif>一般</option>
                            <option value="1" @if($user->role==1) selected @endif>管理者</option>
                        </select>
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endcan
                </div>
                <div class="d-flex">
                    <div class="ml-3">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </div>
            </form>
            <div class="ml-3 mt-3 mb-3">
                <button class="btn btn-primary"><a href="{{ url('/users') }}">戻る</a></button>
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