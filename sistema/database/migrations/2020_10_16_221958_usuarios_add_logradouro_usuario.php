<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuariosAddLogradouroUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('USUARIOS', function($table){
            //Localização Geográfica
            $table->bigInteger('idlogradouro')->unsigned()->nullable();
            $table->foreign('idlogradouro')->references('idlogradouro')->on('LOGRADOUROS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
