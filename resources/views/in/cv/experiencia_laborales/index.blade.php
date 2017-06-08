@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Experiencia Laboral')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Listado de Experiencia Laborales</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')


<div class="row" style="margin-top:-20px">
  <!-- Box -->
  <div class="box no-box-shadow">
    <!-- Cuerpo del Box-->

    @include('template.partials.sidebar-gestionarcv')

    <div class="box-content dropbox">
      <h4 class="page-header">Listado de Experiencias Laborales
        @if(true)
          <a href="{{ route('in.gestionar-cv.experiencia-laborales.create') }}"  style="margin-top: -5px" class="btn btn-info pull-right btn-registrar-3">
            <span><i class="fa fa-plus"></i></span>
            Registrar Experiencia Laboral
          </a>
        @endif
      </h4>

      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Tabla -->
      <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="dev-table">
        <!-- columnas de la tabla -->
        <thead>
          <tr>
            <th>Empresa</th>
            <th>Rubro Empresarial</th>
            <th>Puesto</th>
            <th>Periodo</th>
            <th style="width:75px">Acción</th>
          </tr>
        </thead>
        <!-- contenido de la tabla -->
        <tbody>
          @foreach( $expLaborales as $expLaboral)
            <tr>
              <td>{{$expLaboral->nombre_empresa}}</td>
              <td>{{$expLaboral->rubroEmpresarial->nombre_rubro_empresarial}}</td>
              <td>{{$expLaboral->puesto}}</td>
              <td>
                <span>{{$expLaboral->periodo_inicio}}</span> -
                @if($expLaboral->periodo_fin == 0)
                  <span>Presente</span>
                @else
                  <span>{{$expLaboral->periodo_fin}}</span>
                @endif
              </td>
              <!-- envio el parametro del metodo edit y destroy-->
              <td>
                @if(true)
                  <a href="{{ route('in.gestionar-cv.experiencia-laborales.edit', $expLaboral->id) }}" class="btn btn-primary"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                @endif
                @if(true)
                  {!! Form::open(['route' => ['in.gestionar-cv.experiencia-laborales.destroy', $expLaboral->id], 'method' => 'DELETE', 'style' => "display: inline-block"]) !!}
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delSpk" data-title="Eliminar Experiencia Laboral"
                      data-message="¿Seguro que quiere eliminar la Experiencia Laboral de {{$expLaboral->puesto}} en {{$expLaboral->nombre_empresa}}?"><span class=" fa fa-trash-o" aria-hidden="true"></span></a>
                  {!! Form::close() !!}
                  @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
</div>

@endsection

@section('bodyJS')

  <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('plugins/datatables/ZeroClipboard.js')}}"></script>
  <script src="{{asset('plugins/datatables/TableTools.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>


  <script type="text/javascript">

    $(document).ready(function(){

      //Modal
      $('#delSpk').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
      });
      $('#delSpk').find('.modal-footer #confirm').on('click', function(){
        $(this).data('form').submit();
      });

      // Tabla
      $('#dev-table').dataTable( {
        "bStateSave": "false",
        "aaSorting": [[ 0, "asc" ]],
        "sDom": "<'pull-right'l>rt<'text-center'p>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     '<select><option value="5">5</option>'+
          '<option value="10">10</option>'+
          '<option value="25">25</option></select>',
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "",
          "sInfo":           "",
          "sInfoEmpty":      "",
          "sInfoFiltered":   "",
          "sInfoPostFix":    "",
          "sSearch":         "",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending":  "",
            "sSortDescending": ""
          }
        },
      });

      // Multiseletc para la tabla
      $('select').select2();
      $('.dataTables_filter').each(function(){
        $(this).find('label input[type=text]').attr('placeholder', 'Buscar');
      });
    });

  </script>

@endsection
