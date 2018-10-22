
    @extends('pdf.base')    
    
    @section('content')

    <main>
         <div style="width:100% ; text-align : center; margin-bottom: 20px">
            <img style="width: 120px" src="{{App\Config::base64('/storage/images/app/logo.png')}}" alt="Redlimp" />
        </div>

         @php
            $total = 0;
        @endphp
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Codigo</td>
                    <td>Producto</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $op)
                <tr>
                    <td> {{$op->product->code}} </td>
                    <td> {{$op->product->name}} </td>
                    <td> ${{$op->price}} </td>
                    <td> {{$op->qty}} </td>
                    <td> ${{$op->qty * $op->price}} </td>
                    @php
                        $total += ($op->qty * $op->price);
                    @endphp
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="color : blue">TOTAL</td>
                    <td style="color : blue"> ${{$total}} </td>
                    </tr>
            </tfoot>
        </table>
        <hr>
        <div>
            <p>
                Datos Adjuntos:
                <ul>
                    <li>Nombre: {{$order->client}} </li>
                    <li>Telefono: {{$order->phone}} </li>
                    <li>Email: {{$order->email}} </li>
                    <li>Mensaje: {{$order->message}} </li>
                </ul>
            </p>
            @if ($order->shipping)
                <p>
                   Datos de envio:
                   <ul>
                       @if ($order->City)    
                            <li> Provincia: {{$order->City->state->name}} </li> 
                            <li> Ciudad: {{$order->City->name}} </li> 
                       @endif
                        <li> CP: {{$order->cp}} </li> 
                        <li> direccion: {{$order->address}} </li> 
                        <li> transporte: {{$order->transport}} </li> 
                   </ul> 
                </p>
            @endif
        </div>
        
    </main>
    @endsection

    </body>
    </html>


   