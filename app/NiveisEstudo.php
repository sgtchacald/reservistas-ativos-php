<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class NiveisEstudo extends Authenticatable{
    use Notifiable;
    
    protected $primaryKey = 'idnivelestudo';
    protected $table = 'NIVEISESTUDO';
    
    const CREATED_AT = 'dtcadastro';
    const UPDATED_AT = 'dtedicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nienome',
        'nieindstatus',
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
                    ->where('nieindstatus','=', $indStatus)
                    ->orderBy('idnivelestudo','asc')
                    ->get();
    }

    public function getNivelEstudoById($id){
        return DB::table($this->table)
                ->where('idnivelestudo','=', $id)
                ->get();
    }    
}