@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
<h1>商品一覧</h1>
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
                <button class="btn btn-primary"><a href="{{ url('items/add') }}">商品登録</a></button>
                <div class="card-tools">

                    <form action="/items" method="get">
                        <div class="inputarea d-flex w-100">
                            <!-- <div>
                                <select name="sort" class="form-control">
                                    <option value="highprice">価格の高い順</option>
                                    <option value="lowprice">価格の低い順</option>
                                    <option value="idasc">ID（昇順）</option>
                                    <option value="iddesc">ID（降順）</option>
                                    <option value="typeasc">タイプ別（昇順）</option>
                                    <option value="typedesc">タイプ別（降順）</option>
                                    <option value="lowcount">在庫の少ない数</option>
                                    <option value="highcount">在庫の多い数</option>
                                </select>
                            </div> -->
                            <div>
                                <input type="search" name="keyword" class="form-control" placeholder="キーワード入力" value="@if(isset($keyword)) {{ $keyword }} @endif">
                            </div>
                            <button type="submit" class="btn btn-primary ml-2">検 索</button>
                            <button class="btn btn-primary ml-3"><a href="{{ url('/items') }}">クリア</a></button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID<a href="/items?sort=idasc&keyword=" class="sort">▲</a><a href="/items?sort=iddesc&keyword=" class="sort">▼</a></th>
                            <th>型番<a href="/items?sort=highprice&keyword=" class="sort">▲</a><a href="/items?sort=lowprice&keyword=" class="sort">▼</a></th>
                            <th>タイプ<a href="/items?sort=typedesc&keyword=" class="sort">▲</a><a href="/items?sort=typeasc&keyword=" class="sort">▼</a></th>
                            <th>料金（税込)<a href="/items?sort=highprice&keyword=" class="sort">▲</a><a href="/items?sort=lowprice&keyword=" class="sort">▼</a></th>
                            <th>在庫数（個）<a href="/items?sort=highcount&keyword=" class="sort">▲</a><a href="/items?sort=lowcount&keyword=" class="sort">▼</a></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ \App\Models\Item::TYPES[$item->type]}}</td>
                            <td>{{ number_format($item->price) }}円</td>
                            <td>{{ $item->stock }}</td>
                            <td> <button class="btn btn-primary"><a href="{{ url('#') }}">詳細</a></button></td>
                            <td><button class="btn btn-primary"><a href="{{ url('/items/edit/'.$item->id) }}">編集</a></button></td>
                            <td>
                                <form action="{{ url('/items/delete/'.$item->id) }}" method="POST">
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