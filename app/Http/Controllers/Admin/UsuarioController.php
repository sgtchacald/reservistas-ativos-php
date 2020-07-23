<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{  
    
    public function index(){
        return view('admin.reservista.selecionar');
    }
    
    public function show(){
    }
    
    public function create(){
       /*$permissoesUsuario = DMPermissoes::permissoesUsuario;
       $simNao = DMSimNao::simNao;
       return view('admin.reservista.cadastrar')->with(compact('permissoesUsuario','simNao'));*/
       return view('admin.reservista.cadastrar');
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
