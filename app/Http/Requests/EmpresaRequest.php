<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{
  /**
  * Determine if the user is authorized to make this request.
  *
  * @return bool
  */
  public function authorize()
  {
    // if((auth()->check()) && auth()->isAdmin())
    return auth()->check();
  }

  public function rules()
  {
    $id = $this->segment(3);

    return [
      'razao'   => ['required', 'max:30'],
      'fantasia'=> ['required', 'max:30'],
      'celular' => ['required', 'max:15'],
      'nome'    => ['required', 'max:80'],
      'cidade'  => ['required', 'max:30'],
      'endereco'=> ['required', 'max:60'],
      'numero'  => ['required', 'max:5'],
      'bairro'  => ['required', 'max:65'],
      'cnpj'    => ['required', 'max:20', "unique:empresas,cnpj,{$id},id"],
      'email'   => ['required', 'email', "unique:empresas,email,{$id},id"],
      'slug'    => ['required', 'max:30', "unique:empresas,slug,{$id},id"],
      'logo'    => ['image'],
      'plano'   => ['required']
    ];
  }

  public function messages()
  {
    return [
      'razao.required'    => 'O campo Razão Social é obrigatório!',
      'razao.min'         => 'O campo Razão Social deve conter no máximo 30 caracteres!',
      'fantasia.required' => 'O campo Fantasia deve ser informado!',
      'fantasia.max'      => 'O campo Fantasia deve conter no máximo 30 caracteres!',
      'celular.required'  => 'O campo Celular de contato deve ser informado!',
      'celular.max'       => 'O campo Celular deve conter no máximo 15 caracteres!',
      'nome.required'     => 'O campo Nome é obrigatório!',
      'nome.max'          => 'O campo Nome deve conter no máximo 80 caracteres!',
      'cidade.required'   => 'O campo Cidade é obrigatório!',
      'cidade.max'        => 'O campo Cidade deve conter no máximo 30 caracteres!',
      'endereco.required' => 'O campo Endereço é obrigatório!',
      'endereco.max'      => 'O campo Endereço deve conter no máximo 60 caracteres!',
      'numero.required'   => 'O campo Número deve ser informado!',
      'numero.max'        => 'O campo Endereço deve conter no máximo 5 caracteres!',
      'bairro.required'   => 'O campo Bairro deve ser informado!',
      'bairro.max'        => 'O campo Bairro deve conter no máximo 65 caracteres!',
      'cnpj.required'     => 'O campo CNPJ deve ser informado!',
      'cnpj.max'          => 'O campo CNPJ deve conter no máximo 20 caracteres!',
      'email.required'    => 'O campo Email é obrigatório!',
      'slug.required'     => 'O campo Nome da loja deve ser informado!',
      'slug.max'          => 'O campo Nome da loja deve conter no máximo 30 caracteres!',
      'plano.required'    => 'O campo Plano do cliente deve ser informado!',
    ];
  }
}
