<div id="sidebar-left" class="col-xs-2 col-sm-2">
  <ul class="nav main-menu">
    <li>
      <a href="{{route('in.index')}}">
        <i class="fa fa-home"></i>
        <span class="hidden-xs">Inicio</span>
      </a>
    </li>

    @if(Entrust::can('listar_personas'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Personas</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.personas.index')}}">Tabla de Personas</a></li>
          @if(Entrust::can('crear_persona'))
            <li><a href="{{route('in.personas.create')}}">Registrar Persona</a></li>
          @endif
        </ul>
      </li>
    @endif
    
    @if(Entrust::can('listar_usuarios'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Usuarios</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.usuarios.index')}}">Tabla de Usuarios</a></li>
          @if(Entrust::can('crear_usuario'))
            <li><a href="{{route('in.usuarios.create')}}">Registrar Usuario</a></li>
          @endif
        </ul>
      </li>
    @endif
    
    @if(Entrust::can('listar_roles'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Roles</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.roles.index')}}">Tabla de Roles</a></li>
          @if(Entrust::can('crear_rol'))
            <li><a href="{{route('in.roles.create')}}">Registrar Rol</a></li>
          @endif
        </ul>
      </li>
    @endif

    @if(Entrust::can('listar_permisos'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Permisos</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.permisos.index')}}">Tabla de Permisos</a></li>
          @if(Entrust::can('crear_permiso'))
            <li><a href="{{route('in.permisos.create')}}">Registrar Permiso</a></li>
          @endif
        </ul>
      </li>
    @endif
  </ul>
</div>
