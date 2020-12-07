<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Logradouros extends Authenticatable{
    use Notifiable;
    
    protected $primaryKey = 'idlogradouro';
    protected $table = 'LOGRADOUROS';
    protected $id = 'idlogradouro';
    protected $indStatus = 'logindstatus';
    
    const CREATED_AT = 'dtcadastro';
    const UPDATED_AT = 'dtedicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logcep',
        'logtipo',
        'lognome',
        'idcidade',
        'ciduf',
        'logcomplemento',
        'lognomesemnr',
        'lognomecid',
        'idibgecidade',
        'lognomebairro',
        'logindstatus',
        'logindorigemcad',
        //Informações Segurança 
        'dtcadastro',
        'dtedicao',
        'dtexclusao',
        'usucriou',
        'usueditou',
        'usuexcluiu'
    ];    

    public function getLogradourosByStatus($indStatus){
        return DB::table($this->table)
                ->select('*')
                ->where($this->indStatus,'=', $indStatus)
                ->orderBy($this->id,'asc');
    }

    public function getLogradouroById($id){
        return DB::table($this->table)
                ->where($this->id,'=', $id)
                ->get();
    }

    public function existeLogradouro($array){
        
        $existeRegistro = 
            DB::table($this->table)
                ->where('logcep',         '=', $array["logcep"])
                ->where('lognome',        '=', $array["lognome"])
                ->where('lognomesemnr',   '=', $array["lognomesemnr"])
                ->where('idcidade',       '=', $array["idcidade"])
                ->where('ciduf',          '=', $array["ciduf"])
                ->where('logcomplemento', '=', $array["logcomplemento"])
                ->where('lognomecid',     '=', $array["lognomecid"])
                ->where('idibgecidade',   '=', $array["idibgecidade"])
                ->where('lognomebairro',  '=', $array["lognomebairro"])
                ->count();

        return $existeRegistro > 0 ? true : false;
        
    }

    public function buscaLogradouroDigitado($array){
        
        return DB::table($this->table)
                ->where('logcep',         '=', $array["logcep"])
                ->where('lognome',        '=', $array["lognome"])
                ->where('lognomesemnr',   '=', $array["lognomesemnr"])
                ->where('idcidade',       '=', $array["idcidade"])
                ->where('ciduf',          '=', $array["ciduf"])
                ->where('logcomplemento', '=', $array["logcomplemento"])
                ->where('lognomecid',     '=', $array["lognomecid"])
                ->where('idibgecidade',   '=', $array["idibgecidade"])
                ->where('lognomebairro',  '=', $array["lognomebairro"])
                ->get();

    }

    
}