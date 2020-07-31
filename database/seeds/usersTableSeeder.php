<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
           'empresa_id'                 => NULL,
           'permissao_usuario'          => 'A',
           'ind_oficial'                => 'N',
           'certificado_reservista'     => '21955151',
           'tipo_forca'                 => 'E',
           'posto_graduacao'            => '3SGT',
           'arma'                       => 'COM',
           'nome_de_guerra'             => 'Diego Santos',
           'nome_ultimo_batalhao'       => 'BEsCom',
           'cpf'                        => '11754423728',
           'nome_completo'              => 'Diego dos Santos Cordeiro',        
           'dt_nascimento'              => Carbon::parse('1986-07-12'),
           'estado_civil'               => 'S',
           'sexo'                       => 'M',
           'email'                      => 'sgt.chacal.d@gmail.com',
           'telefone_residencial'       => '51989104699',
           'telefone_celular'           => '2127538361',
           'ind_celular_whatsapp'       => 'S',
           'ind_msg_whatssap'           => 'S',
           'ind_portador_deficiencia'   => 'N',
           'url_imagem'                 => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fresultadosdigitais.com.br%2Fblog%2Fbancos-de-imagens%2F&psig=AOvVaw2zQnysQAoW_L3zcQ46jEkr&ust=1595380924929000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCICh9puX3eoCFQAAAAAdAAAAABAI',
           'url_linkedin'               => 'https://www.linkedin.com/in/diego-cordeiro-ba84a835/',  
           'url_facebook'               => 'https://www.facebook.com/chacalsgt',
           'url_twitter'                => 'https://twitter.com/chacalsgt',
           'url_youtube'                => 'https://www.youtube.com/user/didichacal',
           'url_instagram'              => 'https://www.instagram.com/sgt.chacal.d/?hl=pt-br',
           'url_blog_site'              => 'http://www.diegocordeiro.com.br/site/public/',
           'ind_disponivel_viagem'      => 'S',
           'ind_disponivel_mudar_cidade'=> 'N',
           'password'                   => Hash::make('d12345678d'),
           'usuario_id_created'         => 1,
           'ind_status'                 => 'A'
       ]);
    }
}
