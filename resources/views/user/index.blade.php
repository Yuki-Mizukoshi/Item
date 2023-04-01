@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
<h1>@if(Auth::user()->role==1)利用者一覧画面@else利用者情報画面@endif</h1>
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

                @can('admin')
                <button class="btn btn-primary"><a href="{{ url('/users/add')}}">利用者登録</a></button>
                <div class="card-tools">
                    <form action="/users" method="get">
                        <div class="inputarea d-flex w-100">
                            <div>
                                <input type="search" name="keyword" class="form-control" placeholder="キーワード入力" value="@if(isset($keyword)) {{ $keyword }} @endif">
                            </div>
                            <button type="submit" class="btn btn-primary ml-2">検 索</button>
                            <button class="btn btn-primary ml-3"><a href="{{ url('/users') }}">クリア</a></button>
                        </div>
                    </form>
                </div>
                @endcan


                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th class="thema" id="hoge" data-bs-placement="top" data-toggle="popover" data-content="項目をクリックすると「昇順⇔降順」と切り替える事ができます">@sortablelink('id', 'ID')</th>
                                <th class="thema">@sortablelink('name', '名前')</th>
                                <th class="thema">@sortablelink('role', '権限')</th>
                                <th class="thema">@sortablelink('email', 'メールアドレス')</th>
                                <th class="thema">@sortablelink('created_at', '登録日')</th>
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
                                <td>{{ $user->created_at->format('Y年m月d日') }}</td>
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
                {{ $users->links() }}
                @can('admin')
                @if (count($users) >0)
                <p>全{{ $users->total() }}件中
                    {{ ($users->currentPage() -1) * $users->perPage() + 1}} -
                    {{ (($users->currentPage() -1) * $users->perPage() + 1) + (count($users) -1)  }}件のデータが表示されています。
                </p>
                @else
                <p>登録されているデータがありません。</p>
                @endif
                @endcan
            </div>
        </div>
    </div>
    @stop

    @section('css')
    <link rel="stylesheet" href="/css/mizukoshi.css">

    @stop

    @section('js')

    <script>
        $(function() {
            $('#hoge').popover({
                trigger: 'hover', // click,hover,focus,manualを選択出来る
            });
        });
    </script>
    @stop