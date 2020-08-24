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

class UsuarioController extends Controller{
    public function __construct(){
        $this->usuarios = new Usuarios();
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
      
       return view('admin.reservista.cadastrar');
    }
    
    public function store(Request $request){
        $senhaAleatoria = UtilsController::geraSenhaAleatoria();

        $usuPermissao = $request->input('usuPermissao');
        $indStatus = 'A';

        $this->validaCampos($request, 'i');
        
        $insert = Usuarios::create([
            'usupermissao'        => $usuPermissao,
            'name'                => $request->input('name'),
            'usucpf'              => UtilsController::apenasNumeros($request->input('usuCPF')),
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
            'usuimagemurl'        => NULL,
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
        $usuario = $this->usuarios->getUsuario($idusuario);
        return view('admin.reservista.editar')->with(compact('usuario'));
    }
    
    public function update(Request $request){
        $usuario = $this->usuarios->getUsuario($request->input('idUsuario'));
        $usuPermissao = $request->input('usuPermissao');
        
        $this->validaCampos($request, 'u');
        
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
            'usuimagemurl'        => NULL,
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
                'usuLinkedinUrl'        => 'required'
            ];
    
            $messages = ['required' => 'Campo obrigatório.'];
    
            $customAttributes = [];
            
            $request->validate($rules, $messages, $customAttributes);

        }catch (Exception $exception) {

            $activeTab = 0;
            $indSai = false;  
  
            $errors = $exception->errors();
                    
            if ($errors) {
                $fields_tabs = [
                    ['usuPermissao', 'name', 'usuCPF', 'usuDtNascimento', 'usuEstadoCivil', 'usuGenero', 'usuIndPortDeficiente', 'email', 'usuTelCelular', 'usuIndViagem', 'usuIndMudarCidade'], // Tab 1
                    ['usuTipoForca', 'usuIndOficial', 'usuCertReservista', 'usuPostoGrad', 'usuNomeGuerra', 'usuNomeUltBtl'], // Tab 2
                    ['usuLinkedinUrl'], //Tab 3
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
