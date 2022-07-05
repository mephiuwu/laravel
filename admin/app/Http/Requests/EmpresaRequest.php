<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmpresaRequest extends FormRequest
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
            'razon_social' => ['required', 'string', 'max:255'],
            'email_empresarial' => ['required', 'email', 'string', 'max:255'],
            'email_contacto' => ['required', 'email', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:13', 'min:9'],
          /*   'logo' => ['image', 'max:2048', 'mimes:jpeg,png,jpg,gif,svg'], */
            'facebook_url' => ['required', 'string', 'max:255'],
            'twitter_url' => ['required', 'string', 'max:255'],
            'instagram_url' => ['required', 'string', 'max:255'],
            'youtube_url' => ['required', 'string', 'max:255'],
            'coords_map_lat' => ['required', 'string', 'max:255'],
            'coords_map_lng' => ['required', 'string', 'max:255'],
            'meta_title' => ['required', 'string'],
            'meta_keywords' => ['required', 'string'],
            'meta_description' => ['required', 'string'],
            'analytics' => ['required', 'string']

        ];
     
    }

    public function messages(){
        return [];
    }

    public function attributes()
    {
        return [
            'razon_social' => 'Razón Social',
            'email_empresarial' => 'Email Empresarial',
            'email_contacto' => 'Email de contacto',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
            'logo' => 'logo',
            'facebook_url' => 'Página de Facebook',
            'twitter_url' => 'Página de Twitter',
            'instagram_url' => 'Página de Instagram',
            'youtube_url' => 'Canal de Youtube',
            'coords_map_lat' => 'Latitud',
            'coords_map_lng' => 'Longitud',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'analytics' => 'Google Analytics',

        ];
    }

}
