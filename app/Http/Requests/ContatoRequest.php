<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
{
  public function authorize()
  {
    return auth()->check();
  }

  public function rules()
  {
    return [
      'nome'            => 'required|min:3|max:60',
      'documento'       => 'max:30',
      'telefone'        => 'required|max:20',
      'tipo'            => 'required',
    ];
  }

  public function messages()
  {
    return [
      'nome.required'     => 'O campo Nome é obrigatório!',
      'nome.min'          => 'O campo Nome deve conter ao menos 3 caracteres!',
      'nome.max'          => 'O campo Nome deve conter no máximo 60 caracteres!',
      'documento.max'     => 'O campo Documento deve conter no máximo 30 caracteres!',
      'telefone.required' => 'O campo Telefone é obrigatório!',
      'telefone.max'      => 'O campo Telefone deve conter no máximo 20 caracteres!',
      'tipo.required'     => 'O campo Tipo de contato deve ser informado',
    ];
  }
}
