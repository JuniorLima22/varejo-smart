<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
    public function rules(int $clienteId = 0): array
    {
        $rules = [
            'nome' => ['required', 'string', 'min:3', 'max:255', "unique:clientes,nome,{$clienteId},id"],
            'cpf' => ['required', 'cpf', "unique:clientes,cpf,{$clienteId},id"],
            'telefone' => ['nullable', 'celular_com_ddd', 'max:20'],
            'email' => ['required', 'email', 'min:5', "unique:clientes,email,{$clienteId},id"],
            // 'sexo' => ['required', 'in:M,F'],
            
            'cep' => ['nullable', 'formato_cep'],
            'logradouro' => ['required', 'string', 'min:3', 'max:255'],
            'numero' => ['nullable', 'string', 'min:1', 'max:20'],
            // 'bairro' => ['required', 'exists:bairros,id'],
            'cidade' => ['required', 'string', 'min:3', 'max:150'],
            'bairro' => ['required', 'string', 'min:3', 'max:150'],
            'complemento' => ['nullable', 'min:3', 'max:255'],
        ];

        return $rules;
    }
}
