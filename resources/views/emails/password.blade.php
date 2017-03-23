Sigue el link para restablecer tu contraseña:<br>
<a href="{{ $link = url('password/reset', $token).'?email='
  .urlencode($user->getEmailForPasswordReset()) }}">{{ $link }}</a>
