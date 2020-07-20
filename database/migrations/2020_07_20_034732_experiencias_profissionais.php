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
        Schema::create('experiencias_profissionais', function (Blueprint $table) {
            $table->bigIncrements('exp_prof_id');
            $table->bigInteger('usuario_id')->unsigned();
            $table->string('cargo');
            $table->decimal('salario',4,2);
            $table->bigInteger('nivel_h_id')->unsigned();
            $table->bigInteger('area_at_id')->unsigned();
            $table->bigInteger('especializacao_id')->unsigned();
            $table->string('nome_ultimo_gestor');
            $table->string('cel_gestor');
            $table->string('resumo');
            $table->string('atividades_relevantes');
            $table->bigInteger('pais_id')->unsigned();
            $table->bigInteger('estado_id')->unsigned();
            $table->bigInteger('cidade_id')->unsigned();
            $table->date('dt_inicio');
            $table->date('dt_fim');
            $table->string('ind_atual');
            
            //Informações Segurança
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->string('usuario_id_created')->nullable();
            $table->string('usuario_id_updated')->nullable();
            $table->string('usuario_id_deleted')->nullable();
            $table->string('ind_status');
            
            //Chaves Estrangeiras
            $table->foreign('usuario_id')->references('usuario_id')->on('users');
            $table->foreign('nivel_h_id')->references('nivel_h_id')->on('niveis_hierarquicos');
            $table->foreign('area_at_id')->references('area_at_id')->on('areas_atuacao');
            $table->foreign('especializacao_id')->references('especializacao_id')->on('especializacoes');
            $table->foreign('pais_id')->references('pais_id')->on('paises');
            $table->foreign('estado_id')->references('estado_id')->on('estados');
            $table->foreign('cidade_id')->references('cidade_id')->on('cidades');
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
