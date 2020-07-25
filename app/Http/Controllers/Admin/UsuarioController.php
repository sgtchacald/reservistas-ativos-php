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
       return view('admin.reservista.cadastrar');
    }
    
    public function store(){
       echo "Teste";
    }
    
    public function edit(){
    }
    
    public function update(){
    }
    
    public function destroy(){
    }
    
}
