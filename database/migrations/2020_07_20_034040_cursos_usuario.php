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
        Schema::create('cursos_usuario', function (Blueprint $table) {
            $table->bigIncrements('cursos_u_id');
            $table->bigInteger('usuario_id')->unsigned();
            $table->string('nome', 100);
            $table->string('instituicao_ensino', 100);
            $table->date('dt_inicio');
            $table->date('dt_fim');
            $table->string('url_certificado', 512);
            //Informações Segurança
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('usuario_id_created')->nullable();
            $table->bigInteger('usuario_id_updated')->nullable();
            $table->bigInteger('usuario_id_deleted')->nullable();
            $table->char('ind_status', 1);
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos_usuario');
    }
}