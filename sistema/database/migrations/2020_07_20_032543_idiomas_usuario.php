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
        Schema::create('IDIOMAS_USUARIO', function (Blueprint $table) {
            $table->bigIncrements('ididiomausuario')->unsigned();
            $table->bigInteger('idusuario')->unsigned();
            $table->bigInteger('ididioma')->unsigned();
            $table->char('idusunivelidioma', 1);
            $table->char('idusuindstatus', 1);
            //Informações Segurança
            $table->timestamp('dtcadastro')->nullable();
            $table->timestamp('dtedicao')->nullable();
            $table->timestamp('dtexclusao')->nullable();
            $table->bigInteger('usucriou')->nullable();
            $table->bigInteger('usueditou')->nullable();
            $table->bigInteger('usuexcluiu')->nullable();
            $table->foreign('idusuario')->references('idusuario')->on('USUARIOS');
            $table->foreign('ididioma')->references('ididioma')->on('IDIOMAS');
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
