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
        Schema::create('tipos_veiculo', function (Blueprint $table) {
            $table->bigIncrements('tipos_v_id');
            $table->string('nome', 100);
            //Informações Segurança
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('usuario_id_created')->nullable();
            $table->bigInteger('usuario_id_updated')->nullable();
            $table->bigInteger('usuario_id_deleted')->nullable();
            $table->char('ind_status', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_veiculo');
    }
}