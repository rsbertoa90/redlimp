<div class="w-100 bg-danger nav white-bold p-2 mb-4 d-flex justify-content-around">
    <div class="nav-text">
        Administracion Redlimp
    </div>
   
   
    <div class="nav-text">
        <a href="/admin/cotizador">Cotizador</a>
    </div>
    <div class="nav-text">
        <a href="/admin/ordenes">Mis pedidos</a>
    </div>
    

     @if ($user->role_id == 1 )
      <div class="nav-text">
        <a href="/admin">Administrar productos</a>
      </div>

        <div class="nav-text">
            <a href="/super">Panel de Super Usuario</a>
        </div>
    @endif
    
    <div class="nav-text">
        <a href="/logout">Salir</a>
    </div>
</div>