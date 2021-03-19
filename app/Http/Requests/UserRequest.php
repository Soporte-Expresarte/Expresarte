<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $method = $this->method();

        switch ($method) {
            case "POST":
                return [
                    'email' => 'email:rfc,dns|required|max:255|unique:users,email',
                    'apodo' => 'required|unique:users,apodo',
                    'password' => 'required|min:8|max:255|confirmed',
                    // TODO: importar cl_rut
                    //'rut' => 'required|cl_rut|min:8|max:9|unique:personas,rut',
                    'rut' => 'required|min:9|max:10|unique:users,rut',
                    'name' => 'required|min:3|max:255',
                    'apellido' => 'required|min:3|max:255',
                    'telefono' => 'max:50',
                    'fecha_nacimiento' => 'before_or_equal:today',
                    /**
                     * TODO: Ver bien estas fk's.
                     * 'carro_id' => 'required',
                     * 'perfil_id' => 'required',
                    */
                ];
            case "PATCH":
                return [
                    'email' => 'email:rfc,dns|required|max:255|unique:users,email,' . $this->id,
                    'apodo' => 'required|unique:users,apodo' . $this->id,
                    'password' => 'required|min:8|max:255|confirmed',
                    // TODO: importar cl_rut
                    //'rut' => 'required|cl_rut|min:8|max:9|unique:personas,rut',
                    'rut' => 'required|min:8|max:9|unique:users,rut' . $this->id,
                    'name' => 'required|min:3|max:255',
                    'apellido' => 'required|min:3|max:255',
                    'telefono' => 'max:50',
                    'fecha_nacimiento' => 'before_or_equal:today',
                    /** TODO
                     * 'carro_id' => 'required',
                     * 'perfil_id' => 'required',
                    */
                ];
        }

        return [];
    }
}
