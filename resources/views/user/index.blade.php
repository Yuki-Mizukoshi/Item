@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
<h1>利用者一覧</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <br>
                @if (session('msg'))
                <div class="flash_message bg-success text-center py-3 mb-3">
                    {{ session('msg') }}
                </div>
                @endif

               
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>利用者名</th>
                            <th>権限</th>
                            <th>メールアドレス</th>
                            <th> <button class="btn btn-primary"><a href="{{ url('/users/add')}}">利用者登録</a></button></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>@if($user->role==0)一般 @else 管理者 @endif</td>
                            <td>{{ $user->email }}</td>
                            <td><button class="btn btn-primary"><a href="{{ url('/users/edit/'.$user->id)}}">編集</a></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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