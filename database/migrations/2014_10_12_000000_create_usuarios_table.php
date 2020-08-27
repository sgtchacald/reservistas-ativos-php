<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $incrementing = false;
    
    public function up()
    {
        Schema::create('USUARIOS', function (Blueprint $table) {
            //Informações Pessoais
            $table->bigIncrements('idusuario');
            $table->bigInteger('idempresa')->unsigned()->nullable();
            $table->char('usupermissao', 1);
            $table->string('name', 100);
            $table->string('usucpf', 11);
            $table->date('usudtnascimento');
            $table->char('usuestadocivil', 2);
            $table->char('usugenero', 1);
            $table->char('usuindportdeficiente', 1);
            $table->string('email',100)->unique();
            $table->string('usutelcelular', 20);
            $table->string('usutelfixo', 20);
            $table->char('usuindviagem', 1);
            $table->char('usuindmudarcidade', 1);
            $table->char('usuindcelwhatsapp', 1);
            $table->char('usuindmsg', 1);
            $table->string('usuimagemurl', 512)->nullable();
            //Informacoes militares
            $table->char('usutipoforca', 1);
            $table->char('usuindoficial', 1);
            $table->string('usucertreservista', 40)->nullable();
            $table->string('usupostograd', 4);
            $table->string('usunomeguerra', 100);
            $table->string('usunomeultbtl', 100);
            //Resumo
            $table->string('usuresumo', 1024);
            //Informações Sociais
            $table->string('usulinkedinurl', 512)->nullable();
            $table->string('usufacebookurl', 512)->nullable();
            $table->string('usuinstagramurl', 512)->nullable();
            $table->string('usutwitterurl', 512)->nullable();
            $table->string('usuyoutubeurl', 512)->nullable();
            $table->string('usublogsiteurl', 512)->nullable();
            //Informações Segurança Usuário
            $table->timestamp('usudtverificacaoemail')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->char('usuindstatus', 1);
            //Informações Segurança 
            $table->timestamp('dtcadastro')->nullable();
            $table->timestamp('dtedicao')->nullable();
            $table->timestamp('dtexclusao')->nullable();
            $table->bigInteger('usucriou')->nullable();
            $table->bigInteger('usueditou')->nullable();
            $table->bigInteger('usuexcluiu')->nullable();
            //chave estrangeira se for representante de empresa
            $table->foreign('idempresa')->references('idempresa')->on('EMPRESAS');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('USUARIOS');
    }
}
