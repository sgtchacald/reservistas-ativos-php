<?php
namespace App\Dominios;

use Illuminate\Database\Eloquent\Model;

class IndStatus extends Model
{

    public static function getDominio(){
        return array(
            "A" => "Ativo",
            "I" => "Inativo"
        );
    }
    
    public static function getValueAtivo(){
        return 'A';
    }
    
    public static function getValueInativo(){
        return 'I';
    }
    
}