<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessController extends Controller
{
  // Apresenta tela de acesso negado ao usuário que tentar acessar rotas não permitidas
  public function index()
  {
    return view('layouts.unauthorized-access');
	}

  public function verificaLicenca()
  {
    return view('layouts.unauthorized-license');
  }
}
