
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
            <th style="width:60%">Estudiantes para observar</th>
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
            <th style="width:60%">Propuesta</th>
            <th style="width:30%">Postulados por ver</th>    
          </tr>
        </thead>
        <tbody>
          @foreach( $cantPostSinDecidirPorProp as $key => $propuesta )
            <tr>
              <td style="text-align: center;">{{$key + 1}}</td>
              <td>{{$propuesta->titulo}}</td>
              <td>{{$propuesta->postulados_sin_decidir}}</td>
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
    @if(count($propConMayorEstSinDecidir) > 0 )
      var array4 = [];
      @foreach( $propConMayorEstSinDecidir as $EstSinDecidir )
          array4.push({"y":{{$EstSinDecidir->postulados_sin_decidir}},"label":"{!!$EstSinDecidir->titulo!!}"});
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-1", {
        title: {
          text: "Propuestas con mayor cantidad de estudiantes para observar"
        },
        data: [{
          type: "column",
          dataPoints: array4
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