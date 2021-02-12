<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class NiveisEstudo extends Authenticatable{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'NIVEIS_ESTUDO';

    const CREATED_AT = 'dtcadastro';
    const UPDATED_AT = 'dtedicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'indstatus',
        //Informações Segurança
        'dtcadastro',
        'dtedicao',
        'dtexclusao',
        'usucriou',
        'usueditou',
        'usuexcluiu'
    ];

    public function getNiveisEstudo($indStatus){
        return DB::table($this->table)
                    ->select('*')
                    ->where('indstatus','=', $indStatus)
                    ->orderBy('id','asc')
                    ->get();
    }

    public function getNivelEstudoById($id){
        return DB::table($this->table)
                ->where('id','=', $id)
                ->get();
    }
}
