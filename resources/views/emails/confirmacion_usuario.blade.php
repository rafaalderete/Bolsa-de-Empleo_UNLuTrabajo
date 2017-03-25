Sigue el link para confirmar tu usuario:<br>
<a href="{{ $link = url('registro/confirmacion', $data['confirmacion_token']).'?email='
.$data['email'] }}">{{ $link }}</a>
