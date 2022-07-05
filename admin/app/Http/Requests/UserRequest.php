<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as RulesPassword;

class UserRequest extends FormRequest
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

        $rules = [
            'name' => 'required|string|max:255',
            'rut' => ["required","string","max:13",Rule::unique('users')->ignore($this->id)] ,
            'telefono' => 'required|max:13|min:9',
            'email' => ["required","email",Rule::unique('users')->ignore($this->id)],
            'rol' => 'required',
            'estado' => 'required|'.Rule::in([1,0]),
            'password' => [],
            'password_confirmation' => [],
             
        ];
        if($this->id){
            //si se esta actualizando
            //usuario actualizado
            $user = User::findOrFail($this->id);
            $rules['rut'] = ["required","string","max:13",Rule::unique('users','rut')->ignore($user->id)];
            $rules['email'] = ["required","email",Rule::unique('users','email')->ignore($user->id)];
        }else{
            $rules['password'] = ['required', 'confirmed', 'alpha_num',RulesPassword::min(8)];
            $rules['password_confirmation'] = ['required'];
            $rules['rut'] = ["required","string","max:13",Rule::unique('users','rut')];
            $rules['email'] = ["required","email",Rule::unique('users','email')];
        }
       
      

       
        return $rules;
    }
  
    public function attributes()
    {
        return [
        'name' => 'nombre',
        'telefono' => 'teléfono',
        'password' => 'contraseña',
        'password_confirmation' => 'confirmación de contraseña'

        ];
    }
}
