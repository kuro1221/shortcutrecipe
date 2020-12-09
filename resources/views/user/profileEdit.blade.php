@extends('layouts.app')

@section('content')
<profile-all-component :props_auth_user="{{ $auth_user }}"></profile-all-component>
@endsection