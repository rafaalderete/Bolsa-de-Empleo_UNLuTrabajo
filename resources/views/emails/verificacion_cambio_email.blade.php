Ha solicitado el cambio de E-mail, para completar la operación siga el siguiente link:<br>
<a href="{{ $link = url('configurar-cuenta-email/verificacion', $data['token']).'?email='
.urlencode($data['email']) }}">{{ $link }}</a>
