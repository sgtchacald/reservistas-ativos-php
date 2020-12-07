<?php

namespace App\Http\Controllers\Admin;

use App\Paises;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\UtilsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;

class PaisController extends Controller{

    public function __construct(){
        $this->paises = new Paises();
    }
    
    public function index(){
        $paises =   $this->paises->getPaisesByStatus('A');
        return view('admin.localizacao.pais.selecionar')->with(compact('paises'));
    }

    
    public function show(){
    }
    
    public function create(){
      
       return view('admin.localizacao.pais.cadastrar');
    }
    
    public function store(Request $request){
        $this->validaCampos($request, 'i');
        
        $insert = Paises::create([
            'pnome'        => $request->input('pNome'),
            'pnomept'      => $request->input('pNomePt'),
            'psigla'       => $request->input('pSigla'),
            'pbacen'       => $request->input('pBaCen'),
            'pindstatus'   => $request->input('pIndStatus'),
            'usucriou'     => Auth::user()->getAuthIdentifier(),
            'dtcadastro'   => date('Y-m-d H:i:s')
        ]);
        
        if($insert){
            $request->session()->flash('alert-success', Config::get('msg.cadastro_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.cadastro_erro'));
        }

        return redirect()->route('paises.selecionar');
    }
    
    public function edit($id){
        $pais = $this->paises->getPaisesById($id);
        return view('admin.localizacao.pais.editar')->with(compact('pais'));
    }
    
    public function update(Request $request){
        $this->validaCampos($request, 'u');
        
        $update = Paises::where(['idpais' => $request->input('idPais')])->update([
            'pnome'     => $request->input('pNome'),
            'pnomept'   => $request->input('pNomePt'),
            'psigla'    => $request->input('pSigla'),
            'pbacen'    => $request->input('pBaCen'),
            'pindstatus'=> $request->input('pIndStatus'),
            'usueditou' => Auth::user()->getAuthIdentifier(),
            'dtedicao'  => date('Y-m-d H:i:s')
        ]);
        
        if($update){
            $request->session()->flash('alert-success', Config::get('msg.edicao_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.edicao_erro'));
        }

        return redirect()->route('paises.selecionar');
    }
    
    public function destroy(Request $request, $id){
       
        $delete = Paises::where(['idpais' => $id])->update([
            'pindstatus'=>'I',
            'usuexcluiu' => Auth::user()->getAuthIdentifier(),
            'dtexclusao'=> date('Y-m-d H:i:s')
        ]);

        if($delete){
            $request->session()->flash('alert-success', Config::get('msg.exclusao_sucesso'));
        }else{            
            $request->session()->flash('alert-danger', Config::get('msg.exclusao_erro'));
        }

        return redirect()->route('paises.selecionar');
    }

    public function validaCampos(Request $request, $tipoPersistencia){
        
            $rules = [
                'pNome'       => 'required|max:100',
                'pNomePt'       => 'required|max:100',
                'pSigla'       => 'required|max:2',
                'pBaCen'       => 'required|integer',
                'pIndStatus'  => 'sometimes|required',
            ];
    
            $messages = ['required' => ':attribute é obrigatório.'];

            $customAttributes = [
                'pNome' => Config::get('label.pais_nome_global'),
                'pNomePt' => Config::get('label.pais_nome_nacional'),
                'pSigla' => Config::get('label.pais_sigla'),
                'pBaCen' => Config::get('label.pais_bacen'),
                'pIndStatus' => Config::get('label.status'),
            ];
            
            $request->validate($rules, $messages, $customAttributes);
    }
}