@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div>
                <span class="font-weight-bold">パスワード初期化が完了しました</span>
            </div>
            <div>
                <a href="{{ route('/') }}">ホーム画面へ移動</a>
            </div>
        </div>
    </div>
</div>
@endsection