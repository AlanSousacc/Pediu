<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoRequest extends FormRequest
{
  public function authorize()
  {
    return auth()->check();
  }
  
  public function rules()
  {
    return [
      'endereco' => 'required|max:50',
      'numero'   => 'required|max:5',
      'cidade'   => 'required|max:30',
      'bairro'   => 'required|max:20',
      'telefone' => 'max:20',
      'cep'      => 'max:20',
      'status'   => 'required',
    ];
  }

  public function messages()
  {
    return [
      'endereco.required' => 'O campo Endereço é obrigatório!',
      'endereco.max'      => 'O campo Endereço deve conter no máximo 30 caracteres!',
      'numero.required'   => 'O campo Número é obrigatório',
      'numero.max'        => 'O campo Número deve conter no máximo 5 caracteres!',
      'cidade.required'   => 'O campo Cidade é obrigatório!',
      'cidade.max'        => 'O campo Cidade deve conter no máximo 30 caracteres!',
      'bairro.required'   => 'O campo Bairro é obrigatório!',
      'bairro.max'        => 'O campo Bairro deve conter no máximo 20 caracteres!',
      'cep.max'           => 'O campo CEP deve conter no máximo 15 caracteres!',
      'status.required'   => 'O campo Status obrigatório!',
      'telefone.max'      => 'O campo Telefone deve conter no máximo 20 caracteres!',
    ];
  }
}
