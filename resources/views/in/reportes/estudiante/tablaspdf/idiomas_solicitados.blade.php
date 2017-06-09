
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
            <th style="width:60%">Idiomas más solicitados para mi carrera</th>
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
            <th style="width:60%">Idiomas más solicitados</th>
            <th style="width:30%">Cantidad de solicitudes</th>    
          </tr>
        </thead>
        <tbody>
          @foreach( $idiomasEnMiCarrera as $key => $idiomaEnMiCarrera )
            <tr>
              <td style="text-align: center;">{{$key + 1}}</td>
              <td>{{$idiomaEnMiCarrera->nombre_idioma}}</td>
              <td>{{$idiomaEnMiCarrera->cantidad}}</td>
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
  }

</script>
