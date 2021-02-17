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
            'nome'       => $request->input('nome'),
            'uf'         => $request->input('uf'),
            'idibge'     => $request->input('idIbge'),
            'idpais'       => $request->input('idPais'),
            'ddd'        => $request->input('ddd'),
            'indstatus'  => $request->input('indStatus'),
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

        $update = Estados::where(['id' => $request->input('id')])->update([
            'nome'       => $request->input('nome'),
            'uf'         => $request->input('uf'),
            'idibge'     => $request->input('idIbge'),
            'idpais'     => $request->input('idPais'),
            'ddd'        => $request->input('ddd'),
            'indstatus'  => $request->input('indStatus'),
            'usueditou'  => Auth::user()->getAuthIdentifier(),
            'dtedicao'   => date('Y-m-d H:i:s')
        ]);

        if($update){
            $request->session()->flash('alert-success', Config::get('msg.edicao_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.edicao_erro'));
        }

        return redirect()->route('estados.selecionar');
    }

    public function destroy(Request $request, $id){

        $delete = Estados::where(['id' => $id])->update([
            'indstatus' => 'I',
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
                'nome'       => 'required|max:75',
                'uf'         => 'required|max:2',
                'idIbge'     => 'required|integer',
                'idPais'     => 'required|integer',
                'ddd'        => 'required|max:50',
                'indStatus'  => 'sometimes|required|max:1',
            ];

            $messages = ['required' => ':attribute é obrigatório.'];

            $customAttributes = [
                'nome'      => Config::get('label.nome'),
                'uf'        => Config::get('label.estado_uf'),
                'idIbge'    => Config::get('label.estado_id_ibge'),
                'idPais'    => Config::get('label.estado_pais'),
                'ddd'       => Config::get('label.estado_ddd'),
                'indStatus' => Config::get('label.status'),
            ];

            $request->validate($rules, $messages, $customAttributes);
    }
}
