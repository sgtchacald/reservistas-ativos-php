<?php

namespace App\Http\Controllers\Admin;

use App\Estados;
use App\Cidades;
use App\Logradouros;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\UtilsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;
use DataTables;

class LogradouroController extends Controller{

    public function __construct(){
        $this->estados = new Estados();
        $this->cidades = new Cidades();
        $this->logradouros = new Logradouros();
    }
    
    public function index(){
        return view('admin.localizacao.logradouro.selecionar');
    }
    
    public function show(){
        return datatables($this->logradouros->getLogradourosByStatus('A'))
                ->addColumn('btn', 'admin.localizacao.logradouro.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }

    
    public function create(){
       $estados =   $this->estados->getEstadosByStatus('A');
       $cidades =   $this->cidades->getCidadesByStatus('A');

       return view('admin.localizacao.logradouro.cadastrar')->with(compact('estados', 'cidades'));
    }
    
    public function store(Request $request){
        $this->validaCampos($request, 'i');
        
        $insert = Cidades::create([
            'logcep'           => $request->input('logCep'),
            'logtipo'          => $request->input('logTipo'),
            'lognome'          => $request->input('logNome'),
            'idcidade'         => $request->input('idCidade'),
            'ciduf'            => $request->input('cidUf'),
            'logcomplemento'   => $request->input('logComplemento'),
            'lognomesemnr'     => $request->input('logNomeSemNr'),
            'lognomecid'       => $request->input('logNomeCid'),
            'idibgecidade'     => $request->input('idIbgeCidade'),
            'lognomebairro'    => $request->input('logNomeBairro'),
            'logindstatus'     => $request->input('logIndStatus'),
            'logindorigemcad'  => $request->input('logIndOrigemCad'),
            'usucriou'         => Auth::user()->getAuthIdentifier(),
            'dtcadastro'       => date('Y-m-d H:i:s')
        ]);
        
        if($insert){
            $request->session()->flash('alert-success', Config::get('msg.cadastro_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.cadastro_erro'));
        }

        return redirect()->route('cidades.selecionar');
    }
    
    public function edit($id){
       return view('admin.localizacao.cidade.editar')->with(compact('cidade','estados'));
    }
    
    public function update(Request $request){
        $this->validaCampos($request, 'u');
        
        $update = Cidades::where(['idcidade' => $request->input('idCidade')])->update([
            'logcep'           => $request->input('logCep'),
            'logtipo'          => $request->input('logTipo'),
            'lognome'          => $request->input('logNome'),
            'idcidade'         => $request->input('idCidade'),
            'ciduf'            => $request->input('cidUf'),
            'logcomplemento'   => $request->input('logComplemento'),
            'lognomesemnr'     => $request->input('logNomeSemNr'),
            'lognomecid'       => $request->input('logNomeCid'),
            'idibgecidade'     => $request->input('idIbgeCidade'),
            'lognomebairro'    => $request->input('logNomeBairro'),
            'logindstatus'     => $request->input('logIndStatus'),
            'logindorigemcad'  => $request->input('logIndOrigemCad'),
            'usueditou'        => Auth::user()->getAuthIdentifier(),
            'dtedicao'         => date('Y-m-d H:i:s')
        ]);
        
        if($update){
            $request->session()->flash('alert-success', Config::get('msg.edicao_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.edicao_erro'));
        }

        return redirect()->route('cidades.selecionar');
    }
    
    public function destroy(Request $request, $id){
       
        $delete = Cidades::where(['idlogradouro' => $id])->update([
            'logindstatus' => 'I',
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
                'logCep'           => 'required|max:60',
                'logTipo'          => 'required|max:60',
                'logNome'          => 'required|max:60',
                'logNomeSemNr'     => 'required|max:100',
                'logComplemento'   => 'required|max:100',
                'estUf'            => 'required|max:2',
                'idCidade'         => 'required',                
                'logNomeBairro'    => 'required|max:100',
                'logIndStatus'     => 'required|max:1',
            ];
    
            $messages = ['required' => ':attribute é obrigatório.'];

            $customAttributes = [
                'logCep'           => Config::get('label.logradouro_cep'),
                'logTipo'          => Config::get('label.logradouro_tipo'),
                'logNome'          => Config::get('label.logradouro_nome'),
                'logNomeSemNr'     => Config::get('label.logradouro_nome_sem_numero'),
                'logComplemento'   => Config::get('label.logradouro_complemento'),
                'estUf'            => Config::get('label.logradouro_uf'),
                'idCidade'         => Config::get('label.logradouro_cidade'),
                'logNomeBairro'    => Config::get('label.logradouro_bairro'),
                'logindstatus'     => Config::get('label.status'),
            ];
           
            $request->validate($rules, $messages, $customAttributes);
    }

    public function getCidadesByUf($cidUf){
        return $this->cidades->getCidadesByUf($cidUf)->toJson();
    }
}