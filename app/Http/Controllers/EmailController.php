<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Usuario as Usuario;
use App\Http\Requests\ConfigurarEmailRequest;

class EmailController extends Controller
{

  const ERROR_USADO = 'Error al realizar el cambio, e-mail ya usado';
  const ERROR_INVALIDO = 'Este token de cambio de e-mail es inválido.';

  public function getConfigurarCuentaEmail(){

    return view('in.usuarios.configurar-cuenta-email');

  }

  public function postConfigurarCuentaEmail(ConfigurarEmailRequest $request){

    $data['email'] = Auth::user()->email;
    $data['nuevo_email'] = $request->email;
    $data['token'] = str_random(100);

    DB::table('email_resets')->where('email', '=', $data['email'])->delete();

    DB::table('email_resets')->insert(
    array('email' => $data['email'],
          'nuevo_email' => $data['nuevo_email'],
          'token' => $data['token'],
          'created_at' => Carbon::now())
    );

    Mail::send('emails.verificacion_cambio_email', ['data' => $data], function($message) use ($data){
      $message->from('unlutrabajo@gmail.com', 'UNLu Trabajo');
      $message->subject('Link para confirmar cambio de E-mail');
      $message->to($data['nuevo_email']);
    });//Se manda mail de confirmacion.

    Flash::success('¡Se envió un e-mail para verificar el cambio de e-mail de su usuario!.')->important();
    return redirect()->route('in.configurar-cuenta-email');

  }

  public function verificacionCambioEmail(Request $request){

    $error = false;
    $errormnj = '';

    if(isset($_GET['email'])) {
      $tiempo = Carbon::now()->subHour(1);
      $email_token = DB::table('email_resets')
                      ->where('email', '=', $request->email)
                      ->where('token', '=', $request->token)
                      ->where('created_at', '<=', $tiempo) //El token tiene validez de 1 hora.
                      ->get();

      if (count($email_token) > 0) {//Verifica que exista el token.
        $email_usuario = DB::table('usuarios')
                        ->where('email', '=', $email_token[0]->nuevo_email)
                        ->get();
        if (count($email_usuario) == 0) { //Verifica que no haya otro usuario con el nuevo mail a asignar.
          $usuario = Usuario::where('email','=',$request->email)
                      ->first();
          $usuario->email = $email_token[0]->nuevo_email;
          $usuario->save();//Se efectua el cambio de mail.

          DB::table('email_resets')->where('email', '=', $request->email)->delete(); //Se elimina el token utilizado.

          Auth::logout();

          Flash::success('¡Cambio de e-mail realizado!')->important();
          return redirect()->route('auth.login');
        }
        else {//Existe un usuario con el nuevo mail a asignar.
          $error = true;
          $errormnj = self::ERROR_USADO;
        }
      }
      else {//Token inexistente o caducado.
        $error = true;
        $errormnj = self::ERROR_INVALIDO;
      }
      if ($error) {
        Flash::error($errormnj)->important();
        if (Auth::check()) {
          return redirect()->route('in.index');
        }
        else {
          return redirect()->route('auth.login');
        }
      }
    }
    else {
      return redirect()->route('auth.login');
    }

  }

}
