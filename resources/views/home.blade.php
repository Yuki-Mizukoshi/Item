@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>{{ Auth::user()->name }}さん、こんにちは</h1>
@stop

@section('content')
<p>ログイン成功しました</p>


<ul class="slider-1" id="js-slider-1">
  <li><img src="https://placehold.jp/600x400.png" alt=""></li>
  <li><img src="https://placehold.jp/600x400.png" alt=""></li>
  <li><img src="https://placehold.jp/600x400.png" alt=""></li>
  <li><img src="https://placehold.jp/600x400.png" alt=""></li>
</ul>


@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}


@stop

@section('js')
<script>
    console.log('Hi!');
</script>


<!-- slick -->


<script type="text/javascript">
 $(function () {
  $('#js-slider-1').slick({
    arrows: true, // 前・次のボタンを表示する
    dots: true, // ドットナビゲーションを表示する
    speed: 1000, // スライドさせるスピード（ミリ秒）
    slidesToShow: 1, // 表示させるスライド数
    centerMode: true, // slidesToShowが奇数のとき、現在のスライドを中央に表示する
    variableWidth: true, // スライド幅の自動計算を無効化
  });
});
</script>



@stop