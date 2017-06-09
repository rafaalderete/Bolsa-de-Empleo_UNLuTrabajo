@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Reportes')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Reportes</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')

  <div class="row" style="margin-top:-20px">
    <!-- Box -->
    <div class="box">
      <!-- Cuerpo del Box-->
      <div class="box-content dropbox">
        <h4 class="page-header">Reportes</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <div class="row">
          <div class="col-xs-8">
              <div class="box">
                <div class="box-header">
                  <div class="box-name">
                    <span>Ranking de los 5 idiomas más solicitados para mi carrera</span>
                  </div>
                  <div class="box-icons">
                    <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                      <i class="fa fa-times"></i>
                    </a>
                  </div>
                  <div class="no-move"></div>
                </div>
                <div class="box-content">
                  <div id="chartContainer-1" style="height: 300px;"></div>
                  <div class="row">
                    @if(count($idiomasMayorCantidadEnMiCarrera) > 0 )
                      <a href="{{ route('in.reportes.estudiante.tablasonline.idiomas-solicitados') }}"  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
                        Tabla de Detalle
                      </a>
                    @endif
                  </div>
                </div>
              </div>
          </div>

          <div class="col-xs-4">
              <div class="box">
                <div class="box-header">
                  <div class="box-name">
                    <span>Mi estados en postulaciones realizadas</span>
                  </div>
                  <div class="box-icons">
                    <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                      <i class="fa fa-times"></i>
                    </a>
                  </div>
                  <div class="no-move"></div>
                </div>
                <div class="box-content">
                  <div id="chartContainer-2" style="height: 300px;"></div>
                  <div class="row">
                    <a href="{{ route('in.reportes.estudiante.tablasonline.estados-postulaciones') }}"  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
                      Tabla de Detalle
                    </a>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <div class="box-name">
                    <span>Ranking de las 10 empresas con más propuestas para mi carrera</span>
                  </div>
                  <div class="box-icons">
                    <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                      <i class="fa fa-times"></i>
                    </a>
                  </div>
                  <div class="no-move"></div>
                </div>
                <div class="box-content">
                  <div id="chartContainer-3" style="height: 300px;"></div>
                  <div class="row">
                    <a href="{{ route('in.reportes.estudiante.tablasonline.empresas-propuestas-mi-carrera') }}"  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
                      Tabla de Detalle
                    </a>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

<script type="text/javascript">
  window.onload = function () {

    var array1 = [];
      
    @foreach( $idiomasMayorCantidadEnMiCarrera as $idioma )
        array1.push({"y":{{$idioma->cantidad}},"label":"{!!$idioma->nombre_idioma!!}"});
    @endforeach

    @if(count($idiomasMayorCantidadEnMiCarrera) > 0 )
      var chart = new CanvasJS.Chart("chartContainer-1", {
          title: {
            text: "Idiomas más solicitados para mi carrera"
          },
          data: [{
            type: "column",
            dataPoints: array1
          }]
      });
      chart.render();
    @else
      var chart = new CanvasJS.Chart("chartContainer-1", {
          title: {
            text: "No hay datos."
          }
      });
      chart.render();
    @endif


    @if(count($cantEstadosEnPostulaciones) > 0 )
      var array2 = [];
      @foreach( $cantEstadosEnPostulaciones as $estado )
          array2.push({"y":{{$estado->cantidad}},"indexLabel":"{!!$estado->estado_postulacion!!}"});
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-2",
    	{
    		title:{
    			text: "Mi estados en postulaciones realizadas"
    		},
    		data: [{
    			type: "pie",
    			showInLegend: true,
          toolTipContent: "{y} postulaciones ( #percent % )",
          yValueFormatString: "#",
          legendText: "{indexLabel}",
    			dataPoints: array2
    		}]
    	});
    	chart.render();
    @else
      var chart = new CanvasJS.Chart("chartContainer-2", {
          title: {
            text: "No hay datos."
          }
      });
      chart.render();
    @endif

    @if(count($EmpConMayorPropParaMiCarrera) > 0 )
        var array3 = [];

        @foreach( $EmpConMayorPropParaMiCarrera as $empresa )
             array3.push({y: {{$empresa->cantidad}}, label:"{!!$empresa->nombre_comercial!!}" });
        @endforeach

        var chart = new CanvasJS.Chart("chartContainer-3", {
    				title: {
    					text: "Empresas con más propuestas para mi carrera"
    				},
    				data: [{
    					type: "column",
    					dataPoints: array3
    				}]
    		});
    		chart.render();
    @else
      var chart = new CanvasJS.Chart("chartContainer-3", {
          title: {
            text: "No hay datos."
          }
      });
      chart.render();
    @endif
  }

</script>


@endsection
