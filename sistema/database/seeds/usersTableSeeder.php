<?php

use App\Usuarios;
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
       Usuarios::create([
           'idempresa'                  => NULL,
           'tipopermissao'               => 'A',
           'name'                       => 'Diego dos Santos Cordeiro',
           'cpf'                        => '11754423728',
           'dtnascimento'               => Carbon::parse('1986-07-12'),
           'estadocivil'                => 'S',
           'genero'                     => 'M',
           'indportadordeficiencia'     => 'N',
           'email'                      => 'sgt.chacal.d@gmail.com',
           'telefonecelular'            => '2127538361',
           'telefonefixo'               => '51989104699',
           'indviagem'                  => 'S',
           'indmudarcidade'             => 'N',
           'indcelwhatsapp'             => 'S',
           'indrecebermsg'              => 'S',
           'urlfotoanexo'               => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fresultadosdigitais.com.br%2Fblog%2Fbancos-de-imagens%2F&psig=AOvVaw2zQnysQAoW_L3zcQ46jEkr&ust=1595380924929000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCICh9puX3eoCFQAAAAAdAAAAABAI',
           'tipoforca'                  => 'E',
           'indoficial'                 => 'N',
           'nrcertificado'              => '21955151',
           'urlcertificadoanexo'        => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fresultadosdigitais.com.br%2Fblog%2Fbancos-de-imagens%2F&psig=AOvVaw2zQnysQAoW_L3zcQ46jEkr&ust=1595380924929000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCICh9puX3eoCFQAAAAAdAAAAABAI',
           'postograduacao'             => '3SGT',
           'nomeguerra'                 => 'Diego Santos',
           'nomeultimobtl'              => 'BEsCom',
           'idlogradouro'               => NULL,
           'resumoprofissional'         => 'Lorem Ipsum',
           'urllinkedin'                => 'https://www.linkedin.com/in/diego-cordeiro-ba84a835/',
           'urlfacebook'                => 'https://www.facebook.com/chacalsgt',
           'urlinstagram'               => 'https://www.instagram.com/sgt.chacal.d/?hl=pt-br',
           'urltwitter'                 => 'https://twitter.com/chacalsgt',
           'urlyoutube'                 => 'https://www.youtube.com/user/didichacal',
           'urlblogsite'                => 'http://www.diegocordeiro.com.br/site/public/',
           'password'                   => Hash::make('d12345678d'),
           'usucriou'                   => 1,
           'indstatus'               => 'A'
       ]);
    }
}
