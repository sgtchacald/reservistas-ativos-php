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
            $table->string('empemail', 255)->unique();
            $table->string('empurlsite', 512);
            $table->string('empurllogotipo', 512);
            //Informações Segurança 
            $table->timestamps();
            $table->timestamp('dtinativacao')->nullable();
            $table->bigInteger('usucriou')->nullable();
            $table->bigInteger('usueditou')->nullable();
            $table->bigInteger('usuexcluiu')->nullable();
            $table->char('empindstatus', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
