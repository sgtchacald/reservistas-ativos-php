<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Cidades extends Authenticatable{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'CIDADES';
    protected $id = 'id';
    protected $indStatus = 'indstatus';

    const CREATED_AT = 'dtcadastro';
    const UPDATED_AT = 'dtedicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'idestado',
        'uf',
        'idibge',
        'ddd',
        'indstatus',
        //Informações Segurança
        'dtcadastro',
        'dtedicao',
        'dtexclusao',
        'usucriou',
        'usueditou',
        'usuexcluiu'
    ];

    public function getCidadesByStatus($indStatus){
        return DB::table($this->table)
                ->select('*')
                ->where($this->indStatus,'=', $indStatus)
                ->orderBy($this->id,'asc');
    }

    public function getCidadeById($id){
        return DB::table($this->table)
                ->where($this->id,'=', $id)
                ->get();
    }

    public function getCidadesByUf($cidUf){
        return DB::table($this->table)
                ->where('uf','=', $cidUf)
                ->where('indstatus','=', 'A')
                ->get();
    }

    public function getCidadeByIdIbge($cidIdIbge){
        return DB::table($this->table)
                ->where('idibge','=', $cidIdIbge)
                ->get();
    }

}
