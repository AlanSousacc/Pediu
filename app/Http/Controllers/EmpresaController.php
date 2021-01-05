<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Cliente;
use App\Models\Empresa;

class EmpresaController extends Controller
{
  private $repository;

  public function __construct(Empresa $empresa)
  {
    $this->repository = $empresa;
  }

  public function index()
  {
    //
  }

  public function create()
  {
    $clientes = Cliente::all();
    return view('pages.empresas.novaEmpresa', compact('clientes'));
  }

  // busca cliente cadastrado
  public function returnCliente($id)
  {
    $cliente = Cliente::where('id', $id)->get();

    return response()->json([
      "data" => $cliente
    ]);
  }

  public function store(EmpresaRequest $request)
  {
    $data = $request->except('_token');

    if(isset($request->logo)){
      $data['logo'] = $request->logo->store("img/logos");
    } else if($data['carregalogo'] != null){
      $this->repository->logo = $data['carregalogo'];
    } else {
      $data['logo'] = 'default.png';
    }

    $data['uuid'] = $this->repository->uuid = Str::uuid()->toString();

    $saved = $this->repository->create($data);

    if (!$saved){
      return redirect()->back()->with('error', 'Falha ao cadastrar Empresa!');
    } else {
      return redirect()->route('empresa.create')->with('success', 'Empresa cadastrada com Sucesso!');
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    //
  }

  public function update(Request $request, $id)
  {
    //
  }

  public function destroy($id)
  {
    //
  }
}
