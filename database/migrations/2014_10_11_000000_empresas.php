<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    protected $primaryKey = 'empseqempresa';
    
    public function up()
    {
        Schema::create('EMPRESAS', function (Blueprint $table) {
            $table->bigIncrements('idempresa');
            $table->string('empcnpj', 14)->unique()->sise;
            $table->string('empnome', 255);
            $table->string('empemail', 250)->unique();
            $table->string('empurlsite', 512);
            $table->string('empurllogotipo', 512);
            $table->char('empindstatus', 1);
            //Informações Segurança 
            $table->timestamp('dtcadastro')->nullable();
            $table->timestamp('dtedicao')->nullable();
            $table->timestamp('dtexclusao')->nullable();
            $table->bigInteger('usucriou')->nullable();
            $table->bigInteger('usueditou')->nullable();
            $table->bigInteger('usuexcluiu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('migrations');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('EXPERIENCIASPROFISSIONAIS');
        Schema::dropIfExists('FORMACOESACADEMICAS');
        Schema::dropIfExists('CURSOSACADEMICOS');
        Schema::dropIfExists('PAISES');
        Schema::dropIfExists('AREASATUACAO');
        Schema::dropIfExists('CIDADES');
        Schema::dropIfExists('CURSOSUSUARIO');
        Schema::dropIfExists('ESPECIALIZACOES');
        Schema::dropIfExists('ESTADOS');
        Schema::dropIfExists('IDIOMAS');
        Schema::dropIfExists('IDIOMASUSUARIO');
        Schema::dropIfExists('NIVEISESTUDO');
        Schema::dropIfExists('NIVEISHIERARQUICOS');
        Schema::dropIfExists('TIPOSHABILITACAO');
        Schema::dropIfExists('TIPOSVEICULO');
        Schema::dropIfExists('USUARIOS');
        Schema::dropIfExists('EMPRESAS');
    }
}
