<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TiposVeiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIPOSVEICULO', function (Blueprint $table) {
            $table->bigIncrements('idtipoveiculo');
            $table->string('tvenome', 100);
            //Informações Segurança 
            $table->timestamps();
            $table->timestamp('dtinativacao')->nullable();
            $table->bigInteger('usucriou')->nullable();
            $table->bigInteger('usueditou')->nullable();
            $table->bigInteger('usuexcluiu')->nullable();
            $table->char('tveindstatus', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TIPOSVEICULO');
    }
}