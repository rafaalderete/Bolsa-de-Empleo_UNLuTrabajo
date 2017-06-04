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
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="box-name">
                  <span>Ranking de las 5 Empresas con más Actividad</span>
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
                  <a href=""  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
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
                  <span>Ranking de las 5 Empresas con más Tiempo de Inactividad</span>
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
                  <a href=""  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
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
                  <span>Ranking de las 5 Carreras con más Estudiantes</span>
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
                  <a href=""  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
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
                  <span>Cantidad de Empresas por rubro empresarial</span>
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
                  <a href=""  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
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
                  <span>Cantidad de Propuestas generadas el último año</span>
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
                <div id="chartContainer-5" style="height: 300px; width: 100%;">
                <div class="row">
                  <a href=""  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
                    Tabla de Detalle
                  </a>
                </div>
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
                <span>Cantidad de Propuestas generadas el último año</span>
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
              <div class="row">
                <div class="col-md-12 combo-cuadro">
                  <div class="row text-center">
                    <div class="col-md-2">
                      <span class="combo-cuadro-label">Filtro</span>
                    </div>
                    <div class="col-md-2">
                      <span class="combo-cuadro-label">Tiempo</span>
                    </div>
                    <div class="col-md-2">
                      <span class="combo-cuadro-label">Estado</span>
                    </div>
                  </div>
                  <div class="row combo-cuadro-contenido">
                    <div class="col-md-2">
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
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                      <ul class="lista-radio">
                        <li>
                          <input type="radio" id="radiobtn_10" name="estado" value="vigente" class="radiobtn" checked>
                          <span></span>
                          <label for="radiobtn_9">Vigente</label>
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
                  <a href=""  style="margin-top: 5px; margin-right: 30px" class="btn btn-info pull-right">
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

    $('#calcular').click(function() {
      var url = '../getDatosReporteEstadisticaAdministrador';
      var data = {
        "filtro": $('input[name=filtro]:checked').val(),
        "tiempo": $('input[name=tiempo]:checked').val(),
        "estado": $('input[name=estado]:checked').val()
      }

      $.get (url,data,function (result) {
        var chart = new CanvasJS.Chart("chartContainer-6",
          {
            title:{
              text: "Bar chart"
            },
            data: [
            {
              type: "bar",
              dataPoints: [
              { x: 10, y: 90, label:"Apple" },
              { x: 20, y: 70, label:"Mango" },
              { x: 30, y: 50, label:"Orange" },
              { x: 40, y: 60, label:"Banana" },
              { x: 50, y: 20, label:"Pineapple" },
              { x: 60, y: 30, label:"Pears" },
              { x: 70, y: 35, label:"Grapes" },
              { x: 80, y: 40, label:"Lychee" },
              { x: 90, y: 30, label:"Jackfruit" }
              ]
            }
            ]
          });

          chart.render();
      })

    });

    var chart = new CanvasJS.Chart("chartContainer-1", {
        title: {
          text: "Empresas con más Actividad"
        },
        data: [{
          type: "column",
          dataPoints: [
            { y: 150, label: "Arcor" },
            { y: 125, label: "BBVA" },
            { y: 115, label: "Quilmes" },
            { y: 110, label: "Brahma" },
            { y: 100, label: "besysoft" },
            { y: 99, label: "UNLu" },
          ]
        }]
      });
      chart.render();

    var chart = new CanvasJS.Chart("chartContainer-2", {
        title: {
          text: "Empresas con más Tiempo de Inactividad"
        },
        data: [{
          type: "column",
          dataPoints: [
            { y: 150, label: "Arcor" },
            { y: 125, label: "BBVA" },
            { y: 115, label: "Quilmes" },
            { y: 110, label: "Brahma" },
            { y: 100, label: "besysoft" },
            { y: 99, label: "UNLu" },
          ]
        }]
      });
      chart.render();

    var chart = new CanvasJS.Chart("chartContainer-3", {
        title: {
          text: "Carreras con más Estudiantes"
        },
        data: [{
          type: "column",
          dataPoints: [
            { y: 150, label: "Arcor" },
            { y: 125, label: "BBVA" },
            { y: 115, label: "Quilmes" },
            { y: 110, label: "Brahma" },
            { y: 100, label: "besysoft" },
            { y: 99, label: "UNLu" },
          ]
        }]
      });
      chart.render();

    var chart = new CanvasJS.Chart("chartContainer-4", {
        title: {
          text: "Cantidad de Empresas por rubro empresarial."
        },
        data: [{
          type: "column",
          dataPoints: [
            { y: 150, label: "Arcor" },
            { y: 125, label: "BBVA" },
            { y: 115, label: "Quilmes" },
            { y: 110, label: "Brahma" },
            { y: 100, label: "besysoft" },
            { y: 99, label: "UNLu" },
          ]
        }]
      });
      chart.render();

    var chart = new CanvasJS.Chart("chartContainer-5", {
      title:{
        text: "Cantidad de Propuestas generadas el último año"
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
        dataPoints: [
        { x: new Date(2012, 00, 1), y: 450 },
        { x: new Date(2012, 01, 1), y: 414},
        { x: new Date(2012, 02, 1), y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle"},
        { x: new Date(2012, 03, 1), y: 460 },
        { x: new Date(2012, 04, 1), y: 450 },
        { x: new Date(2012, 05, 1), y: 500 },
        { x: new Date(2012, 06, 1), y: 480 },
        { x: new Date(2012, 07, 1), y: 480 },
        { x: new Date(2012, 08, 1), y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross"},
        { x: new Date(2012, 09, 1), y: 500 },
        { x: new Date(2012, 10, 1), y: 480 },
        { x: new Date(2012, 11, 1), y: 510 }
        ]
      }
      ]
    });

    chart.render();

    var chart = new CanvasJS.Chart("chartContainer-6",
      {
        title:{
          text: "Bar chart"
        },
        data: [
        {
          type: "bar",
          dataPoints: [
          { x: 10, y: 90, label:"Apple" },
          { x: 20, y: 70, label:"Mango" },
          { x: 30, y: 50, label:"Orange" },
          { x: 40, y: 60, label:"Banana" },
          { x: 50, y: 20, label:"Pineapple" },
          { x: 60, y: 30, label:"Pears" },
          { x: 70, y: 35, label:"Grapes" },
          { x: 80, y: 40, label:"Lychee" },
          { x: 90, y: 30, label:"Jackfruit" }
          ]
        }
        ]
      });

      chart.render();
  }

</script>


@endsection
