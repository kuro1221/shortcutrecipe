@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div>
                <h1 class="page-title__large">iPhoneをより便利に</h1>
                <p class="introduceText">iPhoneやiPadには複数の機能や操作を自動化する
                    ”ショートカット”という機能があります。</p>
                <div class="introduceImgDiv">
                    <img class="introduceImage" src="{{ asset('image/topImage.png') }}">
                </div>
                <p class="introduceText">
                    例えば、Bluetoothイヤホンに自動接続して
                    好きな音楽を再生したり、毎朝お気に入りの写真を壁紙にしたりすることができます。
                </p>
                <div class="introduceImgDiv">
                    <a href="https://gyazo.com/6b41bc11e8347a540f4ce185514a32fc"><img class="gyazo" src="https://i.gyazo.com/6b41bc11e8347a540f4ce185514a32fc.gif" width="300" alt="Image from Gyazo" /></a>
                </div>
                <p class="introduceText">“Shortcut Recipe”では様々な”ショートカット”を
                    簡単にダウンロードできます。</p>
            </div>
        </div>
    </div>
</div>
@endsection