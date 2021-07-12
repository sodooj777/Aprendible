<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ // el metodo up se utiliza para agregar tablas columnas o index a la base de datos
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); //entero grande autoincrementable   o podemos colocar otro tipo de dato bigInteger
            $table->string('name');     //se puede agregar campos de tipo string como varchar  para almacenar el nombre del usuario 
            $table->string('email')->unique(); //aqui agregamos un inde unique() para que no pueda existir en la base de datos dos usuarios con el mismo email
            $table->timestamp('email_verified_at')->nullable(); //timestamp fecha y hora  para almacenar la fecha de cuando el usuario confirmo  su email y en este caso le decimos que permita el valor nulo con nullable() ya que este campo se le llenaria despues de haber creado el usuario  por eso este valor deber permanecer nulo hasta que el usuario verfique su emal
            $table->string('password');
            $table->rememberToken(); //laravel utiliza para recordar la session al usuario cuando hacemos un login  por lo general provee un chexbox con la palabra recuerdame  o guardar contraseña para mantener la seccion abierta y genera el toque y laravel lo utiliza para recordar al usuario
            $table->timestamps(); // es para almacenar la fecha y hora que se creo el usuario
        });  //una ves terminada las migraciones debemos ejecutarlas
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
