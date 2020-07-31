<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IdiomasUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IDIOMASUSUARIO', function (Blueprint $table) {
            $table->bigIncrements('ididiomausuario');
            $table->bigInteger('idusuario')->unsigned();
            $table->char('idusunivel', 1);
            //Informações Segurança 
            $table->timestamps();
            $table->timestamp('dtinativacao')->nullable();
            $table->bigInteger('usucriou')->nullable();
            $table->bigInteger('usueditou')->nullable();
            $table->bigInteger('usuexcluiu')->nullable();
            $table->char('idusuindstatus', 1);
            $table->foreign('idusuario')->references('idusuario')->on('USUARIOS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('IDIOMASUSUARIO');
    }
}
