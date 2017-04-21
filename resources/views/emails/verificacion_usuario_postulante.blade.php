Siga el link para confirmar tu usuario:<br>
<a href="{{ $link = url('registro-postulante/verificacion', $data['verificacion_token']).'?email='
.urlencode($data['email']) }}">{{ $link }}</a>
