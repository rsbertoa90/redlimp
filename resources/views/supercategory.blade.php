@extends('layouts.app')



@section('breadcrumb')
    {{ Breadcrumbs::render('supercategory',$supercategory) }}
@endsection

@section('content')
    <app-supercategory supercategory_id="{{$supercategory->id}}"></app-supercategory>
@endsection