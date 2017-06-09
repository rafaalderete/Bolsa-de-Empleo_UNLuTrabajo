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
                  ¿Cómo puedo crear mi curriculum?
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
              <div class="panel-body">
                Para crear tu currículum primero debes ingresar al sistema con tu email y contraseña.
                Luego nos dirígete a "Mi CV"
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img15.png')}}"/></p>
                Luego, nos aparecerá un menú lateral:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img16.png')}}"/></p>
                En cada uno de ellos, podremos agregar los conocimientos pertinentes.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                  Olvide mi contraseña, ¿Cómo puedo acceder?
                </a>
              </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
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
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                  ¿Cómo busco ofertas?
                </a>
              </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
              <div class="panel-body">
                Para buscar ofertas laborales debes dirigirte a la sección “Buscar Ofertas” del menú superior.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img17.png')}}"/></p>
                Allí encontrarás las últimas ofertas disponibles ordenadas por fecha de creación.
                 Si quieres puedes filtrar tu búsqueda con los filtros de Carrera, Tipo de Jornada, Idioma, ¡y muchos más!
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                  ¿Cómo me puedo postular a las ofertas de empleo?
                </a>
              </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
              <div class="panel-body">
                Para poder postularte a cualquiera de nuestras ofertas laborales, primero debes ingresar con usuario y contraseña.
                 Una vez ingresado en el sistema, selecciona la oferta que te interesa haciendo click sobre ella.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img18.png')}}"/></p>
                Lee atentamente la propuesta y en caso de que te interese, haz click sobre el botón “Postularse”.
                Verifica en el menú de “Mis Postulaciones” todas las postulaciones que has hecho hasta el momento.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img19.png')}}"/></p>
                ¡Y listo! Tu CV ha sido enviado a la propuesta. Mucha suerte para los pasos próximos.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                  ¿Cuántas veces puedo postularme al mismo aviso?
                </a>
              </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse">
              <div class="panel-body">
                Podrás postularte una vez en cada oferta.
                 Si la empresa reabre la postulación, podrás aplicar a ella nuevamente.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
                  ¿Por qué no puedo ver el e-mail de la empresa para mandar mi curriculum?
                  ¿Cómo puedo contactar con las empresas si no veo su e-mail?
                </a>
              </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse">
              <div class="panel-body">
                La información acerca de las empresas que postulan en nuestro sistema es confidencial.
                 Si quieres contactarte con ellas por fuera de UNLuTrabajo, te recomendamos que ingreses a los sitios oficiales y busques allí la información de contacto que te interese.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
                  ¿De qué manera las empresas pueden contactar conmigo?
                </a>
              </h4>
            </div>
            <div id="collapseEight" class="panel-collapse collapse">
              <div class="panel-body">
                Al aplicar en una postulación tu CV es enviado a las empresas. Estas elegirán el medio por el cual se comunicarán con vos.
                 UNLuTrabajo te recomienda que no rechaces llamadas telefónicas y revises el Spam de tu correo electrónico.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
                  ¿Quién puede ver mi curriculum?
                </a>
              </h4>
            </div>
            <div id="collapseNine" class="panel-collapse collapse">
              <div class="panel-body">
                Solamente tú puedes ver tu CV y por supuesto, aquellas empresas en las cuales te has postulado.
                 UNLuTrabajo no interfiere en tus datos personales.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen">
                  ¿Qué datos de mi curriculum ven las empresas?
                </a>
              </h4>
            </div>
            <div id="collapseTen" class="panel-collapse collapse">
              <div class="panel-body">
                Las empresas verán solamente aquellos datos que has cargado.
                 Estos datos son tanto de carácter académico como de información personal. ¡No te olvides de completar todo lo necesario!
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">
                  ¿Puedo cargar mi cv en formato .pdf?
                </a>
              </h4>
            </div>
            <div id="collapseEleven" class="panel-collapse collapse">
              <div class="panel-body">
              Por supuesto que sí. Podrás cargar un archivo que consideres pertinente para aumentar tus posibilidades de conseguir un empleo.
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection
