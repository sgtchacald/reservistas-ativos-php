<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Idiomas extends Authenticatable{
    use Notifiable;
    
    protected $primaryKey = 'ididioma';
    protected $table = 'IDIOMAS';
    
    const CREATED_AT = 'dtcadastro';
    const UPDATED_AT = 'dtedicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idnome',
        'idindstatus',
        //Informações Segurança 
        'dtcadastro',
        'dtedicao',
        'dtexclusao',
        'usucriou',
        'usueditou',
        'usuexcluiu'
    ];    

    public function getIdiomas($indStatus){
        return DB::table($this->table)
                    ->select('*')
                    ->where('idindstatus','=', $indStatus)
                    ->orderBy('ididioma','asc')
                    ->get();
    }

    public function getIdiomaById($id){
        return DB::table($this->table)
                ->where('ididioma','=', $id)
                ->get();
    }    

    public function getIdiomasOrderBy($colunaOrderBy, $tipoOrderBy, $idIndStatus){
        return DB::table($this->table)
        ->select('*')
        ->where('idindstatus','=', $idIndStatus)
        ->orderBy($colunaOrderBy, $tipoOrderBy)
        ->get();
    }
}