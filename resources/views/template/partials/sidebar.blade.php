<div id="sidebar-left" class="col-xs-2 col-sm-2">
  <ul class="nav main-menu">
    <li>
      <a href="{{route('in.registro-empleador')}}">
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

    @if(Entrust::can('listar_empresas'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Empresas</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.empresas.index')}}">Tabla de Empresas</a></li>
          @if(Entrust::can('crear_empresa'))
            <li><a href="{{route('in.empresas.create')}}">Registrar Empresa</a></li>
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

    @if(Entrust::can('listar_rubros_empresariales'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Rubros Empresariales</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.rubros-empresariales.index')}}">Tabla de Rubros Empresariales</a></li>
          @if(Entrust::can('crear_rubro_empresarial'))
            <li><a href="{{route('in.rubros-empresariales.create')}}">Registrar Rubro Empresarial</a></li>
          @endif
        </ul>
      </li>
    @endif

  </ul>
</div>
