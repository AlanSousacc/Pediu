<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\Empresa;
use Illuminate\Support\Facades\Mail;
use Image;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClienteController extends Controller
{
  private $repository;

  public function __construct(Cliente $cliente)
  {
    $this->repository = $cliente;
  }

  public function novoCliente($plano = '')
  {
    return view('pages.cliente.novoCliente', compact('plano'));
  }

  public function consultaSlug($slug)
  {
    $empresas = Empresa::where('slug', $slug)->first();

    if(!$empresas){
      return response()->json([
        'data' => [
          'message' => 'Este nome está disponível para uso!',
          'status'  => 'Disponível',
        ]
      ]);
    } else {
      return response()->json([
        'data' => [
          'message' => 'Este nome não está disponível para uso!',
          'status'  => 'Indisponível',
        ]
      ]);
    }    
  }

  public function create()
  {
    return view('pages.cliente.novoCliente');
  }

  public function store(ClienteRequest $request)
  {
    $data = $request->except('_token');
    $data['slug'] = Str::kebab($data['slug']);

    if ($request->hasFile('logo') && $request->logo->isValid()) {
      $data['logo'] = $request->logo->store("img/logos");
    } else {
      $data['logo'] = 'default.png';
    }

    $saved = $this->repository->create($data);

    if (!$saved){
      return redirect()->back()->with('error', 'Falha ao enviar formulário!');
    } else {
      Mail::send('emails.novoCliente', $data, function($message) {
        $message->to('contato@acpti.com.br')
        ->subject('Novo Formulário de Cliente Registrado ACPTI');
      });
      return redirect()->route('novo.cliente')->with('success', 'Formulário enviado com sucesso!');
    }
  }
}
