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
                <button class="btn btn-primary"><a href="{{ url('/users/add')}}">利用者登録</a></button>
                <!-- <form action="/users" method="get">
                        <div class="inputarea d-flex w-100">
                            <div>
                                <select name="sort" class="form-control">
                                    <option value="hiname">名前（降順）</option>
                                    <option value="lowname">名前（昇順）</option>
                                    <option value="idasc">ID（昇順）</option>
                                    <option value="iddesc">ID（降順）</option>
                                    <option value="hirole">権限（昇順）</option>
                                    <option value="lowrole">権限（降順）</option>
                                    <option value="hiemail">メールアドレス（降順）</option>
                                    <option value="lowemail">メールアドレス（昇順）</option>
                                </select>
                            </div>
                            <div>
                                <input type="search" name="keyword" class="form-control" placeholder="キーワード入力" value="@if(isset($keyword)) {{ $keyword }} @endif">
                            </div>
                            <button type="submit" class="btn btn-primary ml-2">検 索</button>
                            <button class="btn btn-primary ml-3"><a href="{{ url('/items') }}">クリア</a></button>
                        </div>
                    </form>
            <!-- </div> --> 
                <div class="card-body table-responsive p-0">

                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID<a href="/users?sort=idasc" class="sort">▲</a><a href="/users?sort=iddesc" class="sort">▼</a></th>
                                <th>名前<a href="/users?sort=hiname" class="sort">▲</a><a href="/users?sort=lowname" class="sort">▼</a></th>
                                <th>権限<a href="/users?sort=hirole" class="sort">▲</a><a href="/users?sort=lowrole" class="sort">▼</a></th>
                                <th>メールアドレス<a href="/users?sort=hiemail" class="sort">▲</a><a href="/users?sort=lowemail" class="sort">▼</a></th>
                                <th></th>
                                <th></th>
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
                                <td>
                                    <form action="{{ url('/users/delete/'.$user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                                    </form>
                                </td>
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