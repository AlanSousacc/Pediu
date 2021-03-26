<?php

use App\Models\Licenca;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LicencaSeed extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    Licenca::truncate();

    Licenca::create([
      'dtinicio'    => Carbon::now()->format('Y-m-d'),
      'dtvalidade'  => Carbon::now()->add(30, 'days'),
      'status'      => 1,
      'empresa_id'  => 1,
      ]);
  }
}
