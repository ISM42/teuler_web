<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Registro_usuario extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|max:100',
            'ap' => 'required|max:100',
            'am' => 'required|max:100',
            'aa' => 'required',
            'rol' => 'required',
            'email' => 'required|email|max:250',
            'password1' => 'required|min:8',
            'password_2' => 'required|min:8',
            
        ];
       // $this->addConditionalRules($rules, 'matricula', 'grupo', 'escuela');
        
        return $rules;
    }

 /*    protected function addConditionalRules(&$rules, $matric, $grp, $escuela)
    {
        if ($this->filled($matric) || $this->filled($grp) || $this->filled($escuela)) {
            $rules[$matric] = 'required';
            $rules[$grp] = 'required';
            $rules[$escuela] = 'required';
           
        }
    } */

    public function attributes(): array
    {
        return [
            'name' => 'Nombre',
            'ap' => 'Apellido paterno',
            'am' => 'Apellido materno',
            'aa' => 'Área de adscripción',
            'rol' => 'Rol',
            'email' => 'Correo electrónico',
            'password' => 'Contraseña',
            'password_2' => 'Confirmar contraseña',
            
        ];
    }
}
