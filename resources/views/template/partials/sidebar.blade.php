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
  
    @if(Entrust::can('listar_idiomas'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Idiomas</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.idiomas.index')}}">Tabla de Idioma</a></li>
          @if(Entrust::can('crear_idioma'))
            <li><a href="{{route('in.idiomas.create')}}">Registrar Idioma</a></li>
          @endif
        </ul>
      </li>
    @endif

    @if(Entrust::can('listar_tipos_software'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Tipo Software</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.tipo_software.index')}}">Tabla de Tipo Software</a></li>
          @if(Entrust::can('crear_tipo_software'))
            <li><a href="{{route('in.tipo_software.create')}}">Registrar Tipo Software</a></li>
          @endif
        </ul>
      </li>
    @endif

    <!-- ESTA MIERDA NO SE MUESTRA :@ -->
     @if(Entrust::can('listar_estados_carrera'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Estado Carrera</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.estado_carrera.index')}}">Tabla de Estado Carrera</a></li>
          @if(Entrust::can('crear_estado_carrera'))
            <li><a href="{{route('in.estado_carrera.create')}}">Registrar Estado Carrera</a></li>
          @endif
        </ul>
      </li>
    @endif

     @if(Entrust::can('listar_tipos_jornada'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Tipo Jornada</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.tipo_jornada.index')}}">Tabla de Tipo Jornada</a></li>
          @if(Entrust::can('crear_tipo_jornada'))
            <li><a href="{{route('in.tipo_jornada.create')}}">Registrar Tipo Jornada</a></li>
          @endif
        </ul>
      </li>
    @endif

   @if(Entrust::can('listar_tipos_trabajo'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Tipo Trabajo</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.tipo_trabajo.index')}}">Tabla de Tipo Trabajo</a></li>
          @if(Entrust::can('crear_tipo_trabajo'))
            <li><a href="{{route('in.tipo_trabajo.create')}}">Registrar Tipo Trabajo</a></li>
          @endif
        </ul>
      </li>
    @endif


   @if(Entrust::can('listar_niveles_conocimiento'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Nivel Conocimiento</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.nivel_conocimiento.index')}}">Tabla de Nivel Conocimiento</a></li>
          @if(Entrust::can('crear_nivel_conocimiento'))
            <li><a href="{{route('in.nivel_conocimiento.create')}}">Registrar Nivel Conocimiento</a></li>
          @endif
        </ul>
      </li>
    @endif
    
     @if(Entrust::can('listar_niveles_educativos'))
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">
          <i class="fa fa-chevron-right"></i>
          <span class="hidden-xs">Nivel Educativo</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{route('in.nivel_educativo.index')}}">Tabla de Nivel Educativo</a></li>
          @if(Entrust::can('crear_nivel_conocimiento'))
            <li><a href="{{route('in.nivel_educativo.create')}}">Registrar Nivel Educativo</a></li>
          @endif
        </ul>
      </li>
    @endif
    </ul>


</div>

