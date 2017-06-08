
<!DOCTYPE html>
<html lang='en'>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Reportes</title>
      <link rel="stylesheet" href="{{asset('css/style-table.css')}}">
      <script src="{{asset('plugins/canvas/canvasjs.min.js')}}"></script>

  </head>

  <body>
   
    <div>      
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th align="center" style="width:20%"> INFORME :</th>
            <th style="width:60%">Idiomas más solicitados para mi Carrera</th>
            <th align="center" style="width:15%">{{$today}}</th>
          </tr>
        </thead>
      </table>

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th align="center" style="width:10%">#</th>
            <th style="width:60%">Idiomas más solicitados</th>
            <th style="width:30%">En cantidad de solicitudes</th>    
          </tr>
        </thead>
        <tbody>
          @foreach( $idiomasEnMiCarrera as $key => $idiomaEnMiCarrera )
            <tr>
              <td align="center">{{$key + 1}}</td>
              <td>{{$idiomaEnMiCarrera->nombre_idioma}}</td>
              <td>{{$idiomaEnMiCarrera->cantidad}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div id="chartContainer-1" style="height: 300px;"></div>
    </div>

  </body>
</html>

<script type="text/javascript">
  window.onload = function () {

    var array1 = [];
      
    @foreach( $idiomasEnMiCarrera as $idioma )
        array1.push({"y":{{$idioma->cantidad}},"label":"{!!$idioma->nombre_idioma!!}"});
    @endforeach

    @if(count($idiomasEnMiCarrera) > 0 )
      var chart = new CanvasJS.Chart("chartContainer-1", {
          title: {
            text: "Idiomas más solicitados para mi Carrera"
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
