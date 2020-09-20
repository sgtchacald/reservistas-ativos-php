<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Cidades extends Authenticatable{
    use Notifiable;
    
    protected $primaryKey = 'idcidade';
    protected $table = 'CIDADES';
    protected $id = 'idcidade';
    protected $indStatus = 'cidindstatus';
    
    const CREATED_AT = 'dtcadastro';
    const UPDATED_AT = 'dtedicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cidnome',
        'ciduf',
        'cididibge',
        'cidddd',
        'cidindstatus',
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
}