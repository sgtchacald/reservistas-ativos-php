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
            $table->bigIncrements('idusuario');
            $table->bigInteger('idempresa')->unsigned()->nullable();
            $table->char('usupermissao', 1);
            //Informacoes Civis
            $table->string('usucpf', 11);
            $table->string('name', 100);
            $table->date('usudtnascimento');
            $table->char('usuestadoCivil', 2);
            $table->char('ususexo', 1);
            $table->string('usuemail',100)->unique();
            $table->string('usutelfixo', 20);
            $table->string('usutelcelular', 20);
            $table->char('usuindcelwhatsapp', 1);
            $table->char('usuindmsg', 1);
            $table->char('usuindportdeficiente', 1);
            //Informacoes militares
            $table->char('usuindoficial', 1);
            $table->string('usucertreservista', 40);
            $table->char('usutipoforca', 1);
            $table->string('usupostograd', 4);
            $table->string('usunomeguerra', 100);
            $table->string('usunomeultbtl', 100);            
            //Informações Sociais
            $table->string('usuurlimagem', 512);
            $table->string('usuurllinkedin', 512)->nullable();
            $table->string('usuurlfacebook', 512)->nullable();
            $table->string('usuurltwitter', 512)->nullable();
            $table->string('usuurlyoutube', 512)->nullable();
            $table->string('usuurlinstagram', 512)->nullable();
            $table->string('usuurlblogsite', 512)->nullable();
            //Informações Disponibilidade
            $table->char('usuindviagem', 1);
            $table->char('usuindmudarcidade', 1);
            //Informações Segurança Usuário
            $table->timestamp('usudtverificacaoemail')->nullable();
            $table->string('ususenha');
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
