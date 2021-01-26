<?php

namespace App\Http\Middleware;

use App\Models\Licenca;
use Carbon\Carbon;
use Closure;

class CheckLicense
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
    $dt			 = Carbon::now();
    $licenca = Licenca::where('empresa_id', auth()->user()->empresa_id)
              ->where('status', 1)
              ->where('dtinicio', '<=', $dt->toDateString())
              ->where('dtvalidade', '>=', $dt->toDateString())
              ->first();

    if(!$licenca)
    return redirect()->route('unauthorized-license')->with('error', 'Esta empresa encontra-se com a licença expirada, ou inativa!');

    return $next($request);
  }
}
