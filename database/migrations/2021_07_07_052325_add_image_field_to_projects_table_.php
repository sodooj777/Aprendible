<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageFieldToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            /*aqui agregamos simplemente in campo string llamado image y que sea nullable 
             que los proyectos que ya existe en la base de datos tengan el valor null en el campo image */
             //after('id') va agregar el campo image depues del campo id
            $table->string('image')->after('id')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // quitamos la commluna image
             $table->dropColumn('image');
        });
    }
}
