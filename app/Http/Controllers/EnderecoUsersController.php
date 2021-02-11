<?php

namespace App\Http\Controllers;

use App\Models\EnderecoUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnderecoUsersController extends Controller
{
  protected $endereco;
  public function __construct(EnderecoUsers $endereco)
  {
    $this->endereco = $endereco;
  }

  public function create()
  {
    return view('users.address.modalCreateAddress');
  }

  public function store(Request $request)
  {
    $data               = $request->except('_token');
    $principal          = EnderecoUsers::where('user_id', Auth::user()->id)->get();
    $data['empresa_id'] = Auth::user()->empresa_id;
    $data['user_id']    = Auth::user()->id;
    $data['principal']  = isset($data['principal']) && $data['principal'] == 'on' ? 1 : 0;
    count($principal) <= 0 ? $data['principal'] = 1 : $data['principal'] = 0;

    $endereco = $this->endereco->create($data);

    $saved = $endereco->save();

    if (!$saved)
    return redirect()->back()->with('error', 'Falha ao salvar este Endereco!');

    return redirect()->back()->with('success', 'Endereço criado com sucesso!');
  }

  public function destroy(Request $request)
  {
    $endereco = $this->endereco->find($request->address_id);

    if ($endereco->principal == 1)
      return redirect()->back()->with('error', "Este endereço é o principal, defina outro endereço como principal antes de remover este!");

    if (!$endereco)
      return redirect()->back()->with('error', "Nenhum Endereço encontrado!");

    $saved = $endereco->delete();

    if (!$saved)
      return redirect()->back()->with('error', 'Falha ao remover este Endereço!');

    return redirect()->back()->with('success', 'Endereço #' . $endereco->id . ' removido com sucesso!');
  }
}
