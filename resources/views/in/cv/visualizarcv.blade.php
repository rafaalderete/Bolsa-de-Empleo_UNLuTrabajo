@extends('template.in_main')

@section('headTitle', 'Gestionar CV | Visualizar CV')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Visualizar CV</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')


<div class="row" style="margin-top:-20px">
  <!-- Box -->
  <div class="box">
    <!-- Cuerpo del Box-->

    @include('template.partials.sidebar-gestionarcv')

    <div class="box-content dropbox">
    <h4 class="page-header">Visualizar CV</h4>
    <div class="wrapper">
      <div class="sidebar-wrapper">
          <div class="profile-container">
            @if(Auth::user()->imagen != null)
              <!-- PHOTO (AVATAR) -->
              <div id="photo">
                <img src="{{asset('img/usuarios').'/'.Auth::user()->imagen}}" width="130" height="100" class="img-rounded" alt="avatar">
              </div>
            @endif
            <h1>{{$pfisica->apellido_persona}},</h1>
            <h4>{{$pfisica->nombre_persona}}</h4>
          </div><!--//profile-container-->
              
          <div class="education-container container-block">
              <h2 class="container-block-title">Datos Personales</h2>
                  <div class="item">
                      <span>Nacimiento</span> :
                      <span>{{$pfisica->fecha_nacimiento}}</span>
                  </div><!--//item-->
                  <div class="item">
                      <span>{{$pfisica->tipoDocumento->nombre_tipo_documento}}</span> :
                      <span>{{$pfisica->nro_documento}}</span>
                  </div><!--//item-->
                  <div class="item">
                      <span>Domicilio</span> :
                      <span>{{$pfisica->persona->direccion->domicilio}}</span>
                  </div><!--//item-->
                  <div class="item">
                      <span>Localidad</span> :
                      <span>{{$pfisica->persona->direccion->localidad}}</span>
                  </div><!--//item-->
                  
                  <div class="item">
                      <span>Telefono</span> :
                      <span>{{$telefono_fijo}}</span>
                  </div><!--//item-->
                  <div class="item">
                      <span>Celular</span> :
                      <span>{{$telefono_celular}}</span>
                  </div><!--//item-->
                  <div class="item">
                      <span>E-Mail</span> :
                      <span>{{Auth::user()->email}}</span>
                  </div><!--//item-->
          </div><!--//education-container-->
      </div><!--//sidebar-wrapper-->
        
        
      <div class="main-wrapper">
        @if (($pfisica->estudiante->cv->carta_presentacion != null) || ($pfisica->estudiante->cv->sueldo_bruto_pretendido != null))
          <section class="section summary-section">
            <h2 class="section-title2">Objetivo Laboral</h2>
            
            @if ($pfisica->estudiante->cv->carta_presentacion != null)
              <div class="detalle-descripcion">
                <div class="row">
                  <div class="col-md-12">
                    <span>{{$pfisica->estudiante->cv->carta_presentacion}}</span>
                  </div>
                </div>
              </div><!--//summary-->
            @endif
            
            @if ($pfisica->estudiante->cv->sueldo_bruto_pretendido != null)
              <div class="sueldo">
                  <span>Mi Sueldo Bruto Pretendido es</span> : 
                  <span>{{$pfisica->estudiante->cv->sueldo_bruto_pretendido}}</span> $.
              </div>
            @endif
          </section><!--//section-->
        @endif
              
          <section class="section experiences-section">
              <h2 class="section-title">Estudio Académico</h2>        
              <div class="item">
                  <div class="meta">
                      <div class="upper-row">
                        <h3 class="job-title">Lic. en Sistemas de Informacion</h3>
                        <div class="time">
                          <span>2015</span> - <span>Presente</span>
                        </div>
                      </div><!--//upper-row-->
                      <div class="company">
                        <span>En Curso</span> - 
                        <span>Universidad Nacional de Luján</span>
                      </div>
                      <div class="company">
                        <span>Porcentaje de Avance de la Carrera</span> : 
                        <span>70</span> %
                      </div>
                  </div><!--//meta-->
              </div><!--//item-->
              <div class="item">
                  <div class="meta">
                      <div class="upper-row">
                        <h3 class="job-title">Lic. en Sistemas de Informacion</h3>
                        <div class="time">
                          <span>2015</span> - <span>Presente</span>
                        </div>
                      </div><!--//upper-row-->
                      <div class="company">
                        <span>En Curso</span> - 
                        <span>Universidad Nacional de Luján</span>
                      </div>
                      <div class="company">
                        <span>Porcentaje de Avance de la Carrera</span> : 
                        <span>70</span> %
                      </div>
                  </div><!--//meta-->
              </div><!--//item-->        
          </section><!--//section-->
              

          <section class="section experiences-section">
              <h2 class="section-title"></i>Experiencia Laboral</h2>
              <div class="item">
                  <div class="meta">
                      <div class="upper-row">
                          <h3 class="job-title">Analista Desarrollador</h3>
                          <div class="time">
                            <span>2015</span> - <span>Presente</span>
                          </div>
                      </div><!--//upper-row-->
                      <div class="company">
                          <span>Besysoft S.A.</span> - 
                          <span>Software</span>    
                      </div>
                  </div><!--//meta-->
                  <div class="company-details">
                      <span>Desarrollador Jr de sistemas bancarios</span>
                  </div><!--//details-->
              </div><!--//item-->

              <div class="item">
                  <div class="meta">
                      <div class="upper-row">
                          <h3 class="job-title">Analista Desarrollador</h3>
                          <div class="time">
                            <span>2015</span> - <span>Presente</span>
                          </div>
                      </div><!--//upper-row-->
                      <div class="company">
                          <span>Besysoft S.A.</span> - 
                          <span>Software</span>    
                      </div>
                  </div><!--//meta-->
                  <div class="company-details">
                      <span>Desarrollador Jr de sistemas bancarios</span>
                  </div><!--//details-->
              </div><!--//item-->
             
          </section><!--//section-->
              
          <section class="skills-section section">
              <h2 class="section-title">Conocimiento Idioma</h2>
              <div class="skillset">        
                  <div class="skill">
                    <span class="job-title">Ingles</span>.
                    <span class="company">Oral</span>.
                    <span class="company">Intermedio</span>.
                  </div><!--//item--> 
                  <div class="skill">
                    <span class="job-title">Ingles</span>.
                    <span class="company">Oral</span>.
                    <span class="company">Intermedio</span>.
                  </div><!--//item-->        
              </dicv><!--//item-->  
          </section><!--//skills-section-->
          <section class="skills-section section">
              <h2 class="section-title">Conocimiento Informático</h2>
              <div class="skillset">        
                  <div class="skill">
                  <span class="job-title">Laravel</span>.
                  <span class="company">Intermedio</span>.
                  </div>        
              </dicv><!--//item-->  
          </section><!--//skills-section-->
          <section class="skills-section section">
              <h2 class="section-title">Conocimiento Adicional</h2>
              <div class="skillset">        
                  <div class="skill">
                      <span class="job-title">Sistema de reporte de incidencia (JIRA)</span>.
                      <span class="company">Intermedio</span>.
                  </div>        
              </dicv><!--//item-->  
          </section><!--//skills-section-->        
      </div><!--//main-body-->
    </div>
    </div>
  </div>
</div>

@endsection
