@extends('layouts.app')

@section('content')
<recipe-list-component :recipes="{{ $recipes }}" :application_list="{{ $application_list }}" :product_list="{{ $product_list }}" :situation_list="{{ $situation_list }}"></recipe-list-component>
@endsection