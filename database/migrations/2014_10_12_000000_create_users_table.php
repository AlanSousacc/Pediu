<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->enum('profile', ['Administrador', 'Usuario', 'User Loja'])->nullable();
      $table->boolean('isAdmin')->default(0);
      $table->unsignedBigInteger('empresa_id')->unsigned();
      $table->rememberToken();
      $table->timestamps();

      $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
