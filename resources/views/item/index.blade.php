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
                    <div class="input-group input-group-sm">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><a href="{{ url('items/add') }}">商品登録</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>型番</th>
                            <th>タイプ</th>
                            <th>料金（税込）</th>
                            <th>在庫数（個）</th>
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