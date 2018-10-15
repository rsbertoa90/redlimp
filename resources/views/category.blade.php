@extends('layouts.app')



@section('breadcrumb')
    {{ Breadcrumbs::render('category',$category) }}
@endsection

@section('content')
    <app-category category_id="{{$category->id}}"></app-category>
@endsection