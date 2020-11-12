<?php

namespace App\Http\Controllers\Admin;


use App\Usuarios;
use App\Dominios\SimNao;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\UtilsController;
use App\Rules\ValidaCpfUnico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use App\Http\Controllers\Admin\LogradouroController;
use App\Http\Controllers\Admin\IdiomasUsuarioController;
use App\Estados;
use App\Cidades;
use App\Logradouros;
use Config;


class UsuarioController extends Controller{
    public function __construct(){
        $this->usuarios = new Usuarios();
        $this->estados = new Estados();
        $this->cidades = new Cidades();
        $this->logradouros = new Logradouros();
        $this->logradouroController = new LogradouroController();
        $this->idiomaController = new IdiomaController();
        $this->idiomasUsuarioController = new IdiomasUsuarioController();
    }

    public function index(){
    }

    public function getUsuariosReservistasAtivos(){
        $usuarios =   $this->usuarios->getUsuarios('R','A');
        return view('admin.reservista.selecionar')->with(compact('usuarios'));
    }

    public function show(){
    }

    public function create(){
        $estados          = $this->estados->getEstadosByStatus('A');
        $cidades          = $this->cidades->getCidadesByStatus('A');
        $idiomaController = $this->idiomaController;

        return view('admin.reservista.cadastrar')->with(compact('estados','cidades','idiomaController'));
    }

    public function store(Request $request){

        $senhaAleatoria = UtilsController::geraSenhaAleatoria();

        $usuPermissao = $request->input('usuPermissao');
        $indStatus = 'A';
        $idiomasUsuario = $request->input('idiomasUsuario');
        $usuCPF = UtilsController::apenasNumeros($request->input('usuCPF'));

        $this->validaCampos($request, 'i');

        $logradouroUsuario = $this->logradouroController->inserirLogradouro($request);

        $insert = Usuarios::create([
            'usupermissao'        => $usuPermissao,
            'name'                => $request->input('name'),
            'usucpf'              => $usuCPF,
            'usudtnascimento'     => Carbon::parse($request->input('usuDtNascimento'))->format('Y-m-d H:i'),
            'usuestadocivil'      => $request->input('usuEstadoCivil'),
            'usugenero'           => $request->input('usuGenero'),
            'usuindportdeficiente'=> $request->input('usuIndPortDeficiente'),
            'email'               => $request->input('email'),
            'usutelcelular'       => UtilsController::apenasNumeros($request->input('usuTelCelular')),
            'usutelfixo'          => UtilsController::apenasNumeros($request->input('usuTelFixo')),
            'usuindviagem'        => $request->input('usuIndViagem'),
            'usuindmudarcidade'   => $request->input('usuIndMudarCidade'),
            'usuindcelwhatsapp'   => SimNao::retornaSimNaoSeVazio($request->input('usuIndCelWhatsapp')),
            'usuindmsg'           => SimNao::retornaSimNaoSeVazio($request->input('usuIndMsg')),
            'usuresumo'           => $request->input('usuResumo'),
            'usuimagemurl'        => NULL,
            'idlogradouro'        => $logradouroUsuario,
            'usutipoforca'        => $request->input('usuTipoForca'),
            'usuindoficial'       => $request->input('usuIndOficial'),
            'usucertreservista'   => $request->input('usuCertReservista'),
            'usupostograd'        => $request->input('usuPostoGrad'),
            'usunomeguerra'       => $request->input('usuNomeGuerra'),
            'usunomeultbtl'       => $request->input('usuNomeUltBtl'),
            'usulinkedinurl'      => $request->input('usuLinkedinUrl'),
            'usufacebookurl'      => $request->input('usuFacebookUrl'),
            'usuinstagramurl'     => $request->input('usuInstagramUrl'),
            'usutwitterurl'       => $request->input('usuTwitterUrl'),
            'usuyoutubeurl'       => $request->input('usuYoutubeUrl'),
            'usublogsiteurl'      => $request->input('usuBlogSiteUrl'),
            'password'            => Hash::make($senhaAleatoria),
            'usuindstatus'        => $indStatus,
            'usucriou'            => Auth::user()->getAuthIdentifier(),
            'dtcadastro'          => date('Y-m-d H:i:s')
        ]);

        if(!$insert){
            $request->session()->flash('alert-danger', "Erro Inesperado, verifique o log de registros.");
            return view('admin.reservista.selecionar')->with(compact('usuario'));
        }else{

            $request->session()->flash('alert-success', 'Inclusão' .' efetuada com sucesso.');

            //Endereço do usuário
            if($logradouroUsuario == ""){
                $request->session()->flash('alert-warning', "Não foi possível inserir os dados de LOCALIZAÇÃO GEORÁFICA, verifique com a administração!");
            }

            //idiomas do usuario
            $idiomasUsuario = json_decode($request->input('jsonIdiomas', true));
            $idUsuario = $this->usuarios->getIdUsuarioByCPF($usuCPF);
            if(isset($usuCPF)){
                if(!$this->idiomasUsuarioController->store($idiomasUsuario, $idUsuario)){
                    $request->session()->flash('alert-warning', "Não foi possível inserir os dados de IDIOMAS, verifique com a administração!");
                }
            }

            switch ($usuPermissao) {
                case 'R':
                    $rota = 'reservistas.selecionar';
                    break;
                case 'E':
                    $rota = 'rep.empresa.selecionar';
                    break;
                case 'A':
                    $rota = 'administrador.selecionar';
                    break;
            }
            return redirect()->route($rota, ['permissaoUsuario' => $usuPermissao,'indStatus' => 'A']);
        }
    }

    public function edit($idusuario){
        $usuario    = $this->usuarios->getUsuario($idusuario);
        $estados    = $this->estados->getEstadosByStatus('A');
        $cidades    = $this->cidades->getCidadesByStatus('A');
        $logradouro = $this->logradouros->getLogradouroById($usuario[0]->idlogradouro);

        $logTipo    = count($logradouro) > 0 ? explode(" ", $logradouro[0]->lognome)[0] : "";
        $logNome    = count($logradouro) > 0 ? explode(",", $logradouro[0]->lognome)[0] : "";
        $logNumero  = count($logradouro) > 0 ? explode(",", $logradouro[0]->lognome)[1] : "";

        return view('admin.reservista.editar')->with(compact('usuario', 'estados', 'cidades', 'logradouro', 'logNome', 'logTipo', 'logNumero'));
    }

    public function update(Request $request){
        $usuario = $this->usuarios->getUsuario($request->input('idUsuario'));
        $usuPermissao = $request->input('usuPermissao');

        $this->validaCampos($request, 'u');

        $logradouroUsuario = $this->logradouroController->atualizarLogradouroUsuario($request);

        $update = Usuarios::where(['idusuario' => $request->input('idUsuario')])->update([
            'usupermissao'        => $usuPermissao,
            'name'                => $request->input('name'),
            //'usucpf'              => UtilsController::apenasNumeros($request->input('usuCPF')),
            'usudtnascimento'     => Carbon::parse($request->input('usuDtNascimento'))->format('Y-m-d'),
            'usuestadocivil'      => $request->input('usuEstadoCivil'),
            'usugenero'           => $request->input('usuGenero'),
            'usuindportdeficiente'=> $request->input('usuIndPortDeficiente'),
            'email'               => $request->input('email'),
            'usutelcelular'       => UtilsController::apenasNumeros($request->input('usuTelCelular')),
            'usutelfixo'          => UtilsController::apenasNumeros($request->input('usuTelFixo')),
            'usuindviagem'        => $request->input('usuIndViagem'),
            'usuindmudarcidade'   => $request->input('usuIndMudarCidade'),
            'usuindcelwhatsapp'   => SimNao::retornaSimNaoSeVazio($request->input('usuIndCelWhatsapp')),
            'usuindmsg'           => SimNao::retornaSimNaoSeVazio($request->input('usuIndMsg')),
            'usuresumo'           => $request->input('usuResumo'),
            'usuimagemurl'        => NULL,
            'idlogradouro'        => $logradouroUsuario,
            'usutipoforca'        => $request->input('usuTipoForca'),
            'usuindoficial'       => $request->input('usuIndOficial'),
            'usucertreservista'   => $request->input('usuCertReservista'),
            'usupostograd'        => $request->input('usuPostoGrad'),
            'usunomeguerra'       => $request->input('usuNomeGuerra'),
            'usunomeultbtl'       => $request->input('usuNomeUltBtl'),
            'usulinkedinurl'      => $request->input('usuLinkedinUrl'),
            'usufacebookurl'      => $request->input('usuFacebookUrl'),
            'usuinstagramurl'     => $request->input('usuInstagramUrl'),
            'usutwitterurl'       => $request->input('usuTwitterUrl'),
            'usuyoutubeurl'       => $request->input('usuYoutubeUrl'),
            'usublogsiteurl'      => $request->input('usuBlogSiteUrl'),
            //'password'            => Hash::make($senhaAleatoria),
            //'usuindstatus'        => $indStatus,
            'usueditou'            => Auth::user()->getAuthIdentifier(),
            'dtedicao'          => date('Y-m-d H:i:s')
        ]);

        if(!$update){
            $request->session()->flash('alert-danger', "Erro Inesperado, verifique o log de registros.");
            return view('admin.reservista.selecionar')->with(compact('usuario'));
        }else{
            $request->session()->flash('alert-success', 'Edição' .' efetuada com sucesso.');

            if($logradouroUsuario == ""){
                $request->session()->flash('alert-warning', "Não foi possível inserir os dados de LOCALIZAÇÃO GEORÁFICA, verifique com a administração!");
            }

            switch ($usuPermissao) {
                case 'R':
                    $rota = 'reservistas.selecionar';
                    break;
                case 'E':
                    $rota = 'rep.empresa.selecionar';
                    break;
                case 'A':
                    $rota = 'administrador.selecionar';
                    break;
            }

            return redirect()->route($rota, ['permissaoUsuario' => $usuPermissao,'indStatus' => 'A']);
        }

    }

    public function destroy(Request $request, $idusuario){
        $usuPermissao = $request->input('usuPermissao');

        $varOperacao = Usuarios::where(['idusuario' => $idusuario])
        ->update([
            'usuindstatus'=>'I',
            'usuexcluiu' => Auth::user()->getAuthIdentifier(),
            'dtexclusao'=> date('Y-m-d H:i:s')
        ]);

        if(!$varOperacao){
            $request->session()->flash('alert-danger', "Erro Inesperado, verifique o log de registros.");
            return view('admin.reservista.selecionar')->with(compact('usuario'));
        }else{
            $request->session()->flash('alert-success', 'Exclusão' .' efetuada com sucesso.');

            switch ($usuPermissao) {
                case 'R':
                    $rota = 'reservistas.selecionar';
                    break;
                case 'E':
                    $rota = 'rep.empresa.selecionar';
                    break;
                case 'A':
                    $rota = 'administrador.selecionar';
                    break;
            }
            return redirect()->route($rota, ['permissaoUsuario' => $usuPermissao,'indStatus' => 'A']);
        }
    }

    public function validaCampos(Request $request, $tipoPersistencia){

        $emailUsuarioBanco = $tipoPersistencia == 'u' ? $this->usuarios->getEmailUsuario($request->input('idUsuario')) : '';
        $emailUsuarioTela  = $tipoPersistencia == 'u' ? $request->input('email') : '';

        //Aba Localização Geográfica
        if (!empty($request->input('idIbgeCidade'))){
            session()->put('oldCidade', $request->input('idIbgeCidade'));
        }else{
            session()->put('oldCidade', "0");
        }


        try{
            $rules = [
                'usuPermissao'          => 'required',
                'name'                  => 'required',
                'usuCPF'                =>  $tipoPersistencia == 'i' ? ['required', new ValidaCpfUnico()] : '',
                'usuDtNascimento'       => 'required',
                'usuEstadoCivil'        => 'required',
                'usuGenero'             => 'required',
                'usuIndPortDeficiente'  => 'required',

                'email'                 =>
                    (
                     ($tipoPersistencia == 'i')
                     ||
                     ($tipoPersistencia == 'u' && ($emailUsuarioTela != $emailUsuarioBanco))
                    )
                    ? 'required|unique:USUARIOS|email'
                    : 'required',

                'usuTelCelular'         => 'required',
                //'usuTelFixo'            => 'required',
                'usuIndViagem'          => 'required',
                'usuIndMudarCidade'     => 'required',
                //'usuimagemurl'          => 'required',
                'usuTipoForca'          => 'required',
                'usuIndOficial'         => 'required',
                'usuCertReservista'     => $request->input('usuIndOficial') == 'N' ? 'required' : '',
                'usuPostoGrad'          => 'required',
                'usuNomeGuerra'         => 'required',
                'usuNomeUltBtl'         => 'required',
                'usuResumo'             => 'required',
                //Aba Idiomas
                //'idiomasUsuario'        => 'required',
                //'usuLinkedinUrl'        => 'required'

                //Aba Localização Geográfica
                'logCep'           => 'required|max:60',
                'logTipo'          => 'required|max:60',
                'logNome'          => 'required|max:60',
                'logNr'            => 'required|max:10',
                'logComplemento'   => 'max:100',
                'estUf'            => 'required|max:2',
                'idIbgeCidade'     => 'required',
                'logNomeBairro'    => 'required|max:100',
                'logIndStatus'     => 'required|max:1',
            ];

            $messages = ['required' => 'Campo obrigatório.'];

            $customAttributes = [
                'logCep'           => Config::get('label.logradouro_cep'),
                'logTipo'          => Config::get('label.logradouro_tipo'),
                'logNome'          => Config::get('label.logradouro_nome'),
                'logNr'            => Config::get('label.logradouro_nr'),
                'logComplemento'   => Config::get('label.logradouro_complemento'),
                'estUf'            => Config::get('label.logradouro_uf'),
                'idIbgeCidade'     => Config::get('label.logradouro_cidade'),
                'logNomeBairro'    => Config::get('label.logradouro_bairro'),
                'logindstatus'     => Config::get('label.status'),
                'idiomasUsuario'   => Config::get('label.idiomas'),
            ];

            $request->validate($rules, $messages, $customAttributes);

        }catch (Exception $exception) {

            $activeTab = 0;
            $indSai = false;

            $errors = $exception->errors();

            if ($errors) {
                $fields_tabs = [
                    ['usuPermissao', 'name', 'usuCPF', 'usuDtNascimento', 'usuEstadoCivil', 'usuGenero', 'usuIndPortDeficiente', 'email', 'usuTelCelular', 'usuIndViagem', 'usuIndMudarCidade'], // Tab 1
                    ['logCep','logTipo','logNome','logNr','logComplemento','estUf','idIbgeCidade','logNomeBairro','logIndStatus'], // Tab 2
                    ['usuTipoForca', 'usuIndOficial', 'usuCertReservista', 'usuPostoGrad', 'usuNomeGuerra', 'usuNomeUltBtl'], // Tab 3
                    ['usuResumo'], // Tab 4
                    ['idiomasUsuario'], // Tab 5
                    ['usuLinkedinUrl'], //Tab 6
                ];

                foreach ($fields_tabs as $tab => $fields) {
                    foreach ($fields as $field) {
                        if(array_key_exists($field, $errors)){
                            $activeTab = $tab;
                            $indSai = true;
                            break;
                        }
                    }
                    if($indSai){
                        break;
                    }
                }
            }

            session()->put('activeTab', $activeTab);

            $request->validate($rules, $messages, $customAttributes);
        }
    }
}
