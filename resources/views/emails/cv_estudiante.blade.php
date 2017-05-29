<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <title>Curriculum Vitae</title>
    <link rel="stylesheet" href="{{asset('plugins/orbit/css/styles.css')}}" >
</head>

<body>

<div class="wrapper">
        <div class="main-wrapper">

          <section class="section experiences-section">
              <h2 class="section-title page-header">Datos Personales</h2>
                  
              <div class="contenedor">
                @if(Auth::user()->imagen != null)
                <!-- PHOTO (AVATAR) -->
                  <div class="imagen">
                    <img src="{{asset('img/usuarios').'/'.Auth::user()->imagen}}" width="130" height="100" class="img-rounded" alt="avatar">
                  </div>
                @endif
                <div class="col-sm-9">                                                       
                  <div class="info col-sm-6"> 
                    <span class="job-title">Nacimiento</span> : 
                    <span class="company">{{$pfisica->fecha_nacimiento}}</span>.
                  </div>
                  <div class="info col-sm-6"> 
                    <span class="job-title">{{$pfisica->tipoDocumento->nombre_tipo_documento}}</span> : 
                    <span class="company">{{$pfisica->nro_documento}}</span>.
                  </div>
                </div>
                <div class="col-sm-9">
                  <div class="info col-sm-6"> 
                    <span class="job-title">Domicilio</span> : 
                    <span class="company">{{$pfisica->persona->direccion->domicilio}}</span>.
                  </div>
                  <div class="info col-sm-6"> 
                    <span class="job-title">Localidad</span> : 
                    <span class="company">{{$pfisica->persona->direccion->localidad}}</span>.
                  </div>
                </div>
                <div class="col-sm-9">
                  <div class="info col-sm-6"> 
                    <span class="job-title">Telefono</span> : 
                    <span class="company">{{$telefono_fijo}}</span>.
                  </div>
                  <div class="info col-sm-6"> 
                    <span class="job-title">Celular</span> : 
                    <span class="company">{{$telefono_celular}}</span>.
                  </div>
                </div>
                <div class="col-sm-9">
                  <div class="info col-sm-12"> 
                    <span class="job-title">E-Mail</span> : 
                    <span class="company">{{Auth::user()->email}}</span>.
                  </div>
                </div>
              </div>
            </section>

          @if (($pfisica->estudiante->cv->carta_presentacion != null) || ($pfisica->estudiante->cv->sueldo_bruto_pretendido != null))
            <section class="section summary-section">
              <h2 class="section-title2">Objetivo Laboral</h2>
            
              @if ($pfisica->estudiante->cv->carta_presentacion != null)
                <div class="sueldo">
                  <div class="row">
                    <div class="col-md-12">
                       <p>{!!$pfisica->estudiante->cv->carta_presentacion !!}</p>
                    </div>
                  </div>
                </div><!--//summary-->
              @endif
            
              @if ($pfisica->estudiante->cv->sueldo_bruto_pretendido != null)
                <div class="sueldo">
                    <span>Mi sueldo bruto pretendido es</span> : 
                    <span>{{$pfisica->estudiante->cv->sueldo_bruto_pretendido}}</span> $.
                </div>
              @endif
           </section><!--//section-->
          @endif
        
          @if(count($estudios) > 0 )      
            <section class="section experiences-section">
              <h2 class="section-title">Estudio Académico</h2>        
              @foreach( $estudios as $estudio)
                <div class="item">
                  <div class="meta">
                    <div class="upper-row">
                      <h3 class="job-title">{{$estudio->titulo}}</h3>
                      <div class="time">
                        <span>{{$estudio->periodo_inicio}}</span> / 
                          @if($estudio->periodo_fin == 0)
                            <span>Presente</span>
                          @else
                            <span>{{$estudio->periodo_fin}}</span>
                          @endif
                      </div>
                    </div><!--//upper-row-->
                    <div class="company">
                      <span>{{$estudio->estadoCarrera->nombre_estado_carrera}}</span> - 
                        <span>{{$estudio->nombre_instituto}}</span>
                    </div>
                    <div class="company">
                      <span>Avance de la Carrera</span> : 
                      <span>{{$estudio->materias_aprobadas}}</span> /
                      <span>{{$estudio->materias_total}}</span> Materias.
                    </div>
                  </div><!--//meta-->
                </div><!--//item-->
              @endforeach
            </section><!--//section-->
          @endif

          @if(count($expLaborales) > 0 )
            <section class="section experiences-section">
              <h2 class="section-title"></i>Experiencia Laboral</h2>
              @foreach( $expLaborales as $expLaboral)
                <div class="item">
                  <div class="meta">
                    <div class="upper-row">
                      <h3 class="job-title">{{$expLaboral->puesto}}</h3>
                      <div class="time">
                        <span>{{$expLaboral->periodo_inicio}}</span> / 
                        @if($expLaboral->periodo_fin == 0)
                          <span>Presente</span>
                        @else
                          <span>{{$expLaboral->periodo_fin}}</span>
                        @endif
                      </div>
                    </div><!--//upper-row-->
                    <div class="company">
                      <span>{{$expLaboral->nombre_empresa}}</span> - 
                      <span>{{$expLaboral->rubroEmpresarial->nombre_rubro_empresarial}}</span>    
                    </div>
                  </div><!--//meta-->
                  <div class="company-details">
                    <span>{{$expLaboral->descripcion_tarea}}</span>
                  </div><!--//details-->
                </div><!--//item-->
              @endforeach
            </section><!--//section-->
          @endif
              
          @if(count($conocimientosIdiomas) > 0 )
            <section class="skills-section section">
              <h2 class="section-title">Conocimiento Idioma</h2>
              <div class="skillset">        
                @foreach( $conocimientosIdiomas as $conocimientoIdioma)
                  <div class="skill">
                    <span class="job-title">{{$conocimientoIdioma->idioma->nombre_idioma}}</span>.
                    <span class="company">{{$conocimientoIdioma->tipoConocimientoIdioma->nombre_tipo_conocimiento_idioma}}</span>.
                    <span class="company">{{$conocimientoIdioma->nivelConocimiento->nombre_nivel_conocimiento}}</span>.
                  </div><!--//item-->
                @endforeach 
              </div><!--//item-->  
            </section><!--//skills-section-->
          @endif

          @if(count($conocimientosInformaticos) > 0 )
            <section class="skills-section section">
              <h2 class="section-title">Conocimiento Informático</h2>
              <div class="skillset">        
                @foreach( $conocimientosInformaticos as $conocimientoInformatico)
                  <div class="skill">
                    <span class="job-title">{{$conocimientoInformatico->tipoSoftware->nombre_tipo_software}}</span>.
                    <span class="company">{{$conocimientoInformatico->nivelConocimiento->nombre_nivel_conocimiento}}</span>.
                  </div>
                @endforeach        
              </div><!--//item-->  
            </section><!--//skills-section-->
          @endif
          
          @if(count($conocimientosAdicionales) > 0 )
            <section class="skills-section section">
              <h2 class="section-title">Conocimiento Adicional</h2>
              <div class="skillset">        
                @foreach( $conocimientosAdicionales as $conocimientoAdicional)
                  <div class="skill">
                    <span class="job-title">{{$conocimientoAdicional->nombre_conocimiento}}</span>.
                    <span class="company">{{$conocimientoAdicional->descripcion_conocimiento}}</span>.
                  </div>        
                @endforeach
              </div><!--//item-->  
            </section><!--//skills-section-->        
          @endif
        </div><!--//main-body-->
      </div>
</body>
</html>
