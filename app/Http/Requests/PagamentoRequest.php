<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagamentoRequest extends FormRequest
{
  public function authorize()
  {
    return auth()->check();
  }
  
  public function rules()
  {
    return [
      //
    ];
  }
}
