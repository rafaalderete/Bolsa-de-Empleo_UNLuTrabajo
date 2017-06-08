<div id="sidebar-configuracion" class="col-xs-3 col-sm-3">
  <ul class="nav main-menu">
    <li>
      <a href="{{route('in.configurar-cuenta-email')}}">
        <i class="fa fa-envelope"></i>
        <span class="hidden-xs">Cambiar E-mail</span>
      </a>
    </li>
    <li>
      <a href="{{route('in.configurar-cuenta-password')}}">
        <i class="fa fa-key"></i>
        <span class="hidden-xs">Cambiar Contraseña</span>
      </a>
    </li>
    @if (Auth::user()->hasRole('empleador'))
      <li>
        <a href="{{route('in.configurar-cuenta-recibir-email')}}">
          <i class="fa fa-cog"></i>
          <span class="hidden-xs">Recibir E-mail</span>
        </a>
      </li>
    @endif
  </ul>
</div>
