<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IdiomasUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idiomas_usuario', function (Blueprint $table) {
            $table->bigIncrements('idiomas_u_id');
            $table->bigInteger('usuario_id')->unsigned();
            $table->string('nivel');
            //Informações Segurança
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->string('usuario_id_created')->nullable();
            $table->string('usuario_id_updated')->nullable();
            $table->string('usuario_id_deleted')->nullable();
            $table->string('ind_status');
            $table->foreign('usuario_id')->references('usuario_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idiomas_usuario');
    }
}
