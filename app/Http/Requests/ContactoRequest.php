<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactoRequest extends FormRequest
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
            'nombre' => ['required','string','max:250'],
            'asunto' => ['required','string','max:250'],
            'email' =>['required','string','max:250'],
            'telefono' =>['required','string','max:250'],
            'mensaje' => ['required','string','max:250'],
            'documento' => ['mimes:docx,pdf,doc,xls,xlsx'],
            'comuna' => ['required','different:0'],
            'region' => ['required'],
            'direccion' => ['required']
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'Nombre',
            'asunto' => 'Asunto',
            'email' => 'Email',
            'telefono' => 'Teléfono',
            'mensaje' => 'Mensaje',
            'documento' => 'Documento',
            'comuna' => 'Comuna',
            'region' => 'Región',
            'direccion' => 'Dirección'
        ];
    }
    
}
