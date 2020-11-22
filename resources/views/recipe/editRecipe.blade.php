@extends('layouts.app')

@section('content')
<edit-recipe-component :application_list="{{ $application_list }}" :product_list="{{ $product_list }}" :situation_list="{{ $situation_list }}"></edit-recipe-component>
@endsection