@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
<h1>利用者編集画面</h1>
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
            <form method="POST" action="{{ url('/users/update/'.$user->id)}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>


                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}">
                    </div>

                    <div class="form-group">
                        <label for="role">権限設定</label><br>
                        <select name="role" class="form-control w-50">
                            <option value="0" @if($user->role==0) selected @endif>一般</option>
                            <option value="1" @if($user->role==1) selected @endif>管理者</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="ml-3">
                        <button type="submit" class="btn btn-primary">登録</button>
                        <button class="btn btn-primary" onclick="history.back()">戻る</button>
                    </div>
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