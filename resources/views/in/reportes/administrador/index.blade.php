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
          <div class="col-xs-6">
            <div class="box">
              <div class="box-header">
                <div class="box-name">
                  <span>Ranking de las 5 empresas con más propuestas</span>
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
                  <a href="{{ route('in.reportes.administrador.tablasonline.empresas-mas-propuestas') }}" style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
                    Tabla de Detalle
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="box">
              <div class="box-header">
                <div class="box-name">
                  <span>Ranking de las 5 empresas con más dias de inactividad</span>
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
                  <a href="{{ route('in.reportes.administrador.tablasonline.empresas-mas-dias-inactividad') }}" style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
                    Tabla de Detalle
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-6">
            <div class="box">
              <div class="box-header">
                <div class="box-name">
                  <span>Ranking de las 5 carreras con más estudiantes</span>
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
                  <a href="{{ route('in.reportes.administrador.tablasonline.carreras-mas-estudiantes') }}"  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
                    Tabla de Detalle
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="box">
              <div class="box-header">
                <div class="box-name">
                  <span>Cantidad de propuestas generadas en el último año</span>
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
                <div id="chartContainer-5" style="height: 300px;"></div>
                <div class="row">
                  <a href="{{ route('in.reportes.administrador.tablasonline.propuestas-ultimo-anio') }}" style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
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
                  <span>Ranking de los 10 rubros empresariales mas utilizados</span>
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
                <div id="chartContainer-4" style="height: 300px;"></div>
                <div class="row">
                  <a href="{{ route('in.reportes.administrador.tablasonline.empresas-rubro-empresarial') }}"  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
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
                <span>Cantidad de propuestas</span>
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

            {!! Form::open(['route' => ['in.reportes.administrador.tablasonline.cantidad-propuestas'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}

              <div class="box-content">
                <div class="row">
                  <div class="col-md-12 combo-cuadro">
                    <div class="row text-center">
                      <div class="col-md-4">
                        <span class="combo-cuadro-label">Filtro</span>
                      </div>
                      <div class="col-md-4">
                        <span class="combo-cuadro-label">Tiempo</span>
                      </div>
                      <div class="col-md-4">
                        <span class="combo-cuadro-label">Estado</span>
                      </div>
                    </div>
                    <div class="row combo-cuadro-contenido">
                      <div class="col-md-4">
                        <ul class="lista-radio">
                          <li>
                            <input type="radio" id="radiobtn_1" name="filtro" value="empresa" class="radiobtn" checked>
                            <span></span>
                            <label for="radiobtn_1">Empresas</label>
                          </li>
                          <li>
                            <input type="radio" id="radiobtn_2" name="filtro" value="carrera" class="radiobtn">
                            <span></span>
                            <label for="radiobtn_2">Carreras</label>
                          </li>
                          <li>
                            <input type="radio" id="radiobtn_3" name="filtro" value="idioma" class="radiobtn">
                            <span></span>
                            <label for="radiobtn_3">Idiomas</label>
                          </li>
                          <li>
                            <input type="radio" id="radiobtn_4" name="filtro" value="tipo_trabajo" class="radiobtn">
                            <span></span>
                            <label for="radiobtn_4">Tipos de Trabajo</label>
                          </li>
                          <li>
                            <input type="radio" id="radiobtn_5" name="filtro" value="tipo_jornada" class="radiobtn">
                            <span></span>
                            <label for="radiobtn_5">Tipos de Jornada</label>
                          </li>
                        </ul>
                      </div>
                      <div class="col-md-4 lista-radio-medio">
                        <ul class="lista-radio">
                          <li>
                            <input type="radio" id="radiobtn_6" name="tiempo" value="ultimo_mes" class="radiobtn" checked>
                            <span></span>
                            <label for="radiobtn_6">Último mes</label>
                          </li>
                          <li>
                            <input type="radio" id="radiobtn_7" name="tiempo" value="ultimos_6_meses" class="radiobtn">
                            <span></span>
                            <label for="radiobtn_7">Últimos 6 meses</label>
                          </li>
                          <li>
                            <input type="radio" id="radiobtn_8" name="tiempo" value="ultimo_anio" class="radiobtn">
                            <span></span>
                            <label for="radiobtn_8">Último año</label>
                          </li>
                          <li>
                            <input type="radio" id="radiobtn_9" name="tiempo" value="sin_limite" class="radiobtn">
                            <span></span>
                            <label for="radiobtn_9">Sin límite</label>
                          </li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        <ul class="lista-radio">
                          <li>
                            <input type="radio" id="radiobtn_10" name="estado" value="vigente" class="radiobtn" checked>
                            <span></span>
                            <label for="radiobtn_10">Vigente</label>
                          </li>
                          <li>
                            <input type="radio" id="radiobtn_11" name="estado" value="todas" class="radiobtn">
                            <span></span>
                            <label for="radiobtn_11">Todas</label>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <input type="button" name="calcular" value="Calcular" id="calcular" style="margin-top: 5px; margin-left:20px" class="btn btn-info pull-left">
                </div>
                <div class="row">
                  <div id="chartContainer-6" style="height: 300px; width: 100%;"></div>
                  <div class="row">
                    <button type="submit" class="btn btn-info pull-right" style="margin-top: 5px; margin-right: 30px">
                      Tabla de Detalle
                    </button>
                  </div>
                </div>
              </div>

            {!! Form::close()!!}

          </div>
        </div>
      </div>

    </div>
  </div>

@endsection

@section('bodyJS')

<script type="text/javascript">
  window.onload = function () {

    $('#calcular').click(function() {
      var url = '../getDatosReporteEstadisticaAdministrador';
      var data = {
        "filtro": $('input[name=filtro]:checked').val(),
        "tiempo": $('input[name=tiempo]:checked').val(),
        "estado": $('input[name=estado]:checked').val()
      }
      $.get (url,data,function (result) {
        var array6 = [];
        console.log(result.cantidadPropuestas);
        console.log(result.filtro);
        console.log(result.tiempo);
        console.log(result.estado);
        for (var i = 0; i < result.cantidadPropuestas.length; i++){
            array6.push({y: result.cantidadPropuestas[i].cantidad_propuestas, label: result.cantidadPropuestas[i].filtro});
        }

        var chart = new CanvasJS.Chart("chartContainer-6",
          {
            title:{
              text: "Filtro por Mayores Propuestas"
            },
            data: [
            {
              type: "bar",
              dataPoints: array6
            }
            ]
          });

          chart.render();
      })

    });

    @if(count($EmpresasConMasPropuestas) > 0 )
      var array1 = [];
      @foreach( $EmpresasConMasPropuestas as $propuestaPorEmpresa )
          array1.push({"y":{{$propuestaPorEmpresa->cantidad_propuestas}},"label":"{!!$propuestaPorEmpresa->nombre_comercial!!}"});
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-1", {
        title: {
          text: "Empresas con más propuestas"
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

    @if(count($EmpresasMasInactivas) > 0 )
      var array2 = [];
      @foreach( $EmpresasMasInactivas as $empresa )
          array2.push({"y":{{$empresa->dias_inactivo}},"label":"{!!$empresa->nombre_comercial!!}"});
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-2", {
        title: {
          text: "Empresas con más dias de inactividad"
        },
        data: [{
          type: "column",
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

    @if(count($carrerasConMayorCantidadEstudiantes) > 0 )
      var array3 = [];
      @foreach( $carrerasConMayorCantidadEstudiantes as $carrera )
          array3.push({"y":{{$carrera->cantidad_estudiantes}},"label":"{!!$carrera->nombre_carrera!!}"});
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-3", {
        title: {
          text: "Carreras con más estudiantes"
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

    @if(count($rubrosConMayorCantidadEmpresas) > 0 )
      var array4 = [];
      @foreach( $rubrosConMayorCantidadEmpresas as $rubro )
          array4.push({"y":{{$rubro->cantidad_empresas}},"label":"{!!$rubro->nombre_rubro_empresarial!!}"});
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-4", {
        title: {
          text: "Cantidad de empresas por rubro empresarial."
        },
        data: [{
          type: "column",
          dataPoints: array4
        }]
      });
      chart.render();
    @else
      var chart = new CanvasJS.Chart("chartContainer-4", {
          title: {
            text: "No hay datos."
          }
      });
      chart.render();
    @endif

    @if(count($cantidadPropuestaPorMes) > 0 )
      var array5 = [];
      @foreach( $cantidadPropuestaPorMes as $mes )
           array5.push({"x": new Date("{!!$mes->anio!!}-{!!$mes->mes!!}-01"),"y":{{$mes->cantidad_propuesta}}});
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-5", {
        title:{
          text: "Cantidad de propuestas generadas en el último año"
        },
        axisX: {
          valueFormatString: "MMM",
          interval:1,
          intervalType: "month"
        },
        axisY:{
          includeZero: false
        },
        data: [
        {
          type: "line",
          //lineThickness: 3,
          dataPoints: array5
        }
        ]
      });
      chart.render();
    @else
      var chart = new CanvasJS.Chart("chartContainer-5", {
          title: {
            text: "No hay datos."
          }
      });
      chart.render();
    @endif

    @if(count($cantidadPropuestas) > 0 )
      var array6 = [];
      @foreach( $cantidadPropuestas as $propuesta )
           array6.push({y: {{$propuesta->cantidad_propuestas}}, label:"{!!$propuesta->nombre_comercial!!}" });
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-6", {
        title:{
          text: "Filtro por mayores propuestas"
        },
        data: [
        {
          type: "bar",
          dataPoints: array6
        }
        ]
      });
      chart.render();
    @else
      var chart = new CanvasJS.Chart("chartContainer-6", {
          title: {
            text: "No hay datos."
          }
      });
      chart.render();
    @endif

  }

</script>


@endsection
