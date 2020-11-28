@extends('layouts.app')

@section('content')
<add-recipe-component :application_list="{{ $application_list }}" :product_list="{{ $product_list }}" :situation_list="{{ $situation_list }}" :csrf="{{json_encode(csrf_token())}}"></add-recipe-component>
@endsection