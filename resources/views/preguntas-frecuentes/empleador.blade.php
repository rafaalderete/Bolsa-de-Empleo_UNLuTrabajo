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
                  ¿Por qué no recibo los currículums en mi correo?
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body">
                Desde la configuración de tu perfil podrás seleccionar si deseas o no recibir los cv a tu casilla de correos. Verifica dicha configuración y realiza los cambios necesarios para ajustarse a tus preferencias.
                Si quieres recibir los currículums y dicha configuración está activa pero no puedes visualizarlos, revisa la sección de spam. ¡Puede que se hayan desviados a esa sección!
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                  ¿Cuanto tardan las Ofertas en aparecer en la web?
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
              <div class="panel-body">
                Las ofertas laborales aparecerán en el momento en que terminen de ser cargadas.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                  ¿Qué significa que mi oferta está activa?
                </a>
              </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
              <div class="panel-body">
                Se considera una oferta laboral activa como aquella que tiene una fecha de finalización menor a la fecha actual.
                 De ser así, los estudiantes registrados podrán visualizarla y postularse.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                  Ya estoy registrado en UNLu Trabajo, ¿Cómo puedo acceder ahora?
                </a>
              </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
              <div class="panel-body">
                Para acceder a nuestro sistema solamente tienes que completar el formulario de inicio de nuestro sistema:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img6.jpg')}}"/></p>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                  ¿Qué opciones existen para publicar una vacante?
                </a>
              </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
              <div class="panel-body">
                Estando registrado en el sistema, debes ingresar al mismo con tus datos. Selecciona el botón “Realizar Propuesta”:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img7.png')}}"/></p>
                Podrás visualizar un formulario completo para que cargues los datos correspondientes a la propuesta que quieras generar.
                 Podrás establecer que campos son obligatorios por parte de los futuros postulantes, por ejemplo:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img8.jpg')}}"/></p>
                Recuerda que aquellos requisitos importantes serán considerados como características importantes que los postulantes deberán considerar.
                 Muy distinto son los requisitos excluyentes, que son características obligatorias para postularse.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                  ¿Cuanto tiempo permanece publicada la vacante en UNLu Trabajo?
                </a>
              </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse">
              <div class="panel-body">
                Las ofertas laborales permanecerán activas según la fecha de finalización de la misma.
                 Cuando dicha fecha llegue, la oferta laboral pasará a encontrarse en el estado inactivo.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
                  ¿Puedo editar o eliminar una oferta ya publicada?
                </a>
              </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse">
              <div class="panel-body">
                Para modificar las postulaciones es necesario estar logueado en el sistema. Una vez hecho ese paso, ingresa en la sección “Mis Propuestas”.
                 Ahí verás todas las propuestas laborales que has registrado al sistema. Selecciona aquella que desees modificar.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img9.png')}}"/></p>
                Nos aparecerá el mismo formulario con el que has cargado la propuesta. Ahora todos los campos podrán ser editados para ajustarse a tus necesidades.
                ¡Aclaración!: Una vez que un estudiante se haya postulado a tu oferta laboral, ya no podrás modificarla.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
                  ¿Cómo puedo modificar los datos de mi empresa?
                </a>
              </h4>
            </div>
            <div id="collapseEight" class="panel-collapse collapse">
              <div class="panel-body">
                Para modificar los datos de mi empresa dirígete a la siguiente sección:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img10.png')}}"/></p>
                Te aparecerá la siguiente ventana con tu información. Realiza las modificaciones necesarias y presiona “Modificar”.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img11.png')}}"/></p>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
                  ¿Cómo puedo saber si hay personas postuladas en mi propuesta laboral?
                </a>
              </h4>
            </div>
            <div id="collapseNine" class="panel-collapse collapse">
              <div class="panel-body">
                Ingresando al sistema podrás ver todas tus propuestas con el apartado cantidad de postulantes en el pie de página.
                 Esto te brindará un panorama general de cómo tus propuestas se están llevando a cabo.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img12.png')}}"/></p>
                Además, ingresando a una de ellas tendrás la posibilidad de ver en detalle quiénes son esos postulantes:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img13.png')}}"/></p>
                A continuación, podrás ver el listado junto con la posibilidad de seleccionar los cv que te interesen:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img14.jpg')}}"/></p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection
