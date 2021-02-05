<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CursosUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CURSOS_QUALIFICACOES_USUARIO', function (Blueprint $table) {
            $table->bigIncrements('idcursoqualiusuario')->unsigned();
            $table->bigInteger('idusuario')->unsigned();
            $table->string('cqunome', 100);
            $table->string('cqunivel', 1);
            $table->string('cquinstituicaoensino', 100);
            $table->integer('cquqtdhoras');
            $table->string('cquurlcertificado', 2048);
            $table->string('cqutipocursoqualificacao', 1);
            //Informações Segurança
            $table->timestamp('dtcadastro')->nullable();
            $table->timestamp('dtedicao')->nullable();
            $table->timestamp('dtexclusao')->nullable();
            $table->bigInteger('usucriou')->nullable();
            $table->bigInteger('usueditou')->nullable();
            $table->bigInteger('usuexcluiu')->nullable();
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
        Schema::dropIfExists('CURSOSUSUARIO');
    }
}
