@extends('layouts.app')


@section('breadcrumb')
    {{ Breadcrumbs::render('product',$product) }}
@endsection


@section('content')

    <app-product :product_id="{{$product->id}}"></app-product>

@endsection