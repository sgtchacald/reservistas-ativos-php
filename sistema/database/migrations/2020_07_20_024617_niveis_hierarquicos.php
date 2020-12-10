<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NiveisHierarquicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NIVEISHIERARQUICOS', function (Blueprint $table) {
            $table->bigIncrements('idnivelhierarquico')->unsigned();
            $table->string('nihnome', 100);
            $table->char('nihindstatus', 1);
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
        Schema::dropIfExists('NIVEISHIERARQUICOS');
    }
}