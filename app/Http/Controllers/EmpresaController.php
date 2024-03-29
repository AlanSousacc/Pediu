<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Http\Requests\RequestUpdateEmpresa;
use Illuminate\Support\Str;
use App\Models\{Cliente, Configuracao, Empresa, EnderecoUsers, FormaPagamento, Licenca};
use App\User;
use Illuminate\Support\Facades\Mail;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\EmpresaCreate;
use Exception;

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
    $empresas = $this->repository->all();
    return view('pages.empresas.novaEmpresa', compact('clientes', 'empresas'));
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
    try {
      DB::beginTransaction();

      $data = $request->except('_token');
      $data['slug'] = Str::kebab($data['slug']);

      if( $data['cliente_id'] == 0) {
        $data['cliente_id'] = null ;
      }

      if(isset($request->logo)){
        $data['logo'] = $request->logo->store("img/".Auth::user()->empresa->slug. "/logo");
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

      // ao cadastrar empresa define automáticamente as formas de pagamentos disponíveis no sistema
      EmpresaCreate::criaFormaPagamento($saved->id);
              
       /*
      ao criar uma nova empresa sempre é criado um novo usuário
      com o email informado no cadastro e a senha é os 5 primeiros digitos do cnpj
      */
      $user = new User();
      $user->name       = $data['nome'];
      $user->email      = $data['email'];
      $user->profile    = 'Administrador';
      $user->password   = bcrypt($cnpj);
      $user->isAdmin    = 0;
      $user->empresa_id = $saved->id;

      $sendMail = $user->email;

      $saveuser = $user->save();

      $endereco = new EnderecoUsers();
      $endereco->cidade     = $data['cidade'];
      $endereco->endereco   = $data['endereco'];
      $endereco->numero     = $data['numero'];
      $endereco->bairro     = $data['bairro'];
      $endereco->telefone   = $data['telefone'];
      $endereco->principal  = 1;
      $endereco->user_id    = $user->id;
      $endereco->empresa_id = $user->empresa->id;

      $saveendereco = $endereco->save();
      if (!$saveendereco)
        return redirect()->back()->with('error', 'Falha ao aplicar o endereço deste usuário da nova empresa!');

      if ($saved || $saveuser){
        Mail::send('emails.novaEmpresaUsuario', $data, function($message) use ($sendMail){
          $message->to($sendMail)
          ->subject('Sua empresa foi registrada e geramos um login para você!');
        });

        DB::commit();
        return redirect()->route('empresa.create')->with('success', 'Empresa e Usuário cadastrado com Sucesso!');
      }

    } catch (Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('error', $e->getMessage());
      exit();
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
      $data['logo'] = $request->logo->store("img/".Auth::user()->empresa->slug. "/logo");
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
}
