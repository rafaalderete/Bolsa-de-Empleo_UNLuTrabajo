<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreEstudioAcademicoRequest extends Request
{
    const CAMPO_CARRERA;
    const CAMPO_NOMBRE_INSTITUTO;
    const CAMPO_MATERIAS_TOTAL;
    const CAMPO_MATERIAS_APROBADAS;
    const CAMPO_NIVEL_EDUCATIVO;
    const CAMPO_ESTADO_CARRERA;
    const CAMPO_PERIODO_INICIO;
    const CAMPO_PERIODO_FIN;
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
            //
        ];
    }
}
