@section('title', 'パスワード変更')

@extends('layouts.app')

@section('content')
<password-edit-component :props_auth_user="{{ $auth_user }}"></password-edit-component>
@endsection