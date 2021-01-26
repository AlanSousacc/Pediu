<?php

namespace App\Http\Middleware;

use Closure;

class CheckProfile
{
  /**
  * Handle an incoming request.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \Closure  $next
  * @return mixed
  */
  public function handle($request, Closure $next)
  {
    // Verifica se está logado, se não tiver redireciona
    if ( !auth()->check() )
    return redirect()->route('login');

    // verifica se usuário é administrador da empresa
    if ( auth()->user()->profile != 'Administrador' )
    return redirect()->route('unauthorized')->with('error', 'Este usuário não tem permissão para acessar esta página!');
    return $next($request);
  }
}
