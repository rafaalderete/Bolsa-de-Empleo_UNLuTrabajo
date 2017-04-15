@extends('template.in_main')

@section('headTitle', 'Inicio')

@section('bodyIndice')

    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <ol class="breadcrumb">
                <li><a>Inicio</a></li>
            </ol>
        </div>
    </div>

@endsection

@section('bodyContent')

<div class="row">
    <!-- Box -->
    <div class="box" style="margin-top: -20px">
        <!-- Cuerpo del Box-->
        <div class="box-content dropbox">
            <!-- Titulo del Cuerpo del Box -->
            <h4 class="page-header">Panel de Administracion</h4>
            @include('flash::message')
            @include('template.partials.errors')
            <!-- contenido ejemplo-->
            @if(Entrust::hasRole('postulante'))
              <div id="search">
                <input type="text" placeholder="Buscar"/>
                <i class="fa fa-search"></i>
              </div>
            @endif
              <div class="anuncio col-md-12">
                <div class="empresa_logo col-md-2 text-center">
                  <img src="{{asset('img/empresa_logo.jpg')}}" class="img-rounded" alt="empresa_logo" />
                </div>
                <div class="descripcion col-md-10">
                  <div class="row">
                    <div class="col-md-12">
                      <h2>Titulo Oferta</h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="detalle col-md-12">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ull...</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <p>Fecha</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="anuncio col-md-12">
              <div class="empresa_logo col-md-2 text-center">
                <img src="{{asset('img/empresa_logo.jpg')}}" class="img-rounded" alt="empresa_logo" />
              </div>
              <div class="descripcion col-md-10">
                <div class="row">
                  <div class="col-md-12">
                    <h2>Titulo Oferta</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="detalle col-md-12">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore
                      magna aliqua. Ut enim ad minim veniam, quis nostrud
                      exercitation ull...</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <p>Fecha</p>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>
</div>

@endsection
