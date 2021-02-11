<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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
		return view('users.editar', compact('user'));
  }

  public function update(Request $request){
    $data = $request->except('_token');

    try{
      $user = User::find($data['user_id']);

      if (!$user)
      throw new Exception("Nenhum usuário encontrado");

      // aqui então faz todo o tratamento e seta o que foi alterado;
      $user->name     = $data['name'];
      $user->email    = $data['email'];
      $user->telefone = $data['telefone'];
      $user->password = bcrypt($data['password']);

    } catch (Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
      exit();
    }

    // aqui inicia a gravação no bd
    try{
      DB::beginTransaction();

      $saved = $user->save();
      if (!$saved){
        throw new Exception('Falha ao salvar usuário!');
      }
      DB::commit();
      // se chegou aqui é pq deu tudo certo
      return redirect()->back()->with('success', 'Usuário #' . $user->id . ' alterado com sucesso.');
    } catch (Exception $e) {
      // se deu pau ao salvar no banco de dados, faz rollback de tudo e retorna erro
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
