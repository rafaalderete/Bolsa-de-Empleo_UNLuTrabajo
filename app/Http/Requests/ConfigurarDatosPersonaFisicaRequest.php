<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConfigurarDatosPersonaFisicaRequest extends Request
{

    const CAMPO_DOMICILIO = 'Domicilio';
    const CAMPO_LOCALIDAD = 'Localidad';
    const CAMPO_Provincia = 'Provincia';
    const CAMPO_PAIS = 'Pais';
    const CAMPO_TELEFONO1 = 'Telefono Fijo';
    const CAMPO_TELEFONO2 = 'Telefono Celular';
    const CAMPO_IMAGEN = 'Imagen';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'telefono_fijo' => 'max:20',
        'telefono_celular' => 'max:20',
        'imagen' => 'image|max:500',
        'imagen_cambiada' => 'required|in:0,1'
      ];
    }

    public function messages()
    {
      return [
          'telefono_fijo.max' => 'El campo '.self::CAMPO_TELEFONO1.' debe contener 20 caracteres como máximo.',
          'telefono_celular.max' => 'El campo '.self::CAMPO_TELEFONO2.' debe contener 20 caracteres como máximo.',
          'imagen_cambiada.in' => 'Datos invalidos.',
          'imagen.max' => 'La imagen no debe pesar más de 500kb.',
          'imagen.image' => 'La imagen debe ser jpeg, png, bmp, gif, o svg.',
      ];
    }

}
