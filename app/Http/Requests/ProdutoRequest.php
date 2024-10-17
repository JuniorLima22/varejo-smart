<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
    public function rules(int $produtoId = 0): array
    {
        $rules = [
            'nome' => ['required', 'string', 'min:3', 'max:255', "unique:produtos,nome,{$produtoId},id"],
            'descricao' => ['nullable', 'string', 'min:3', 'max:65535'],
            'preco_compra' => ['required', 'min:0', 'decimal:0,2'],
            'preco_venda' => ['required', 'min:0', 'decimal:0,2'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'quantidade' => ['required', 'integer', 'min:0'],
            'imagem_url' => ['nullable', 'string', 'min:3', 'max:255'],
            'imagem_temporario' => ['nullable', 'image', 'mimes:png,jpg,webp', 'max:2048'],  // 2MB Max
        ];

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'categoria_id'=> 'categoria',
            'imagem_url'=> 'imagem',
        ];
    }
}
