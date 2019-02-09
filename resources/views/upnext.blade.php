<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="image_src" href="{{asset('/storage/images/app/logo.png')}}">
    <link rel="canonical" href="{{URL::current()}}">
    @if (isset($meta))
        <title> {{$meta->metatitle}} </title>
        <meta name="description" content="{{$meta->metadescription}}">
    @endif



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    {{-- fontawesome --}}
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/animate.css') }}" rel="stylesheet"> --}}

    {{-- PRECONECTS --}}
    <link rel="preconnect" href="https://use.fontawesome.com">
    <link rel="preconnect" href="https://maps.google.com">
    <link rel="preconnect" href="https://www.google.com">

  
    {{-- Google search panel verif --}}
    <meta name="google-site-verification" content="Z6q5oeYmjW3CN16Xk0RqL-K-muZozhU29MIZ6VxO_jU" />
  
    
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134147970-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-134147970-1');
        </script>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="width:100vw">
        <div id="app" class="container container-fluid">
          
            <div class="row">
              
                <div class="col-12 w-100 row" style="margin-left:0.2%">
                                <main class="py-4 w-100 row">
                                    <div class="col-12">
                                        @yield('breadcrumb')
                                    </div>
                                    <div class="col-12">
                                        <app-upnext></app-upnext>
                                    </div>

                                </main>
                    
                    </div> 
    
            </div>
            
        </div>
    </div>

    <script>
        @yield('structured-data')
    </script>
</body>
</html>
