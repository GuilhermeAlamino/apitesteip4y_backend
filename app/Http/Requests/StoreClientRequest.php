<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string',
            'sobrenome' => 'required|string',
            'dataNascimento' => 'required|date',
            'email' => 'required|email',
            'genero' => 'required|string',
            'cpf' => 'required|unique:tb_client,cpf',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.string' => 'O campo Nome deve ser uma string.',
            'sobrenome.required' => 'O campo Sobrenome é obrigatório.',
            'sobrenome.string' => 'O campo Sobrenome deve ser uma string.',
            'dataNascimento.required' => 'O campo Data de Nascimento é obrigatório.',
            'dataNascimento.date' => 'O campo Data de Nascimento deve ser uma data válida.',
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'O campo Email deve ser um endereço de e-mail válido.',
            'genero.required' => 'O campo Gênero é obrigatório.',
            'genero.string' => 'O campo Gênero deve ser uma string.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'O CPF já está em uso.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 500)
        );
    }
}
