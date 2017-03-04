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
            <!-- contenido-->
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
