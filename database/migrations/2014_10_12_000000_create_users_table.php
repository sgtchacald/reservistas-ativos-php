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
    
    public $incrementing = false;
    
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('usuario_id');
            $table->bigInteger('empresa_id')->unsigned()->nullable();
            $table->char('permissao_usuario', 1);
            //Informacoes militares
            $table->char('ind_oficial', 1);
            $table->string('certificado_reservista', 40);
            $table->char('tipo_forca', 1);
            $table->string('posto_graduacao', 4);
            //$table->string('arma', 40);
            $table->string('nome_de_guerra', 100);
            $table->string('nome_ultimo_batalhao', 100);
            //Informacoes Civis
            $table->string('cpf', 11);
            $table->string('nome_completo', 100);
            $table->date('dt_nascimento');
            $table->char('estado_civil', 2);
            $table->char('sexo', 1);
            $table->string('email',100)->unique();
            $table->string('telefone_residencial', 20);
            $table->string('telefone_celular', 20);
            $table->char('ind_celular_whatsapp', 1);
            $table->char('ind_msg_whatssap', 1);
            $table->char('ind_portador_deficiencia', 1);
            //Informações Sociais
            $table->string('url_imagem', 512);
            $table->string('url_linkedin', 512)->nullable();
            $table->string('url_facebook', 512)->nullable();
            $table->string('url_twitter', 512)->nullable();
            $table->string('url_youtube', 512)->nullable();
            $table->string('url_instagram', 512)->nullable();
            $table->string('url_blog_site', 512)->nullable();
            //Informações Disponibilidade
            $table->char('ind_disponivel_viagem', 1);
            $table->char('ind_disponivel_mudar_cidade', 1);
            //Informações Segurança Usuário
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('usuario_id_created')->nullable();
            $table->bigInteger('usuario_id_updated')->nullable();
            $table->bigInteger('usuario_id_deleted')->nullable();
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
