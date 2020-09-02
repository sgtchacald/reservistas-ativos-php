<?php

namespace App\Http\Controllers\Admin;

use App\Estados;
use App\Paises;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\UtilsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;

class EstadoController extends Controller{

    public function __construct(){
        $this->estados = new Estados();
        $this->paises = new Paises();
    }
    
    public function index(){
        $estados =   $this->estados->getEstadosByStatus('A');
        return view('admin.localizacao.estado.selecionar')->with(compact('estados'));
    }
    
    public function show(){
    }
    
    public function create(){
       $paises =   $this->paises->getPaisesByStatus('A');
       return view('admin.localizacao.estado.cadastrar')->with(compact('paises'));
    }
    
    public function store(Request $request){
        $this->validaCampos($request, 'i');
        
        $insert = Estados::create([
            'estnome'       => $request->input('estNome'),
            'estuf'         => $request->input('estUf'),
            'estidibge'     => $request->input('estIdIbge'),
            'estpais'       => $request->input('estPais'),
            'estddd'        => $request->input('estDdd'),
            'estindstatus'  => $request->input('estIndStatus'),
            'usucriou'      => Auth::user()->getAuthIdentifier(),
            'dtcadastro'    => date('Y-m-d H:i:s')
        ]);
        
        if($insert){
            $request->session()->flash('alert-success', Config::get('msg.cadastro_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.cadastro_erro'));
        }

        return redirect()->route('estados.selecionar');
    }
    
    public function edit($id){
        $estado = $this->estados->getEstadoById($id);
        $paises =   $this->paises->getPaisesByStatus('A');
        return view('admin.localizacao.estado.editar')->with(compact('estado','paises'));
    }
    
    public function update(Request $request){
        $this->validaCampos($request, 'u');
        
        $update = Estados::where(['idestado' => $request->input('idEstado')])->update([
            'estnome'       => $request->input('estNome'),
            'estuf'         => $request->input('estUf'),
            'estidibge'     => $request->input('estIdIbge'),
            'estpais'       => $request->input('estPais'),
            'estddd'        => $request->input('estDdd'),
            'estindstatus'  => $request->input('estIndStatus'),
            'usueditou' => Auth::user()->getAuthIdentifier(),
            'dtedicao'  => date('Y-m-d H:i:s')
        ]);
        
        if($update){
            $request->session()->flash('alert-success', Config::get('msg.edicao_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.edicao_erro'));
        }

        return redirect()->route('estados.selecionar');
    }
    
    public function destroy(Request $request, $id){
       
        $delete = Estados::where(['idestado' => $id])->update([
            'estindstatus' => 'I',
            'usuexcluiu' => Auth::user()->getAuthIdentifier(),
            'dtexclusao'=> date('Y-m-d H:i:s')
        ]);

        if($delete){
            $request->session()->flash('alert-success', Config::get('msg.exclusao_sucesso'));
        }else{            
            $request->session()->flash('alert-danger', Config::get('msg.exclusao_erro'));
        }

        return redirect()->route('estados.selecionar');
    }

    public function validaCampos(Request $request, $tipoPersistencia){
        
            $rules = [
                'estNome'       => 'required|max:75',
                'estUf'         => 'required|max:2',
                'estIdIbge'     => 'required|integer',
                'estPais'       => 'required|integer',
                'estDdd'        => 'required|max:50',
                'estIndStatus'  => 'sometimes|required|max:1',
            ];
    
            $messages = ['required' => ':attribute é obrigatório.'];

            $customAttributes = [
                'estNome' => Config::get('label.nome'),
                'estUf' => Config::get('label.estado_uf'),
                'estIdIbge' => Config::get('label.estado_id_ibge'),
                'estPais' => Config::get('label.estado_pais'),
                'estDdd' => Config::get('label.estado_ddd'),
                'pIndStatus' => Config::get('label.status'),
            ];
           
            $request->validate($rules, $messages, $customAttributes);
    }
}