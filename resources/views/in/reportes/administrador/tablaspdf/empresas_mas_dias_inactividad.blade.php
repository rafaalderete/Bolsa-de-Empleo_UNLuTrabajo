
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
            <th style="width:60%">Empresas con más dias de Inactividad</th>
            <th align="center" style="width:15%">{{$today}}</th>
          </tr>
        </thead>
      </table>

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th align="center" style="width:10%">#</th>
            <th style="width:60%">Empresa</th>
            <th style="width:30%">Dias de inactividad</th>    
          </tr>
        </thead>
        <tbody>
          @foreach( $empresasActivas as $key => $empresa )
            <tr>
              <td align="center">{{$key + 1}}</td>
              <td>{{$empresa->nombre_comercial}}</td>
              <td>{{$empresa->dias_inactivo}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>