
<!DOCTYPE html>
<html lang='en'>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Reportes</title>
      <link rel="stylesheet" href="{{asset('css/style-table.css')}}">
  </head>

  <body>
   
    <div>      
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th align="center" style="width:20%"> INFORME :</th>
            <th style="width:60%">Carreras con más Estudiantes</th>
            <th align="center" style="width:15%">{{$today}}</th>
          </tr>
        </thead>
      </table>

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th align="center" style="width:10%">#</th>
            <th style="width:60%">Carrera</th>
            <th style="width:30%">Cantidad de estudiantes</th>    
          </tr>
        </thead>
        <tbody>
          @foreach( $cantidadEstudiantePorCarrera as $key => $carrera )
            <tr>
              <td align="center">{{$key + 1}}</td>
              <td>{{$carrera->nombre_carrera}}</td>
              <td>{{$carrera->cantidad_estudiantes}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>