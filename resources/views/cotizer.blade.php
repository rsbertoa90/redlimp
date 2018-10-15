@extends('layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('cotizador') }}
@endsection

@section('content')
    @if (App\Config::find(1)->hide_prices)
        <div class="d-flex flex-column text-center w-100">
            <h1>Estamos Actualizando nuestros precios</h1>
            <h2>Vuelve a intentar mas adelante</h2>
        </div>
    @else
        <app-cotizer></app-cotizer>
    @endif
@endsection