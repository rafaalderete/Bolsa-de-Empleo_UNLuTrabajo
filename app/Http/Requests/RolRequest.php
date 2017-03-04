<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RolRequest extends Request
{
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
            'name' => 'min:4|max:20|required',
            'nombre_amigable_rol' => 'min:4|max:20|required'
        ];
    }
}
