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

                <div class="card-tools">

                    <form action="/items" method="get">
                        <div class="inputarea d-flex w-100">
                            <div>
                                <select name="sort" class="form-control">
                                    <option value="highprice">価格の高い順</option>
                                    <option value="lowprice">価格の低い順</option>
                                    <option value="type">タイプ別</option>
                                    <option value="lowcount">在庫の少ない数</option>
                                    <option value="highcount">在庫の多い数</option>
                                </select>
                            </div>
                            <div>
                                <input type="search" name="keyword" class="form-control" placeholder="キーワード入力">
                            </div>
                            <button type="submit" class="btn btn-primary">検 索</button>
                            <button class="btn btn-primary"><a href="{{ url('/items') }}">クリア</a></button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>型番</th>
                            <th>タイプ</th>
                            <th>料金（税込</th>
                            <th>在庫数（個）</th>
                            <th> <button class="btn btn-primary"><a href="{{ url('items/add') }}">商品登録</a></button></th>
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
                            <td><button class="btn btn-primary"><a href="{{ url('/items/edit/'.$item->id) }}">編集</a></button></td>
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