@section('title', '退会画面')

@extends('layouts.app')

@section('content')
<withdrawal-component :props_auth_user="{{ $auth_user }}"></withdrawal-component>
@endsection