@extends('layouts.app')

@section('content')

    @if ($products)
        <app-search-results :ids="{{json_encode($products)}}" searchString="{{$search}}"></app-search-results>
    @else
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div>
            <h1>Ups! disculpa, no hay resultado de búsqueda.</h1> 
            <h4>Te dejamos nuestros numeros por si queres contactarnos</h4>
            <div>
                <span class="fa fa-whatsapp mr-2" style="color:#25d366; font-size:2rem" > </span>Whatsapp: +54 9 11 3008-5414
            </div> 
            <div class="mt-4">
                <h4>Contacto de nuestras sucursales ( De lunes a Viernes de 9 a 18 hs)</h4>
                <ul>
                    <li> <span class="fa fa-star"></span> Pasteur 428, CABA <span class="ml-2"> Teléfono: 4951-5417</span></li>
                    <li> <span class="fa fa-star"></span> Sarmiento 2268, CABA   <span class="ml-2"> Teléfono: 4951-1128</span></li>
                    <li> <span class="fa fa-star"></span> Castelli 203, CABA <span class="ml-2"> Teléfono: 4951-4521</span></li>
                </ul>
            </div>
        </div>
    </div>
    @endif
@endsection