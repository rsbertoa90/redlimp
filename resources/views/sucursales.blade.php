@extends('layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('sucursales') }}
@endsection

@section('content')
    <app-sucursales></app-sucursales>
@endsection