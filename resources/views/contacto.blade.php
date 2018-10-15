@extends('layouts.app')


@section('breadcrumb')
    {{ Breadcrumbs::render('contacto') }}
@endsection

@section('content')
    <app-contacto></app-contacto>  
@endsection