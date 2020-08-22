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
           'usupermissao'               => 'A',
           'idempresa'                  => NULL,
           'usucpf'                     => '11754423728',
           'name'                       => 'Diego dos Santos Cordeiro',        
           'usudtnascimento'            => Carbon::parse('1986-07-12'),
           'usuestadoCivil'             => 'S',
           'usugenero'                  => 'M',
           'email'                   => 'sgt.chacal.d@gmail.com',
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
           'usuimagemurl'               => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fresultadosdigitais.com.br%2Fblog%2Fbancos-de-imagens%2F&psig=AOvVaw2zQnysQAoW_L3zcQ46jEkr&ust=1595380924929000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCICh9puX3eoCFQAAAAAdAAAAABAI',
           'usulinkedinurl'             => 'https://www.linkedin.com/in/diego-cordeiro-ba84a835/',  
           'usufacebookurl'             => 'https://www.facebook.com/chacalsgt',
           'usutwitterurl'              => 'https://twitter.com/chacalsgt',
           'usuyoutubeurl'              => 'https://www.youtube.com/user/didichacal',
           'usuinstagramurl'            => 'https://www.instagram.com/sgt.chacal.d/?hl=pt-br',
           'usublogsiteurl'             => 'http://www.diegocordeiro.com.br/site/public/',
           'password'                      => Hash::make('d12345678d'),
           'usucriou'                   => 1,
           'usuindstatus'               => 'A'
       ]);
    }
}
