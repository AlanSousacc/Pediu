<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();

        $this->call([ EmpresasTableSeeder::class]);
        $this->call([ UsersTableSeeder::class]);
        $this->call([ ProdutosTableSeeder::class]);
        $this->call([ ConfiguracaoTableSeeder::class]);
        $this->call([ LicencaSeed::class]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
