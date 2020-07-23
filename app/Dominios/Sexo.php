<?php
namespace App\Dominios;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{

    public static function getDominio()
    {
        return array(
            "M" => "Masculino",
            "F" => "Feminino",
            "O" => "Outro"
        );
    }
}