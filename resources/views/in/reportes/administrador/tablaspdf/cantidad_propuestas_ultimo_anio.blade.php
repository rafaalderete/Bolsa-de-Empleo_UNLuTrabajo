
<!DOCTYPE html>
<html lang='en'>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Reportes</title>
      <link rel="stylesheet" href="{{asset('css/cv/cv-bootstrap.css')}}">
  </head>

  <body>
   
    <div>      
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th style="width:15%;text-align: center;"> INFORME :</th>
            <th style="width:60%">Cantidad de propuestas generadas en el último año</th>
            <th style="width:15%;text-align: center;">{{$today}}</th>
          </tr>
        </thead>
      </table>

      <div style="width:800px; margin:0 auto;">
        <div id="chartContainer-1" style="height: 350px;"></div>
      </div>
      
      <br>

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th style="width:10%; text-align: center;">#</th>
            <th style="width:60%">Mes</th>
            <th style="width:30%">Cantidad de propuestas</th>    
          </tr>
        </thead>
        <tbody>
          @foreach($reporteMes as $key => $reporte)
              <tr>
                <td style="text-align: center;">{{$key + 1}}</td>
                <td>{{$reporte['mes']}}</td>
                <td>{{$reporte['cantidad']}}</td>
              </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>

<script src="{{asset('plugins/canvas/canvasjs.min.js')}}"></script>

<script type="text/javascript">
  window.onload = function () {
    @if(count($cantidadPropuestaPorMes) > 0 )
      var array5 = [];
      @foreach( $cantidadPropuestaPorMes as $mes )
           array5.push({"label": "{!!$mes->mes!!} / {!!$mes->anio!!}","y":{{$mes->cantidad_propuesta}}});
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-1", {
        title: {
          text: "Cantidad de propuestas generadas en el último año"
        },
        data: [{
          type: "line",
          dataPoints: array5
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
  }

</script>