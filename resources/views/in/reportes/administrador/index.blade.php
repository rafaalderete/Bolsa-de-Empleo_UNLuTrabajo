@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Estados de Carrera | Registrar Estado de Carrera')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Estados de Carreras</a></li>
        <li><a>Registrar Estado de Carrera</a></li>
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
        <h4 class="page-header">Registro de Estado de Carrera</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="box">
              <div class="box-header">
                <div class="box-name">
                  <i class="fa fa-search"></i>
                  <span>Plot with points</span>
                </div>
                <div class="box-icons">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="expand-link">
                    <i class="fa fa-expand"></i>
                  </a>
                  <a class="close-link">
                    <i class="fa fa-times"></i>
                  </a>
                </div>
                <div class="no-move"></div>
              </div>
              <div class="box-content">
                <div id="chartContainer-1" style="height: 300px;"></div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="box">
              <div class="box-header">
                <div class="box-name">
                  <i class="fa fa-search"></i>
                  <span>Company cost (billions of dollars)</span>
                </div>
                <div class="box-icons">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="expand-link">
                    <i class="fa fa-expand"></i>
                  </a>
                  <a class="close-link">
                    <i class="fa fa-times"></i>
                  </a>
                </div>
                <div class="no-move"></div>
              </div>
              <div class="box-content">
                <div id="chartContainer-3" style="height: 300px;"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="box-name">
                  <i class="fa fa-search"></i>
                  <span>Thresholds</span>
                </div>
                <div class="box-icons">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="expand-link">
                    <i class="fa fa-expand"></i>
                  </a>
                  <a class="close-link">
                    <i class="fa fa-times"></i>
                  </a>
                </div>
                <div class="no-move"></div>
              </div>
              <div class="box-content">
                <div id="chartContainer-2" style="height: 300px;"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="box-name">
                  <i class="fa fa-search"></i>
                  <span>Thresholds</span>
                </div>
                <div class="box-icons">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="expand-link">
                    <i class="fa fa-expand"></i>
                  </a>
                  <a class="close-link">
                    <i class="fa fa-times"></i>
                  </a>
                </div>
                <div class="no-move"></div>
              </div>
              <div class="box-content">
                <div id="chartContainer-5" style="height: 300px; width: 100%;"></div>
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
    var chart = new CanvasJS.Chart("chartContainer-1",
    {
      theme: "theme2",
      title:{
        text: "Gaming Consoles Sold in 2012"
      },
      data: [
      {
        type: "pie",
        showInLegend: true,
        toolTipContent: "{y} - #percent %",
        yValueFormatString: "#0.#,,. Million",
        legendText: "{indexLabel}",
        dataPoints: [
          {  y: 4181563, indexLabel: "PlayStation 3" },
          {  y: 2175498, indexLabel: "Wii" },
          {  y: 3125844, indexLabel: "Xbox 360" },
          {  y: 1176121, indexLabel: "Nintendo DS"},
          {  y: 1727161, indexLabel: "PSP" },
          {  y: 4303364, indexLabel: "Nintendo 3DS"},
          {  y: 1717786, indexLabel: "PS Vita"}
        ]
      }
      ]
    });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer-2", {
        title: {
          text: "Empresas con mayor cantidad de propuestas"
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
          text: "Coal Reserves of Countries"
        },
        axisY: {
          title: "Coal (bn tonnes)",
          valueFormatString: "#0.#,.",
        },
        data: [{
          type: "stackedColumn",
          legendText: "Anthracite & Bituminous",
          showInLegend: "true",
          dataPoints: [
            { y: 111338, label: "USA" },
            { y: 49088, label: "Russia" },
            { y: 62200, label: "China" },
            { y: 90085, label: "India" },
            { y: 38600, label: "Australia" },
          ]
        }, {
          type: "stackedColumn",
          legendText: "SubBituminous & Lignite",
          showInLegend: "true",
          indexLabel: "#total bn",
          yValueFormatString: "#0.#,.",
          indexLabelPlacement: "outside",
          dataPoints: [
            { y: 135305, label: "USA" },
            { y: 107922, label: "Russia" },
            { y: 52300, label: "China" },
            { y: 3360, label: "India" },
            { y: 39900, label: "Australia" },
            { y: 3680, label: "Germany" },
          ]
        }
        ]
      });
      chart.render();

    var chart = new CanvasJS.Chart("chartContainer-5",
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
