<div class="footer-in-auth">
	<footer>
			<div class="text-center footer-content col-lg-12">
				<p><a href="http://www.unlu.edu.ar/">Universidad Nacional de Luján</a> - Rutas 5 y 7 - (6700) Luján, Buenos Aires, Argentina</p>
				<p>
					Teléfonos: +54 (02323) 423979/423171 - Fax: +54 (02323) 425795 - Email: informes@unlu.edu.ar -
					@if (Entrust::hasRole('administrador') || Entrust::hasRole('super_usuario'))
						<a href="{{ route('preguntas-frecuentes') }}">Manual de Usuario</a>
					@else
						<a href="{{ route('preguntas-frecuentes') }}">Preguntas Frecuentes</a>
					@endif
				</p>
			</div>
	</footer>
</div>
