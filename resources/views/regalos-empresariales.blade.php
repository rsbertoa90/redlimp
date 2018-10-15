@extends('layouts.app')



@section('breadcrumb')
    {{ Breadcrumbs::render('regalos-empresariales') }}
@endsection

@section('content')
    
        <app-regalos></app-regalos>
     
@endsection