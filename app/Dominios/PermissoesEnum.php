<?php

namespace App\Dominios;

use Illuminate\Database\Eloquent\Model;

class PermissoesEnum extends Model {
    
    const permissoesUsuario = array(
        "A" => "Administrador",
        "R" => "Reservista",
        "E" => "Representante de Empresa"
    );
   
}