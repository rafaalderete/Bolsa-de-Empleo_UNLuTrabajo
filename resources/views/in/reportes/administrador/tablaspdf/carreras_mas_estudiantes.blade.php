
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
            <th style="width:60%">Carreras con más estudiantes</th>
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
            <th style="width:60%">Carrera</th>
            <th style="width:30%">Cantidad de estudiantes</th>    
          </tr>
        </thead>
        <tbody>
          @foreach( $cantidadEstudiantePorCarrera as $key => $carrera )
            <tr>
              <td style="text-align: center;">{{$key + 1}}</td>
              <td>{{$carrera->nombre_carrera}}</td>
              <td>{{$carrera->cantidad_estudiantes}}</td>
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
     @if(count($carrerasConMayorCantidadEstudiantes) > 0 )
      var array3 = [];
      @foreach( $carrerasConMayorCantidadEstudiantes as $carrera )
          array3.push({"y":{{$carrera->cantidad_estudiantes}},"label":"{!!$carrera->nombre_carrera!!}"});
      @endforeach

      var chart = new CanvasJS.Chart("chartContainer-1", {
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
      var chart = new CanvasJS.Chart("chartContainer-1", {
          title: {
            text: "No hay datos."
          }
      });
      chart.render();
    @endif
  }

</script>