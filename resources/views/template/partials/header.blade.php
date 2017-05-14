<div id="screensaver">
  <canvas id="canvas"></canvas>
  <i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
  <div class="devoops-modal">
    <div class="devoops-modal-header">
      <div class="modal-header-name">
        <span>Basic table</span>
      </div>
      <div class="box-icons">
        <a class="close-link">
          <i class="fa fa-times"></i>
        </a>
      </div>
    </div>
    <div class="devoops-modal-inner">
    </div>
    <div class="devoops-modal-bottom">
    </div>
  </div>
</div>
<header class="navbar">
  <div class="container-fluid expanded-panel">
    <div class="row">
      <div id="logo" class="col-xs-12 col-sm-2">
        @if (Entrust::hasRole('super_usuario') || Entrust::hasRole('administrador'))
          <a href={{ route('in.registro-empleador') }}>UNLu Trabajo</a>
        @else
          @if (Entrust::hasRole('empleador'))
            <a href={{ route('in.propuestas-laborales.index') }}>UNLu Trabajo</a>
          @else
            <a href={{ route('in.buscar-ofertas') }}>UNLu Trabajo</a>
          @endif
        @endif
      </div>
      <div id="top-panel" class="col-xs-12 col-sm-10">
        <div class="row">
          <div class="col-xs-8 col-sm-8">
            @if(Entrust::hasRole('super_usuario') || Entrust::hasRole('administrador') )
              <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
              </a>
            @endif
            <div class="top-menu">
              <ul>
                @if(Entrust::hasRole('super_usuario') || Entrust::hasRole('administrador') )
                  <li class="col-xs-5 col-sm-4 opcion" title="Registrar Empleador"><a href={{ route('in.registro-empleador') }}><i class="fa fa-building-o"></i><span>Registrar Empleador</span></a></li>
                @endif
                @if(Entrust::hasRole('postulante') )
                  <li class="col-xs-4 col-sm-4 opcion" title="Buscar Ofertas"><a href={{ route('in.buscar-ofertas') }}><i class="fa fa-suitcase"></i><span>Buscar Ofertas</span></a></li>
                  <li class="col-xs-4 col-sm-4 opcion" title="Mi Cv"><a href={{ route('in.cv.datospersonalescv') }}><i class="fa fa-file-text-o"></i><span>Mi Cv</span></a></li>
                  <li class="col-xs-4 col-sm-4 opcion" title="Mis Postulaciones"><a href={{ route('in.mis-postulaciones') }}><i class="fa fa-tasks"></i><span>Mis Postulaciones</span></a></li>
                @endif
                @if(Entrust::hasRole('empleador') )
                  <li class="col-xs-5 col-sm-4 opcion" title="Realizar Propuesta"><a href={{ route('in.propuestas-laborales.create') }}><i class="fa fa-suitcase"></i><span>Realizar Propuesta</span></a></li>
                  <li class="col-xs-5 col-sm-4 opcion" title="Mis Propuestas"><a href={{ route('in.propuestas-laborales.index') }}><i class="fa fa-tasks"></i><span>Mis Propuestas</span></a></li>
                @endif
              </ul>
            </div>
          </div>
          <div class="col-xs-4 col-sm-4 top-panel-right">
            <ul class="nav navbar-nav pull-right panel-menu">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle account" data-toggle="dropdown">
                  @if(Auth::user()->imagen != null)
                    <div class="avatar">
                      <img src="{{asset('img/usuarios').'/'.Auth::user()->imagen}}" class="img-rounded" alt="avatar" />
                    </div>
                  @else
                    <div class="avatar">
                      <img src="{{asset('/img/fotoPerfil.jpg')}}" class="img-rounded" alt="avatar" />
                    </div>
                  @endif
                  <i class="fa fa-angle-down pull-right"></i>
                  <div class="user-mini pull-right">
                    <span class="welcome">Bienvenido,</span>
                    <span>{{ Auth::user()->nombre_usuario }}</span>
                  </div>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href={{ route('in.configurar-datos') }}>
                      @if (Auth::user()->persona->tipo_persona == 'fisica')
                        <i class="fa fa-user"></i>
                        <span class="text">Datos Personales</span>
                      @else
                        <i class="fa fa-building-o"></i>
                        <span class="text">Datos de la Empresa</span>
                      @endif
                    </a>
                  </li>
                  <li>
                    <a href={{ route('in.configurar-cuenta-email') }}>
                      <i class="fa fa-cog"></i>
                      <span class="text">Configurar Cuenta</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{route('auth.logout')}}">
                      <i class="fa fa-power-off"></i>
                      <span class="text">Logout</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
