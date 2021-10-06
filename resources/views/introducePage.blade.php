@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="introducePageDive">
                <h1 class="introducePageTitle">iPhoneをより便利に</h1>
                <p class="introduceText">iPhoneやiPadには複数の機能や操作を自動化する
                    ”ショートカット”という機能があります。</p>
                <div class="introduceImgDiv">
                    <img class="introduceImage" src="{{ asset('image/topImage.png') }}">
                </div>
                <p class="introduceText">
                    壁紙を1タップで変更したり、
                    決済アプリを一覧から表示したりすることができます。
                </p>
                <div class="introduceImgWrapper">
                    <div class="introduceImgDiv">
                        <a href="https://gyazo.com/9013972e77578864be3c93f6fe6c52cd"><img class="gyazo" src="https://i.gyazo.com/9013972e77578864be3c93f6fe6c52cd.gif" alt="Image from Gyazo" /></a>
                        <p class="imageDescription">
                            [壁紙変更]
                        </p>
                    </div>
                    <div class="introduceImgDiv">
                        <a href="https://gyazo.com/e056dd8644f198a484181ed4fa7c18d3"><img class="gyazo" src="https://i.gyazo.com/e056dd8644f198a484181ed4fa7c18d3.gif" alt="Image from Gyazo" /></a>
                        <p class="imageDescription">
                            [決済アプリ表示]
                        </p>
                    </div>
                </div>
                <p class="introduceText">“Shortcut Recipe”では様々な”ショートカット”を
                    簡単にダウンロードできます。</p>
                <div class="usefulImgDiv">
                    <a href="https://gyazo.com/399c4ab0c6445b3c9260ddfa1fc592e7"><img　class="gyazo" src="https://i.gyazo.com/399c4ab0c6445b3c9260ddfa1fc592e7.gif" alt="Image from Gyazo" /></a>
                </div>
                <v-row justify="center">
                    <v-btn class="introduceButton font-weight-bold my-5" color="#FFD500" rounded large onclick="location.href='/'">ショートカットを探す</v-btn>
                </v-row>
            </div>
        </div>
    </div>
</div>
@endsection