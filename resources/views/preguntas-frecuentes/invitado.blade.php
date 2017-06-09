@extends('template.preguntas-frecuentes-main')

@section('headTitle', 'UNLu Trabajo | Preguntas Frecuentes')

@section('bodyContent')

  <div class="row" style="margin-top:-20px">
    <!-- Box -->
    <div class="box">
      <!-- Cuerpo del Box-->
      <div class="box-content dropbox col-sm-offset-2 col-sm-8" style="min-height:700px">

        <div class="col-md-12 preguntas-header">
          <a href={{ route('auth.login') }}><img src="{{asset('img/escudounlu.png')}}" class="img-rounded logo-login" alt="Logo" /></a>
          <span class="titulo-unlu-preguntas">UNLu Trabajo</span>
        </div>

        <div class="col-md-12 titulo-preguntas-manual">
          <h2 class="requisitos-label">Preguntas Frecuentes</p>
        </div>

        <div class="panel-group" id="accordion" >
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                  Soy nuevo, ¿Cómo me registro?
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body">
                ¡Bienvenido/a! Has decidido comenzar tu búsqueda con nosotros. Nos sentimos más que agradecidos. Para registrarte a nuestra bolsa de trabajo,
                 debes ingresar a nuestro sistema y luego haz click sobre “Registrarse”:
                 <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img1.png')}}"/></p>
                 Completa el formulario con los datos correspondientes:
                 <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img2.jpg')}}"/></p>
                 Una vez que hayas completado el formulario y presionado el botón “Registrarse”, revisa tu correo. En él deberás encontrar una email nuestro para confirmar tu cuenta.
                  ¡Presiona sobre el link y listo! Ya podrás ver las ofertas laborales disponibles y gestionar tu CV.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                  Olvide mi contraseña, ¿Cómo puedo acceder?
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
              <div class="panel-body">
                Si has olvidado tu contraseña no te preocupes, nosotros te ayudamos a recuperarla. Para ello dirigirse al formulario de inicio de sesión.
                 Luego, haga click en el enlace “¿Olvidaste tu contraseña?” tal como se muestra en la siguiente imagen:
                 <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img3.png')}}"/></p>
                 Nos aparecerá otro formulario, el cual nos pedirá que ingresemos el correo con el cual nos hemos registrado en el sistema:
                 <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img4.png')}}"/></p>
                 Una vez hecho esto, el sistema enviará un correo a tu casilla con un link para restablecer la contraseña. Ingresando a dicho link, el sistema nos pedirá una nueva clave.
                 <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img5.png')}}"/></p>
                 Completamos el formulario, ¡y listo! Ya puedes ingresar con tu nueva contraseña.
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection
