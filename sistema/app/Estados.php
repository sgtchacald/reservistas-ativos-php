<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Estados extends Authenticatable{
    use Notifiable;
    
    protected $primaryKey = 'idestado';
    protected $table = 'ESTADOS';
    protected $id = 'idestado';
    protected $indStatus = 'estindStatus';
    
    const CREATED_AT = 'dtcadastro';
    const UPDATED_AT = 'dtedicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estnome',
        'estuf',
        'estidibge',
        'estpais',
        'estddd',
        'estindstatus',
        //Informações Segurança 
        'dtcadastro',
        'dtedicao',
        'dtexclusao',
        'usucriou',
        'usueditou',
        'usuexcluiu'
    ];    

    public function getEstadosByStatus($indStatus){
        return DB::table($this->table)
                    ->select('*')
                    ->where($this->indStatus,'=', $indStatus)
                    ->orderBy($this->id,'asc')
                    ->get();
    }

    public function getEstadoById($id){
        return DB::table($this->table)
                ->where($this->id,'=', $id)
                ->get();
    }    
}