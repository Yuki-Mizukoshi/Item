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
                            <th>メールアドレス</th>
                            <th> <button class="btn btn-primary"><a href="{{ url('/users/add')}}">利用者登録</a></button></th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr>
                            @foreach($users as $user)
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><button class="btn btn-primary"><a href="#">編集</a></button></td>
                            @endforeach
                        </tr>
                     
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