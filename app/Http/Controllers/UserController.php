<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\EnderecoUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Auth;
use App\User;
use Exception;

class UserController extends Controller
{
  public function index(User $model)
  {
    if(Auth::user()->empresa_id == 1){
      $consulta = $model::paginate(10);
    } else {
      $consulta = $model::where('empresa_id', Auth::user()->empresa_id)->paginate(10);
    }

    return view('users.index', compact('consulta'));
  }

  public function edit($id)
	{
    $user = User::find($id);
    $endereco = EnderecoUsers::where('user_id', $id)->first();

		return view('users.editar', compact('user', 'endereco'));
  }

  public function update(Request $request){
    $data = $request->except('_token');

    try{
      $user     = User::find($data['user_id']);
      $endereco = EnderecoUsers::where('user_id', $data['user_id'])->where('principal', 1)->first();

      if (!$user)
        throw new Exception("Nenhum usuário encontrado");
      
      if (!$endereco)
        throw new Exception("Endereço de usuário foi encontrado");

      // aqui então faz todo o tratamento e seta o que foi alterado;
      $endereco->endereco = $data['endereco'];
      $endereco->cidade   = $data['cidade'];
      $endereco->telefone = $data['telefone'];
      $endereco->bairro   = $data['bairro'];
      $endereco->numero   = $data['numero'];

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    // aqui inicia a gravação no bd
    try{
      DB::beginTransaction();

      $saveduser     = $user->save();
      $savedendereco = $endereco->save();

      if (!$saveduser && !$savedendereco){
        throw new Exception('Falha ao salvar usuário!');
      }
      DB::commit();
      return redirect()->back()->with('success', 'Usuário #' . $user->id . ' alterado com sucesso.');

    } catch (Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try{
			$user = User::find($request->user_id);

      if ($user->id == auth()->user()->id)
        throw new Exception("Não é possível remover um usuário que esté logado!");

      if (!$user)
        throw new Exception("Nenhum Usuário encontrado!");

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    try{
      DB::beginTransaction();

      $saved = $user->delete();

      if (!$saved){
        throw new Exception('Falha ao remover este Usuário!');
      }
      DB::commit();
      // se chegou aqui é pq deu tudo certo
      return redirect()->back()->with('success', 'Usuário #' . $user->id . ' removido com sucesso!');
    } catch (Exception $e) {
			DB::rollBack();

      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
