<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use App\NiveisEstudo;

class NiveisEstudoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        NiveisEstudo::create([
            'nienome'       => 'Ensino Fundamental (1º grau)',
            'nieindstatus'  => 'A',
            'usucriou'      => 1,
            'dtcadastro'    => date('Y-m-d H:i:s')
        ]);

        NiveisEstudo::create([
            'nienome'       => 'Curso extra-curricular / Profissionalizante',
            'nieindstatus'  => 'A',
            'usucriou'      => 1,
            'dtcadastro'    => date('Y-m-d H:i:s')
        ]);

        NiveisEstudo::create([
            'nienome'       => 'Ensino Médio (2º Grau)',
            'nieindstatus'  => 'A',
            'usucriou'      => 1,
            'dtcadastro'    => date('Y-m-d H:i:s')
        ]);

        NiveisEstudo::create([
            'nienome'       => 'Curso Técnico',
            'nieindstatus'  => 'A',
            'usucriou'      => 1,
            'dtcadastro'    => date('Y-m-d H:i:s')
        ]);

        NiveisEstudo::create([
            'nienome'       => 'Ensino Superior',
            'nieindstatus'  => 'A',
            'usucriou'      => 1,
            'dtcadastro'    => date('Y-m-d H:i:s')
        ]);

        NiveisEstudo::create([
            'nienome'       => 'Especialização/MBA',
            'nieindstatus'  => 'A',
            'usucriou'      => 1,
            'dtcadastro'    => date('Y-m-d H:i:s')
        ]);

        NiveisEstudo::create([
            'nienome'       => 'Mestrado',
            'nieindstatus'  => 'A',
            'usucriou'      => 1,
            'dtcadastro'    => date('Y-m-d H:i:s')
        ]);

        NiveisEstudo::create([
            'nienome'       => 'Doutorado',
            'nieindstatus'  => 'A',
            'usucriou'      => 1,
            'dtcadastro'       => date('Y-m-d H:i:s')
        ]);
    }
}
