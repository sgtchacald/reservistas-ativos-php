<?php

use App\User;
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
           'usupermissao'               => 'A',
           'idempresa'                  => NULL,
           //Informacoes Civis
           'usucpf'                     => '11754423728',
           'usunomecompleto'            => 'Diego dos Santos Cordeiro',        
           'usudtnascimento'            => Carbon::parse('1986-07-12'),
           'usuestadoCivil'             => 'S',
           'ususexo'                    => 'M',
           'usuemail'                   => 'sgt.chacal.d@gmail.com',
           'usutelfixo'                 => '51989104699',
           'usutelcelular'              => '2127538361',
           'usuindcelwhatsapp'          => 'S',
           'usuindmsg'                  => 'S',
           'usuindportdeficiente'       => 'N',
           'usuindviagem'               => 'S',
           'usuindmudarcidade'          => 'N',
           'usuindoficial'              => 'N',
           'usucertreservista'          => '21955151',
           'usutipoforca'               => 'E',
           'usupostograd'               => '3SGT',
           'usunomeguerra'              => 'Diego Santos',
           'usunomeultbtl'              => 'BEsCom',
           'usuurlimagem'               => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fresultadosdigitais.com.br%2Fblog%2Fbancos-de-imagens%2F&psig=AOvVaw2zQnysQAoW_L3zcQ46jEkr&ust=1595380924929000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCICh9puX3eoCFQAAAAAdAAAAABAI',
           'usuurllinkedin'             => 'https://www.linkedin.com/in/diego-cordeiro-ba84a835/',  
           'usuurlfacebook'             => 'https://www.facebook.com/chacalsgt',
           'usuurltwitter'              => 'https://twitter.com/chacalsgt',
           'usuurlyoutube'              => 'https://www.youtube.com/user/didichacal',
           'usuurlinstagram'            => 'https://www.instagram.com/sgt.chacal.d/?hl=pt-br',
           'usuurlblogsite'             => 'http://www.diegocordeiro.com.br/site/public/',
           'ususenha'                      => Hash::make('d12345678d'),
           'usucriou'                   => 1,
           'usuindstatus'               => 'A'
       ]);
    }
}
