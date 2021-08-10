@section('title', 'ショートカット編集')
@extends('layouts.app')

@section('content')
<edit-recipe-component :props_recipe="{{ $recipe }}" :props_select_application="{{$select_application}}" :props_select_product="{{$select_product}}" :application_list="{{ $application_list }}" :product_list="{{ $product_list }}" :situation_list="{{ $situation_list }}"></edit-recipe-component>
@endsection