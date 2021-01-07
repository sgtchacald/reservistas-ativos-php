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

    public function destroy($ididiomausuario){
        $delete = IdiomasUsuario::where(['ididiomausuario' => $ididiomausuario])->delete();
        return ($delete) ? true : false;
    }

    public function destroyIdiomasUsuario($idUsuario){
        $delete = IdiomasUsuario::where(['idusuario' => $idUsuario])->delete();
        return ($delete) ? true : false;
    }

    public function getIdiomasUsuarioByIdUsuario($idUsuario){
        $idiomasUsuario = $this->idiomasUsuario->getIdiomasUsuarioByIdUsuario($idUsuario);

        foreach($idiomasUsuario as $idiomaUsuario){

            $idiomaUsuario->nomeTxtIdioma = $idiomaUsuario->idnome;
            $idiomaUsuario->idnivelidioma = $idiomaUsuario->idusunivelidioma;
            $idiomaUsuario->txtNivelIdioma = \App\Dominios\NivelIdioma::getDominio()[$idiomaUsuario->idusunivelidioma];

            unset($idiomaUsuario->idnome);
            unset($idiomaUsuario->idusunivelidioma);

            json_encode($idiomaUsuario);
        }

        return json_encode($idiomasUsuario);
    }
}
