<?php

namespace App\Http\Controllers\Admin;
use App\IdiomasUsuario;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\UtilsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;

class IdiomasUsuarioController extends Controller{
    public function __construct(){
        $this->idiomasUsuario = new IdiomasUsuario();
    }

    public function store($idiomasUsuario, $idUsuario){
        $insert = true;

        if(isset($idiomasUsuario) && isset($idUsuario)){
            foreach($idiomasUsuario as $idiomaUsuario){
                $chave = json_decode($idiomaUsuario);
                $insert = IdiomasUsuario::create([
                    'idusuario'        => $idUsuario,
                    'ididioma'         => $chave->ididioma,
                    'idusunivelidioma' => $chave->idnivelidioma,
                    'idusuindstatus'   => 'A',
                    'usucriou'         => $idUsuario,
                    'dtcadastro'       => date('Y-m-d H:i:s')
                ]);
            }
        }

        return ($insert) ? true : false;
    }

}
