<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  use AuthenticatesUsers;

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  protected function authenticated()
  {
    if ( auth()->user()->profile == 'Administrador') {
      return redirect()->route('home');
    } else if( auth()->user()->profile == 'Usuario'){
      return redirect()->route('home');
    } else {
      return redirect('/'. auth()->user()->empresa->slug);
    }

    return redirect('/');
  }

  public function logout() {
    $slug = auth()->user()->empresa->slug;

    if ( auth()->user()->profile == 'Administrador') {
      Auth::logout();
      return redirect('/login');
    } else if( auth()->user()->profile == 'Usuario'){
      Auth::logout();
      return redirect('/login');
    } else {
      Auth::logout();
      return redirect('/'. $slug);
    }
  }
}
