@extends('template.main')

@section('headTitle', 'Inicio')

@section('headContent')

    <meta name="description" content="description">
    <meta name="author" content="DevOOPS">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('http://fonts.googleapis.com/css?family=Righteous')}}" >
    <link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar/fullcalendar.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/xcharts/xcharts.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

@endsection

@section('bodyHeader')

    @include('template.partials.header')

@endsection

@section('bodySidebar')

    @include('template.partials.sidebar')

@endsection

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
            @if (session('status'))
               <p class="alert alert-success">{{ session('status') }}</p>
            @endif
            <!-- contenido ejemplo-->
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

@section('bodyJS')

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="http://code.jquery.com/jquery.js"></script>-->
    <script src="{{asset('plugins/jquery/jquery.js')}}"></script>
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/justified-gallery/jquery.justifiedgallery.min.js')}}"></script>
    <script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('plugins/tinymce/jquery.tinymce.min.js')}}"></script>
    <!-- All functions for this theme + document.ready processing -->
    <script src="{{asset('js/devoops.min.js')}}"></script>

@endsection
