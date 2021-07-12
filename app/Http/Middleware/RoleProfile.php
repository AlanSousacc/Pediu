<?php

namespace App\Http\Middleware;

use Closure;

class RoleProfile
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
    if (auth()->user()->profile != 'Administrador' && auth()->user()->profile != 'Usuario')
    return redirect('/'. auth()->user()->empresa->slug);

    return $next($request);
  }
}
