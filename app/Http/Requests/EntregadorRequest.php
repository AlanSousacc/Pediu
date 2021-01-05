<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntregadorRequest extends FormRequest
{
  public function authorize()
  {
    return auth()->check();
  }
  
  public function rules()
  {
    return [
      'nome'     => 'required|min:3|max:60',
      'endereco' => 'max:50',
      'numero'   => 'max:5',
      'cidade'   => 'max:30',
      'bairro'   => 'max:20',
      'telefone' => 'required|max:20',
      'cep'      => 'max:15',
      'veiculo'  => 'required',
      'placa'    => 'max:15',
      'status'   => 'required'
    ];
  }

  public function messages()
  {
    return [
      'nome.required'     => 'O campo Nome é obrigatório!',
      'nome.min'          => 'O campo Nome deve conter ao menos 3 caracteres!',
      'nome.max'          => 'O campo Nome deve conter no máximo 60 caracteres!',
      'endereco.max'      => 'O campo Endereço deve conter no máximo 50 caracteres!',
      'numero.max'        => 'O campo Número deve conter no máximo 5 caracteres!',
      'cidade.max'        => 'O campo Cidade deve conter no máximo 30 caracteres!',
      'bairro.max'        => 'O campo Bairro deve conter no máximo 20 caracteres!',
      'cep.max'           => 'O campo CEP deve conter no máximo 15 caracteres!',
      'placa.max'         => 'O campo Placa deve conter no máximo 15 caracteres!',
      'status.required'   => 'O campo Status obrigatório!',
      'veiculo.required'  => 'O campo Veículo obrigatório!',
      'telefone.required' => 'O campo Telefone obrigatório!',
      'telefone.max'      => 'O campo Telefone deve conter no máximo 20 caracteres!',
    ];
  }
}
