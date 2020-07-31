<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuarios extends Model {
    
    public function getUsuarios($indStatus,$permissaoUsuario){
        
        //return DB::table('usuarios')->where('ind_status' == $indStatus and 'permissao_usuario' == $permissaoUsuario)->get();
        return DB::table('usuarios')->get();
    }
    
}
