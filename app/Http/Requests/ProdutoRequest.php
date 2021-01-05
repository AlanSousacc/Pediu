<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
  public function authorize()
  {
    return auth()->check();
  }
  
  public function rules()
  {
    return [
      'descricao'   => 'required|max:50',
      'composicao'  => 'required',
      'tipo'        => 'required',
      'precovenda'  => 'required',
      'status'      => 'required',
    ];
  }

  public function messages()
  {
    return [
      'descricao.required'  => 'O campo Descrição do Produto é obrigatório!',
      'descricao.max'       => 'O campo Descrição deve conter no máximo 50 caracteres!',
      'composicao.required' => 'O campo Composição é obrigatório!',
      'tipo.required'       => 'O campo Tipo do produto é obrigatório!',
      'precovenda.required' => 'O campo Preço de Venda é obrigatório!',
      'status.required'     => 'O campo Status obrigatório!',
    ];
  }
}
