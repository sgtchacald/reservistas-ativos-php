<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Dominios\PermissoesEnum;
use App\Dominios\SimNaoEnum;

class UsuarioController extends Controller
{  
    
    public function index(){
        return view('admin.reservista.selecionar');
    }
    
    public function show(){
    }
    
    public function create(){
        $permissoesUsuario = PermissoesEnum::permissoesUsuario;
        $simNao = SimNaoEnum::simNao;
        return view('admin.reservista.cadastrar')->with(compact('permissoesUsuario','simNao'));
    }
    
    public function store(){
    }
    
    public function edit(){
    }
    
    public function update(){
    }
    
    public function destroy(){
    }
    
}
