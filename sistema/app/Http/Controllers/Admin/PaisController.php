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
            'nome'        => $request->input('nome'),
            'nomept'      => $request->input('nomePt'),
            'sigla'       => $request->input('sigla'),
            'bacen'       => $request->input('bacen'),
            'indstatus'   => $request->input('indStatus'),
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

        $update = Paises::where(['id' => $request->input('id')])->update([
            'nome'      => $request->input('nome'),
            'nomept'    => $request->input('nomePt'),
            'sigla'     => $request->input('sigla'),
            'bacen'     => $request->input('bacen'),
            'indstatus' => $request->input('indStatus'),
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

        $delete = Paises::where(['id' => $id])->update([
            'indstatus'=>'I',
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
                'nome'       => 'required|max:100',
                'nomePt'       => 'required|max:100',
                'sigla'       => 'required|max:2',
                'bacen'       => 'required|integer',
                'indStatus'  => 'sometimes|required',
            ];

            $messages = ['required' => ':attribute é obrigatório.'];

            $customAttributes = [
                'nome' => Config::get('label.pais_nome_global'),
                'nomePt' => Config::get('label.pais_nome_nacional'),
                'sigla' => Config::get('label.pais_sigla'),
                'bacen' => Config::get('label.pais_bacen'),
                'indStatus' => Config::get('label.status'),
            ];

            $request->validate($rules, $messages, $customAttributes);
    }
}
