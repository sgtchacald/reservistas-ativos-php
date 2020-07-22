<?php

namespace App\Dominios;

use Illuminate\Database\Eloquent\Model;

class SimNaoEnum extends Model {
    
    const simNao = array(
        "S" => "Sim",
        "N" => "Não"
    );
   
}