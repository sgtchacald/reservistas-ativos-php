<?php

namespace App\Http\Controllers\Admin;

use App\Idiomas;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\UtilsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;


class IdiomaController extends Controller{
    public function __construct(){
        $this->idioma = new Idiomas();
    }

    public function index(){
        $idiomas =   $this->idioma->getIdiomas('A');
        return view('admin.idioma.selecionar')->with(compact('idiomas'));
    }


    public function show(){
    }

    public function create(){
       return view('admin.idioma.cadastrar');
    }

    public function store(Request $request){
        $this->validaCampos($request, 'i');

        $insert = Idiomas::create([
            'nome'        => $request->input('nome'),
            'indstatus'   => $request->input('indStatus'),
            'usucriou'            => Auth::user()->getAuthIdentifier(),
            'dtcadastro'          => date('Y-m-d H:i:s')
        ]);

        if($insert){
            $request->session()->flash('alert-success', Config::get('msg.cadastro_sucesso'));
            return redirect()->route('idioma.selecionar');
        }else{
            $ididioma =  $this->idioma->getIdiomas('A');
            $request->session()->flash('alert-danger', Config::get('msg.cadastro_erro'));
            return view('admin.idioma.selecionar')->with(compact('id'));
        }
    }

    public function edit($id){
        $idioma = $this->idioma->getIdiomaById($id);
        return view('admin.idioma.editar')->with(compact('idioma'));
    }

    public function update(Request $request){
        $this->validaCampos($request, 'u');

        $update = Idiomas::where(['id' => $request->input('id')])->update([
            'nome'      => $request->input('nome'),
            'indstatus' => $request->input('indStatus'),
            'usueditou'    => Auth::user()->getAuthIdentifier(),
            'dtedicao'     => date('Y-m-d H:i:s')
        ]);

        if($update){
            $request->session()->flash('alert-success', Config::get('msg.edicao_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.edicao_erro'));
        }

        return redirect()->route('idioma.selecionar');
    }

    public function destroy(Request $request, $id){

        $delete = Idiomas::where(['id' => $id])->update([
            'indstatus'=>'I',
            'usuexcluiu' => Auth::user()->getAuthIdentifier(),
            'dtexclusao'=> date('Y-m-d H:i:s')
        ]);

        if($delete){
            $request->session()->flash('alert-success', Config::get('msg.exclusao_sucesso'));
        }else{
            $request->session()->flash('alert-danger', Config::get('msg.exclusao_erro'));
        }

        return redirect()->route('idioma.selecionar');
    }

    public function validaCampos(Request $request, $tipoPersistencia){

            $rules = [
                'nome'       => 'required',
                'indStatus'  => 'sometimes|required',
            ];

            $messages = ['required' => ':attribute é obrigatório.'];

            $customAttributes = [
                'nome' => Config::get('label.nome'),
                'indStatus' => Config::get('label.status'),
            ];

            $request->validate($rules, $messages, $customAttributes);
    }

    public function getIdiomasOrderBy(){
        return $this->idioma->getIdiomasOrderBy('nome', 'asc', 'A')->toJson();
    }

    public function getIdiomaById($id){
        return $this->idioma->getIdiomaById($id);
    }
}
