<div id="sidebar-left" class="col-xs-2 col-sm-2">
  <ul class="nav main-menu">
    <li>
      <a href="{{route('in.index')}}">
        <i class="fa fa-home"></i>
        <span class="hidden-xs">Inicio</span>
      </a>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle">
        <i class="fa fa-chevron-right"></i>
        <span class="hidden-xs">Personas</span>
      </a>
      <ul class="dropdown-menu">
        <li><a href="{{route('in.personas.index')}}">Tabla de Personas</a></li>
        <li><a href="{{route('in.personas.create')}}">Registrar Persona</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle">
        <i class="fa fa-chevron-right"></i>
        <span class="hidden-xs">Usuarios</span>
      </a>
      <ul class="dropdown-menu">
        <li><a href="{{route('in.usuarios.index')}}">Tabla de Usuarios</a></li>
        <li><a href="{{route('in.usuarios.create')}}">Registrar Usuario</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle">
        <i class="fa fa-chevron-right"></i>
        <span class="hidden-xs">Roles</span>
      </a>
      <ul class="dropdown-menu">
        <li><a href="{{route('in.roles.index')}}">Tabla de Roles</a></li>
        <li><a href="{{route('in.roles.create')}}">Registrar Rol</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle">
        <i class="fa fa-chevron-right"></i>
        <span class="hidden-xs">Permisos</span>
      </a>
      <ul class="dropdown-menu">
        <li><a href="{{route('in.permisos.index')}}">Tabla de Permisos</a></li>
        <li><a href="{{route('in.permisos.create')}}">Registrar Permiso</a></li>
      </ul>
    </li>
  </ul>
</div>
