<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class IdiomasUsuario extends Authenticatable{
    use Notifiable;

    protected $primaryKey = 'ididiomausuario';
    protected $table = 'IDIOMASUSUARIO';

    const CREATED_AT = 'dtcadastro';
    const UPDATED_AT = 'dtedicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idusuario',
        'ididioma',
        'idusunivelidioma',
        'idusuindstatus',
        //Informações Segurança
        'dtcadastro',
        'dtedicao',
        'dtexclusao',
        'usucriou',
        'usueditou',
        'usuexcluiu'
    ];

    public function getIdiomasUsuario(){
        return DB::table($this->table)
            ->select('*')
            ->orderBy('ididiomausuario','asc')
            ->get();
    }

    public function getIdiomaUsuarioById($id){
        return DB::table($this->table)
            ->where('ididiomausuario','=', $id)
            ->get();
    }
}
