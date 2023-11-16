<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $clientId = $this->route('id');

        return [
            'nome' => 'sometimes|required|string',
            'sobrenome' => 'sometimes|required|string',
            'dataNascimento' => 'sometimes|required|date',
            'email' => 'sometimes|required|email',
            'genero' => 'sometimes|required|string',
            'cpf' => [
                'sometimes',
                'required',
                Rule::unique('tb_client', 'cpf')->ignore($clientId),
            ],
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
