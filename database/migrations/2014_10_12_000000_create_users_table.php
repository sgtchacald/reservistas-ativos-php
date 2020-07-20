<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('usuario_id');
            $table->bigInteger('empresa_id')->unsigned();
            $table->string('tipo_usuario');
            //Informacoes militares
            $table->string('ind_oficial');
            $table->string('certificado_reservista');
            $table->string('tipo_forca');
            $table->string('posto_graduacao');
            $table->string('arma');
            $table->string('nome_de_guerra');
            $table->string('nome_ultimo_batalhao');
            //Informacoes Civis
            $table->string('cpf');
            $table->string('nome_completo');
            $table->date('dt_nascimento');
            $table->string('estado_civil');
            $table->string('sexo');
            $table->string('email')->unique();
            $table->string('telefone_residencial');
            $table->string('telefone_celular');
            $table->string('ind_celular_whatsapp');
            $table->string('ind_msg_whatssap');
            $table->string('ind_portador_deficiencia');
            //Informações Sociais
            $table->string('url_imagem');
            $table->string('url_linkedin');
            $table->string('url_facebook');
            $table->string('url_twitter');
            $table->string('url_youtube');
            $table->string('url_instagram');
            $table->string('url_blog_site');
            //Informações Disponibilidade
            $table->string('ind_disponivel_viagem');
            $table->string('ind_disponivel_mudar_cidade');
            //Informações Segurança Usuário
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->string('usuario_id_created')->nullable();
            $table->string('usuario_id_updated')->nullable();
            $table->string('usuario_id_deleted')->nullable();
            $table->string('ind_status');
            //chave estrangeira se for representante de empresa
            $table->foreign('empresa_id')->references('empresa_id')->on('empresas');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
