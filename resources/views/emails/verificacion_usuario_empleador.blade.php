Ha sido dado de alta en UNLu Trabajo, siga el link para confirmar tu usuario y establecer tu contraseña:<br>
<a href="{{ $link = url('registro-empleador/verificacion', $data['verificacion_token']).'?email='
.urlencode($data['email']) }}">{{ $link }}</a>
