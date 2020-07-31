<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExperienciasProfissionais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EXPERIENCIASPROFISSIONAIS', function (Blueprint $table) {
            $table->bigIncrements('idexperienciaprof');
            $table->bigInteger('idusuario')->unsigned();
            $table->string('expscargo', 100);
            $table->decimal('expssalario',4,2);
            $table->bigInteger('idnivelhierarquico')->unsigned();
            $table->bigInteger('idareaatuacao')->unsigned();
            $table->bigInteger('idespecializacao')->unsigned();
            $table->string('expnomeultimogestor', 10);
            $table->string('expcelgestor', 20);
            $table->string('expresumo', 512);
            $table->string('expatividadesrelevantes', 512);
            $table->bigInteger('idpais')->unsigned();
            $table->bigInteger('idestado')->unsigned();
            $table->bigInteger('idcidade')->unsigned();
            $table->date('expdtinicio');
            $table->date('expdtfim');
            $table->char('expindatual', 1);
            
            //Informações Segurança 
            $table->timestamps();
            $table->timestamp('dtinativacao')->nullable();
            $table->bigInteger('usucriou')->nullable();
            $table->bigInteger('usueditou')->nullable();
            $table->bigInteger('usuexcluiu')->nullable();
            $table->char('expindstatus', 1);
            
            //Chaves Estrangeiras
            $table->foreign('idusuario')->references('idusuario')->on('USUARIOS');
            $table->foreign('idnivelhierarquico')->references('idnivelhierarquico')->on('NIVEISHIERARQUICOS');
            $table->foreign('idareaatuacao')->references('idareaatuacao')->on('AREASATUACAO');
            $table->foreign('idespecializacao')->references('idespecializacao')->on('ESPECIALIZACOES');
            $table->foreign('idpais')->references('idpais')->on('PAISES');
            $table->foreign('idestado')->references('idestado')->on('ESTADOS');
            $table->foreign('idcidade')->references('idcidade')->on('CIDADES');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('EXPERIENCIASPROFISSIONAIS');
    }
}
