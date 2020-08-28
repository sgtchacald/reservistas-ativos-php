<?php

namespace App\Http\Controllers\Admin;

use App\NiveisEstudo;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\UtilsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;


class NivelEstudoController extends Controller{
    public function __construct(){
        $this->niveisEstudo = new NiveisEstudo();
    }
    
    public function index(){
        $niveisEstudo =   $this->niveisEstudo->getNiveisEstudo('A');
        return view('admin.nivelEstudo.selecionar')->with(compact('niveisEstudo'));
    }

    
    public function show(){
    }
    
    public function create(){
      
       return view('admin.nivelEstudo.cadastrar');
    }
    
    public function store(Request $request){
        $this->validaCampos($request, 'i');
        
        $insert = NiveisEstudo::create([
            'nienome'        => $request->input('nieNome'),
            'nieindstatus'   => $request->input('nieIndStatus'),
            'usucriou'            => Auth::user()->getAuthIdentifier(),
            'dtcadastro'          => date('Y-m-d H:i:s')
        ]);
        
        if($insert){
            $request->session()->flash('alert-success', Config::get('msg.cadastro_sucesso'));
            return redirect()->route('niveis.estudo.selecionar');
        }else{
            $niveisEstudo =  $this->niveisEstudo->getNiveisEstudo('A');
            $request->session()->flash('alert-danger', Config::get('msg.cadastro_erro'));
            return view('admin.nivelEstudo.selecionar')->with(compact('niveisEstudo'));
        }
    }
    
    public function edit($id){
        $nivelEstudo = $this->niveisEstudo->getNivelEstudoById($id);
        return view('admin.nivelEstudo.editar')->with(compact('nivelEstudo'));
    }
    
    public function update(Request $request){
        $this->validaCampos($request, 'u');
        
        $update = NiveisEstudo::where(['idnivelestudo' => $request->input('idNivelEstudo')])->update([
            'nienome'      => $request->input('nieNome'),
            'nieindstatus' => $request->input('nieIndStatus'),
            'usueditou'    => Auth::user()->getAuthIdentifier(),
            'dtedicao'     => date('Y-m-d H:i:s')
        ]);
        
        if($update){
            $request->session()->flash('alert-success', Config::get('msg.edicao_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.edicao_erro'));
        }

        return redirect()->route('niveis.estudo.selecionar');
    }
    
    public function destroy(Request $request, $id){
       
        $delete = NiveisEstudo::where(['idnivelestudo' => $id])->update([
            'nieindstatus'=>'I',
            'usuexcluiu' => Auth::user()->getAuthIdentifier(),
            'dtexclusao'=> date('Y-m-d H:i:s')
        ]);

        if($delete){
            $request->session()->flash('alert-success', Config::get('msg.exclusao_sucesso'));
        }else{            
            $request->session()->flash('alert-danger', Config::get('msg.exclusao_erro'));
        }

        return redirect()->route('niveis.estudo.selecionar');
    }

    public function validaCampos(Request $request, $tipoPersistencia){
        
            $rules = [
                'nieNome'       => 'required',
                'nieIndStatus'  => 'sometimes|required',
            ];
    
            $messages = ['required' => ':attribute é obrigatório.'];

            $customAttributes = [
                'nieNome' => Config::get('label.nome'),
                'nieIndStatus' => Config::get('label.status'),
            ];
            
            $request->validate($rules, $messages, $customAttributes);
    }
}