@extends('layouts.app')

@section('content')
<profile-edit-component :props_auth_user="{{ $auth_user }}"></profile-edit-component>
@endsection