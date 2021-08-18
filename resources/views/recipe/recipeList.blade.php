@section('title', 'ショートカット一覧')
@extends('layouts.app')

@section('content')
<recipe-list-component :auth_user="{{ $user }}" :recipes="{{ $recipes }}" :application_list="{{ $application_list }}" :product_list="{{ $product_list }}">
</recipe-list-component>
@endsection