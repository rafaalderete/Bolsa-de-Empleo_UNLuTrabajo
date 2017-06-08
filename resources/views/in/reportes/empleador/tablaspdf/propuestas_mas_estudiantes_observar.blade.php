
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
            <th style="width:60%">Estudiantes para observar</th>
            <th align="center" style="width:15%">{{$today}}</th>
          </tr>
        </thead>
      </table>

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th align="center" style="width:10%">#</th>
            <th style="width:60%">Propuesta</th>
            <th style="width:30%">Postulados por ver</th>    
          </tr>
        </thead>
        <tbody>
          @foreach( $cantPostSinDecidirPorProp as $key => $propuesta )
            <tr>
              <td align="center">{{$key + 1}}</td>
              <td>{{$propuesta->titulo}}</td>
              <td>{{$propuesta->postulados_sin_decidir}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>