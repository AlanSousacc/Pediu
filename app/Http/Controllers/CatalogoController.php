<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Grupo;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class CatalogoController extends Controller
{
  public function index($slug)
  {
    $empresa  = Empresa::where('slug', $slug)->first();
    $produtos = Produto::where('empresa_id', $empresa->id)->where('status', 1)->get();
    $grupos   = Grupo::where('empresa_id', Auth::user()->empresa_id)->get();

    return view('pages.catalogo.index', compact('produtos', 'empresa', 'grupos'));
  }
}
