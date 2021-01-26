<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Http\Requests\RequestUpdateEmpresa;
use Illuminate\Support\Str;
use App\Models\Cliente;
use App\Models\Configuracao;
use App\Models\Empresa;
use App\Models\Licenca;
use App\User;
use Illuminate\Support\Facades\Mail;

class EmpresaController extends Controller
{
  private $repository;
  private $repositoryCliente;

  public function __construct(Empresa $empresa, Cliente $cliente)
  {
    $this->repository = $empresa;
    $this->repositoryCliente = $cliente;
  }

  public function index()
  {
    $consulta = $this->repository->paginate();
    return view('pages.empresas.listagemEmpresa', compact('consulta'));
  }

  public function create()
  {
    $clientes = $this->repositoryCliente->all();
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

    if( $data['cliente_id'] == 0) {
      $data['cliente_id'] = null ;
    }

    $data['slug'] = Str::kebab($data['slug']);

    if(isset($request->logo)){
      $data['logo'] = $request->logo->store("img/logos");
    } else if($data['carregalogo'] != null){
      $data['logo'] = $data['carregalogo'];
    } else {
      $data['logo'] = 'img/logos/default.png';
    }

    $data['uuid'] = $this->repository->uuid = Str::uuid()->toString();

    // tratamento da string do cnpj para transforma-lo em senha com os 5 primeiros numeros
    $cnpj = preg_replace('/\D/', '', substr($data['cnpj'], 0, 6));

    $saved = $this->repository->create($data);

    // ao cadastrar a empresa define a configuração padrão da empresa
    $config                   = new Configuracao;
    $config->empresa_id       = $saved->id;
    $config->controlaentrega  = 1;

    $savedconfig = $config->save();
    if (!$savedconfig)
      return redirect()->back()->with('error', 'Falha ao aplicar Configurações!');


    /*
    ao criar uma nova empresa sempre é criado um novo usuário
    com o email informado no cadastro e a senha é os 5 primeiros digitos do cnpj
    */
    $user = new User;
    $user->name       = $data['nome'];
    $user->email      = $data['email'];
    $user->profile    = 'Administrador';
    $user->password   = bcrypt($cnpj);
    $user->isAdmin    = 0;
    $user->empresa_id = $saved->id;

    $sendMail = $user->email;

    $saveuser = $user->save();

    if (!$saved || !$saveuser){
      Mail::send('emails.novaEmpresaUsuario', $data, function($message) use ($sendMail){
        $message->to($sendMail)
        ->subject('Sua empresa foi registrada e geramos um login para você!');
      });

      return redirect()->back()->with('error', 'Falha ao cadastrar Empresa ou usuário');
    } else {
      return redirect()->route('empresa.create')->with('success', 'Empresa e Usuário cadastrado com Sucesso!');
    }
  }

  public function edit($uuid)
  {
    $clientes = $this->repositoryCliente->all();
    $empresa = $this->repository->where('uuid', $uuid)->first();

    return view('pages.empresas.editar', compact('empresa', 'clientes'));
  }

  public function update(RequestUpdateEmpresa $request, $uuid)
  {
    $data = $request->except('_token');

    $data['slug'] = Str::kebab($data['slug']);

    if (!$empresa = $this->repository->where('uuid', $uuid)->first())
      return redirect()->back()->with('error', 'Nenhuma Empresa encontrada');

    $licenca = Licenca::where('empresa_id', $empresa->id)->first();
    $data['active'] == 'N' ? $licenca->status = 0 : $licenca->status = 1;

    if(isset($request->logo)){
      $data['logo'] = $request->logo->store("img/logos");
    } else if($data['carregalogo'] != null){
      $data['logo'] = $data['carregalogo'];
    } else {
      $data['logo'] = 'img/logos/default.png';
    }

    $saved = $empresa->update($data);
    $licenca->save();

    if (!$saved){
      throw new Exception('Falha ao alterar Empresa!');
    }

    return redirect()->back()->with('success', 'Empresa alterada com sucesso!');
  }

  public function destroy($id)
  {
    //
  }
}
