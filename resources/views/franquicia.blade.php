@extends('layouts.app')


@section('breadcrumb')
    {{ Breadcrumbs::render('franquicia') }}
@endsection

@section('content')
    <app-franquicia></app-franquicia>
@endsection