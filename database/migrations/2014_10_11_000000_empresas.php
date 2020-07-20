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
    
    protected $primaryKey = 'empresa_id';
    
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('empresa_id');
            $table->string('cnpj')->unique();
            $table->string('nome');
            $table->string('email_institucional')->unique();
            $table->string('url_site');
            $table->string('url_logotipo');
            //Informações Segurança 
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->string('usuario_id_created')->nullable();
            $table->string('usuario_id_updated')->nullable();
            $table->string('usuario_id_deleted')->nullable();
            $table->string('ind_status');
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
