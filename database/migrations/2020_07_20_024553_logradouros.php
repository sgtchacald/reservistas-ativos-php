<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Logradouros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LOGRADOUROS', function (Blueprint $table) {
            $table->bigIncrements('idlogradouro')->unsigned();
            $table->string('logcep', 60);
            $table->string('logtipo', 60);
            $table->string('lognome', 60);
            $table->integer('idcidade');
            //$table->integer('idestado');
            $table->string('uf', 2);
            $table->string('logcomplemento', 100);
            $table->string('lognomesemnr', 100);
            $table->string('lognomecid', 100);
            $table->integer('idibgecidade');
            $table->string('lognomebairro', 100);
            $table->char('logindstatus', 1);
            $table->char('logindorigemcad', 1);
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
    public function down()
    {
        Schema::dropIfExists('PAISES');
    }
}
