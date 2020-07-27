<?php
namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class UtilsController extends Controller{
    
    public static function apenasNumeros($str){
        return preg_replace("/[^0-9]/","", $str);
    }
    
    public static function geraSenhaAleatoria(){
        return '$' . Str::random(10) . '!';
    }
    
    
}