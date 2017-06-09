
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
            <th style="width:20%; text-align: center;"> INFORME :</th>
            <th style="width:60%">Mi Estados en postulaciones realizadas</th>
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
            <th style="width:60%">Estados en postulaciones</th>
            <th style="width:30%">Cantidad</th>    
          </tr>
        </thead>
        <tbody>
          @foreach( $cantEstadosEnPostulaciones as $key => $estadoEnPostulacion )
            <tr>
              <td style="text-align: center;">{{$key + 1}}</td>
              <td>{{$estadoEnPostulacion->estado_postulacion}}</td>
              <td>{{$estadoEnPostulacion->cantidad}}</td>
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

    @if(count($cantEstadosEnPostulaciones) > 0 )
      var array2 = [];
      @foreach( $cantEstadosEnPostulaciones as $estado )
          array2.push({"y":{{$estado->cantidad}},"indexLabel":"{!!$estado->estado_postulacion!!}"});
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-1",
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
      var chart = new CanvasJS.Chart("chartContainer-1", {
          title: {
            text: "No hay datos."
          }
      });
      chart.render();
    @endif
  }

</script>
