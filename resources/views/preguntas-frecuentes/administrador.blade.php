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
          <h2 class="requisitos-label">Manual de Usuario</p>
        </div>

        <div class="panel-group" id="accordion" >
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                  Loguearse en el sistema
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body">
                Una vez instalado el sistema (ver Manual de Instalación), podrás acceder al mismo. Al ser administrador del sistema, te proveeremos una cuenta y contraseña para que puedas acceder al sistema inicialmente; a partir de ella podrás generar tantos usuarios administradores como empleadores desees.
                Deberás colocar el e-mail provisto y la contraseña inicial, la cual podrás cambiar cuando lo desees:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img6.jpg')}}"/></p>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                  Recuperar Contraseña
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
              <div class="panel-body">
                En el caso de que te hayas olvidado tu contraseña, presiona la siguiente opción:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img20.jpg')}}"/></p>
                Luego indícanos tu e-mail, y presiona el botón "Enviar".
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img4.png')}}"/></p>
                El sistema te enviará un correo electrónico para restablecer tu contraseña, y allí podrás seguir el procedimiento indicado.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img21.jpg')}}"/></p>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                  Configurar datos personales
                </a>
              </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
              <div class="panel-body">
                En el margen superior derecho, encontrarás un menú para las configuraciones que necesites realizar. Eligiendo la opción "Datos Personales",
                podrás cambiar tu domicilio, localidad, provincia, país, teléfonos de contacto y tu foto de perfil.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img22.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img23.jpg')}}"/></p>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                  Configurar cuenta
                </a>
              </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
              <div class="panel-body">
                Si elegís la opción "Configurar Cuenta", encontrarás la funcionalidad de Cambiar tu E-Mail y tu Contraseña.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img24.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img25.jpg')}}"/></p>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                  Logout
                </a>
              </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
              <div class="panel-body">
                Cuando desees desloguearte, elige la opción "Logout". Podrás regresar al sistema logueandote nuevamente en el momento que desees.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img26.jpg')}}"/></p>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                  Registrar Empleador
                </a>
              </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse">
              <div class="panel-body">
                Al loguearse en el sistema, encontrarás la funcionalidad de "Registrar Empleador".
                Cuando una empresa requiera acceder al sistema, deberá contactarse con la Universidad enviando un e-mail a unlutrabajo@gmail.com o comunicándose a los teléfonos que se encuentran en la parte inferior de nuestro sistema.
                Allí coordinarán la documentación necesaria que la empresa necesite enviar al departamento de Empleos.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img27.jpg')}}"/></p>
                Cuando se registre al empleador, se le enviará un correo electrónico al e-mail cargado en el formulario. El cual tendrá que confirmar para estar activo en el sistema.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
                  Explorar el menú
                </a>
              </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse">
              <div class="panel-body">
                En el panel ubicado a la izquierda, encontrarás la posibilidad de manejar distintas funcionalidades: alta,
                 baja y modificación de Personas, Empresas, Usuarios, Roles, Permisos.
                Otra funcionalidad muy útil del sistema se basa en poder gestionar diferentes grupos de datos, por ejemplo: podrás ingresar nuevos Rubros Empresariales, modificar algún Idioma, eliminar un nivel de conocimiento específico, etc.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img28.jpg')}}"/></p>
                A continuación se detallará cada opción:
                <p></p>
                <p><strong>Listado de Personas:</strong></p>
                En esta opción podrás visualizar todas las personas físicas cargadas en el sistema. Cuando un estudiante se registre en el sistema, se cargará esta tabla con sus datos personales.
                En este punto, Ud. como administrador del sistema podrá modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img29.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img30.jpg')}}"/></p>
                <p></p>
                <p><strong>Registrar Persona:</strong></p>
                En el caso de que necesite registrar una persona, podes hacerlo mediante la siguiente opción:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img31.jpg')}}"/></p>
                Obtendrás un formulario donde se puedan cargar personas físicas (como ser estudiantes, o administradores dentro del sistema), y luego a ellos les podrás asignar un usuario específico.
                Esta funcionalidad se trata de un circuito alternativo a la generación de nuevos estudiantes (Rol: Postulante) dentro del sistema; mediante el cual se dará de alta a la persona sin necesidad de que confirme su registración mediante el e-mail que envía el sistema.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img32.jpg')}}"/></p>
                <p></p>
                <p><strong>Listado de Empresas:</strong></p>
                En esta opción podrás visualizar todas las empresas cargadas en el sistema. Cuando registres un Empleador en el sistema, se cargará esta tabla con los datos personales.
                En este punto, Ud. como administrador del sistema podrá modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img33.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img34.jpg')}}"/></p>
                <p></p>
                <p><strong>Registrar Empresa:</strong></p>
                En el caso de que necesite registrar una empresa, podes hacerlo mediante la siguiente opción:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img35.jpg')}}"/></p>
                Obtendrás un formulario donde se puedan cargar empresas para luego asignarles un usuario específico.
                Esta funcionalidad se trata de un circuito alternativo a la registración de nuevas empresas (Rol: Empleador) dentro del sistema; mediante el cual se dará de alta a la empresa y usuario asociado, sin necesidad de que confirme su registración mediante el e-mail que envía el sistema.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img36.jpg')}}"/></p>
                <p></p>
                <p><strong>Listado de Usuarios:</strong></p>
                En esta opción podrás visualizar todos los usuarios cargados en el sistema. Cuando un estudiante y/o una empresa se registren en el sistema, se cargará esta tabla con sus respectivos datos de usuario.
                En este punto, Ud. como administrador del sistema podrá modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img37.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img38.jpg')}}"/></p>
                <p></p>
                <p><strong>Registrar Usuario:</strong></p>
                En el caso de que necesite registrar un usuario, podes hacerlo mediante la siguiente opción:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img39.jpg')}}"/></p>
                Obtendrás un formulario donde se puedan cargar usuarios, los cuales corresponderán a un estudiante, administrador o empresa dentro del sistema.
                Esta funcionalidad se trata de un circuito alternativo a la generación de nuevos usuarios dentro del sistema; mediante el cual se dará de alta al usuario sin necesidad de que confirme su registración mediante el e-mail que envía el sistema (si se siguiese el curso normal de alta)
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img40.jpg')}}"/></p>
                <p></p>
                <p><strong>Listado de Roles:</strong></p>
                En esta opción podrás visualizar todos los roles cargados en el sistema. Cada usuario, tiene asignado un rol específico dentro del sistema. Según los workflows definidos para el sistema, los roles deben ser 4: super usuario, administrador, empleador y postulante.
                En este punto, Ud. como administrador del sistema podrá modificar/eliminar algún rol que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img41.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img42.jpg')}}"/></p>
                <p></p>
                <p><strong>Registrar Rol:</strong></p>
                En el caso de que necesite registrar un nuevo rol, podes hacerlo mediante la siguiente opción:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img43.jpg')}}"/></p>
                Obtendrás un formulario donde se puedan cargar nuevos roles, al cual le deberás asignar los permisos que consideres necesarios.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img44.jpg')}}"/></p>
                <p></p>
                <p><strong>Listado de Permisos:</strong></p>
                En esta opción podrás visualizar todos los permisos cargados en el sistema. Estos permisos, son los que se asocian a los roles definidos dentro del sistema; los cuales habilitan y deshabilitan funciones específicas.
                En este punto, Ud. como administrador del sistema podrá modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img45.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img46.jpg')}}"/></p>
                <p></p>
                <p><strong>Registrar Permiso:</strong></p>
                En el caso de que necesite registrar un nuevo permiso, podes hacerlo mediante la siguiente opción:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img47.jpg')}}"/></p>
                Obtendrás un formulario donde se puedan cargar nuevos permisos con su correspondiente descripción.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img48.jpg')}}"/></p>
                <p></p>
                <p><strong>Configuraciones grupo 1: Rubros Empresariales</strong></p>
                En esta opción podrás visualizar todos los rubros empresariales cargados en el sistema. Estas opciones serán visualizadas en un campo desplegable al momento de que el estudiante cargue una experiencia laboral en su CV, que un empleador genere una nueva oferta laboral, etc.
                En este punto, Ud. como administrador del sistema podrá agregar/modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img49.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img50.jpg')}}"/></p>
                <p></p>
                <p><strong>Configuraciones grupo 1: Idiomas</strong></p>
                En esta opción podrás visualizar todos los idiomas cargados en el sistema. Estas opciones serán visualizadas en un campo desplegable al momento de que el estudiante cargue una conocimiento de idioma en su CV, que un empleador genere una nueva oferta laboral, etc.
                En este punto, Ud. como administrador del sistema podrá agregar/modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img51.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img52.jpg')}}"/></p>
                <p></p>
                <p><strong>Configuraciones grupo 1: Tipos de Software</strong></p>
                En esta opción podrás visualizar todos los tipos de software cargados en el sistema. Estas opciones serán visualizadas en un campo desplegable al momento de que el estudiante cargue una conocimiento de software en su CV, que un empleador genere una nueva oferta laboral, etc.
                En este punto, Ud. como administrador del sistema podrá agregar/modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img53.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img54.jpg')}}"/></p>
                <p></p>
                <p><strong>Configuraciones grupo 1: Estados de carrera</strong></p>
                En esta opción podrás visualizar todos los estados de carrera cargados en el sistema. Estas opciones serán visualizadas en un campo desplegable al momento de que el estudiante cargue un registro de educación en su CV, que un empleador genere una nueva oferta laboral, etc.
                En este punto, Ud. como administrador del sistema podrá agregar/modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img55.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img56.jpg')}}"/></p>
                <p></p>
                <p><strong>Configuraciones grupo 1: Tipos de Jornada</strong></p>
                En esta opción podrás visualizar todos los tipos de jornada cargados en el sistema. Estas opciones serán visualizadas en un campo desplegable al momento de que el estudiante filtre en "Buscar Ofertas" por algún criterio específico, que un empleador genere una nueva oferta laboral, etc.
                En este punto, Ud. como administrador del sistema podrá agregar/modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img57.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img58.jpg')}}"/></p>
                <p></p>
                <p><strong>Configuraciones grupo 2: Tipos de Trabajo</strong></p>
                En esta opción podrás visualizar todos los tipos de trabajo cargados en el sistema. Estas opciones serán visualizadas en un campo desplegable al momento de que el estudiante filtre en "Buscar Ofertas" por algún criterio específico, que un empleador genere una nueva oferta laboral, etc.
                En este punto, Ud. como administrador del sistema podrá agregar/modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img59.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img60.jpg')}}"/></p>
                <p></p>
                <p><strong>Configuraciones grupo 2: Niveles de Conocimiento</strong></p>
                En esta opción podrás visualizar todos los niveles de conocimiento cargados en el sistema. Estas opciones serán visualizadas en un campo desplegable al momento de que el estudiante cargue un conocimiento de idioma en su CV, que un empleador genere una nueva oferta laboral, etc.
                En este punto, Ud. como administrador del sistema podrá agregar/modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img61.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img62.jpg')}}"/></p>
                <p></p>
                <p><strong>Configuraciones grupo 2: Niveles Educativos</strong></p>
                En esta opción podrás visualizar todos los niveles educativos cargados en el sistema. Estas opciones serán visualizadas en un campo desplegable al momento de que el estudiante cargue un registro de educación en su CV, que un empleador genere una nueva oferta laboral, etc.
                En este punto, Ud. como administrador del sistema podrá agregar/modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img63.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img64.jpg')}}"/></p>
                <p></p>
                <p><strong>Configuraciones grupo 2: Tipos de Conocimiento Idioma</strong></p>
                En esta opción podrás visualizar todos los tipos de conocimientos de idioma cargados en el sistema. Estas opciones serán visualizadas en un campo desplegable al momento de que el estudiante cargue un conocimiento de idioma en su CV, que un empleador genere una nueva oferta laboral, etc.
                En este punto, Ud. como administrador del sistema podrá agregar/modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img65.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img66.jpg')}}"/></p>
                <p></p>
                <p><strong>Configuraciones grupo 2: Tipos de Documento</strong></p>
                En esta opción podrás visualizar todos los tipos de documento cargados en el sistema. Estas opciones serán visualizadas en un campo desplegable al momento de que el estudiante cargue sus datos personales en el formulario de registración que un administrador cargue una persona física con rol administrador, etc.
                En este punto, Ud. como administrador del sistema podrá agregar/modificar/eliminar algún registro que desee.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img67.jpg')}}"/></p>
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img68.jpg')}}"/></p>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
                  Obtener Reportes
                </a>
              </h4>
            </div>
            <div id="collapseEight" class="panel-collapse collapse">
              <div class="panel-body">
                También encontrarás la funcionalidad de "Reportes" dentro de nuestro sistema.
                Estos reportes resultan muy útiles para tener un panorama general sobre diferentes parámetros, los cuales resultan ser una fuente de información fiable para tomar decisiones.
                Por ejemplo, obtenemos cuáles son las empresas que tienen más propuestas cargadas en nuestro sistema, las carreras que tienen más estudiantes, la cantidad de empresas que existen según el rubro empresarial, cantidad de propuestas por distintos filtros: empresas, carreras, etc.
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img69.jpg')}}"/></p>
                En cada gráfico que se visualiza en la funcionalidad "Reportes", tenemos la opción de visualizar la "Tabla de Detalle" del ranking que queramos visualizar:
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img70.jpg')}}"/></p>
                Si quisiéramos descargarnos este reporte en PDF, daremos click en la opción "Descargar Reporte"
                <p class="text-center img-pregunta"><img src="{{asset('img/preguntas/img71.jpg')}}"/></p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection
