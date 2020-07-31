<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class empresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
           'cnpj' => '82009963000110',
           'nome' => 'Reservista Ativo',
           'email_institucional' => '',
           'url_site' => '',
           'url_logotipo' => '',
           'ind_status' => 'A'
       ]);
    }
}
