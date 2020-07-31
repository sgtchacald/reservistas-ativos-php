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
        Schema::create('CURSOSUSUARIO', function (Blueprint $table) {
            $table->bigIncrements('idcursousuario');
            $table->bigInteger('idusuario')->unsigned();
            $table->string('csunome', 100);
            $table->string('csuinstituicaoensino', 100);
            $table->date('csudtinicio');
            $table->date('csudtfim');
            $table->string('csuurlcertificado', 512);
            //Informações Segurança 
            $table->timestamps();
            $table->timestamp('dtinativacao')->nullable();
            $table->bigInteger('usucriou')->nullable();
            $table->bigInteger('usueditou')->nullable();
            $table->bigInteger('usuexcluiu')->nullable();
            $table->char('csuindstatus', 1);
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
