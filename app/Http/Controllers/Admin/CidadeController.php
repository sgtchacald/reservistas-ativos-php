<?php

namespace App\Http\Controllers\Admin;

use App\Estados;
use App\Cidades;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\UtilsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;
use DataTables;

class CidadeController extends Controller{

    public function __construct(){
        $this->Estados = new Estados();
        $this->cidades = new Cidades();
    }
    
    public function index(){
        return view('admin.localizacao.cidade.selecionar');
    }
    
    public function show(){
        return datatables($this->cidades->getCidadesByStatus('A'))
                ->addColumn('btn', 'admin.localizacao.cidade.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }

    
    public function create(){
       $estados =   $this->Estados->getEstadosByStatus('A');
       return view('admin.localizacao.cidade.cadastrar')->with(compact('estados'));
    }
    
    public function store(Request $request){
        $this->validaCampos($request, 'i');
        
        $insert = Cidades::create([
            'cidnome'       => $request->input('cidNome'),
            'ciduf'        => $request->input('cidUf'),
            'cididibge'     => $request->input('cidIdIbge'),
            'cidddd'        => $request->input('cidDdd'),
            'cidindstatus'  => $request->input('cidIndStatus'),
            'usucriou'      => Auth::user()->getAuthIdentifier(),
            'dtcadastro'    => date('Y-m-d H:i:s')
        ]);
        
        if($insert){
            $request->session()->flash('alert-success', Config::get('msg.cadastro_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.cadastro_erro'));
        }

        return redirect()->route('cidades.selecionar');
    }
    
    public function edit($id){
        $cidade = $this->cidades->getCidadeById($id);
        $estados =   $this->Estados->getEstadosByStatus('A');
        return view('admin.localizacao.cidade.editar')->with(compact('cidade','estados'));
    }
    
    public function update(Request $request){
        $this->validaCampos($request, 'u');
        
        $update = Cidades::where(['idcidade' => $request->input('idCidade')])->update([
            'cidnome'       => $request->input('cidNome'),
            'ciduf'         => $request->input('cidUf'),
            'cididibge'     => $request->input('cidIdIbge'),
            'cidddd'        => $request->input('cidDdd'),
            'cidindstatus'  => $request->input('cidIndStatus'),
            'usueditou'     => Auth::user()->getAuthIdentifier(),
            'dtedicao'      => date('Y-m-d H:i:s')
        ]);
        
        if($update){
            $request->session()->flash('alert-success', Config::get('msg.edicao_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.edicao_erro'));
        }

        return redirect()->route('cidades.selecionar');
    }
    
    public function destroy(Request $request, $id){
       
        $delete = Cidades::where(['idcidade' => $id])->update([
            'cidindstatus' => 'I',
            'usuexcluiu' => Auth::user()->getAuthIdentifier(),
            'dtexclusao'=> date('Y-m-d H:i:s')
        ]);

        if($delete){
            $request->session()->flash('alert-success', Config::get('msg.exclusao_sucesso'));
        }else{            
            $request->session()->flash('alert-danger', Config::get('msg.exclusao_erro'));
        }

        return redirect()->route('cidades.selecionar');
    }

    public function validaCampos(Request $request, $tipoPersistencia){
            $rules = [
                'cidNome'       => 'required|max:120',
                'cidUf'         => 'required|max:2',
                'cidIdIbge'     => 'required|integer',
                'cidDdd'        => 'required|max:2',
                'cidIndStatus'  => 'sometimes|required|max:1',
            ];
    
            $messages = ['required' => ':attribute é obrigatório.'];

            $customAttributes = [
                'cidNome'       => Config::get('label.nome'),
                'cidUf'         => Config::get('label.cidade_uf'),
                'cidIdIbge'     => Config::get('label.cidade_id_ibge'),
                'cidDdd'        => Config::get('label.cidade_ddd'),
                'cidIndStatus'  => Config::get('label.status'),
            ];
           
            $request->validate($rules, $messages, $customAttributes);
    }
}