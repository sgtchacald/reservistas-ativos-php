<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TiposHabilitacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIPOSHABILITACAO', function (Blueprint $table) {
            $table->bigIncrements('idtipohabilitacao')->unsigned();
            $table->string('habnome', 100);
            $table->char('habindstatus', 1);
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
        Schema::dropIfExists('TIPOSHABILITACAO');
    }
}
