<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

  use RegistersUsers;

  protected $redirectTo = RouteServiceProvider::HOME;
  // protected $redirectTo = RouteServiceProvider::HOME;

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function register(Request $request)
  {
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));


    if ($response = $this->registered($request, $user)) {
      return $response;
    }

    return $request->wantsJson()
    ? new Response('', 201)
    : redirect($this->redirectPath());
  }

  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
    }

    protected function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'profile' => $data['profile'],
        'isAdmin' => isset($data['isAdmin']) ? $data['isAdmin'] : 0,
        'empresa_id' => Auth::user()->empresa_id,
        'password' => Hash::make($data['password']),
        ]);
      }
    }
