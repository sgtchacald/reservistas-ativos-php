<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Empresas::create([
           'cnpj' => '82009963000110',
           'nome' => 'Reservista Ativo',
           'email_institucional' => '',
           'url_site' => '',
           'url_logotipo' => '',
           'ind_status' => 'A'
       ]);
    }
}
