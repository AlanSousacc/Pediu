<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    User::create ([
      'name'        => 'Alan Wilian de Sousa',
      'email'       => 'alansousa.cc@gmail.com',
      'empresa_id'  => '1',
      'isAdmin'     => '1',
      'profile'     => 'Administrador',
      'password'    => bcrypt('14789635sousa'),
    ]);
    User::create ([
      'name'        => 'Daniel Takegava',
      'email'       => 'takegavadaniel@gmail.com',
      'empresa_id'  => '1',
      'isAdmin'     => '1',
      'profile'     => 'Administrador',
      'password'    => bcrypt('321321321'),
    ]);

  }
}
