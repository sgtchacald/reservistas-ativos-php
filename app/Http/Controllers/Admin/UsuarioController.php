<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Usuarios;
use App\Dominios\SimNao;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\UtilsController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

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

        $indErro = false;
        $usuPermissao = $request->input('usuPermissao');
        $indStatus = 'A';

        echo 'Teste: '.$usuPermissao;

        $rules = [
            'usuPermissao'          => 'bail|required',
            'name'                  => 'bail|required',
            'usuCPF'                => 'bail|required|unique:USUARIOS',
            'usuDtNascimento'       => 'bail|required',
            'usuEstadoCivil'        => 'bail|required',
            'usuGenero'             => 'bail|required',
            'usuIndPortDeficiente'  => 'bail|required',
            'email'                 => 'bail|required|unique:USUARIOS|email',
            'usuTelCelular'         => 'bail|required',
            'usuTelFixo'            => 'bail|required',
            'usuIndViagem'          => 'bail|required',
            'usuIndMudarCidade'     => 'bail|required',
            //'usuimagemurl'          => 'bail|required',
            'usuTipoForca'          => 'bail|required',
            'usuIndOficial'         => 'bail|required',
            'usuCertReservista'     => 'bail|required',
            'usuPostoGrad'          => 'bail|required',
            'usuNomeGuerra'         => 'bail|required',
            'usuNomeUltBtl'         => 'bail|required',
            'usuLinkedinUrl'        => 'bail|required'
        ];

        $messages = [];

        $customAttributes = [
            'usuPermissao'          => 'Perfil de Usuário',
            'name'                  => 'Nome Completo',
            'usuCPF'                => 'CPF',
            'usuDtNascimento'       => 'Dt Nascimento',
            'usuEstadoCivil'        => 'Estado Civil',
            'usuGenero'             => 'Genero',
            'usuIndPortDeficiente'  => 'Port. Deficiência',
            'email'                 => 'E-mail',
            'usuTelCelular'         => 'Telefone Celular',
            'usuTelFixo'            => 'Telefone Fixo',
            'usuIndViagem'          => 'Disponível para viajar?',
            'usuIndMudarCidade'     => 'Disponível para mudar de cidade?',
            'usuimagemurl'          => 'Imagem',
            'usuTipoForca'          => 'Força de Origem',
            'usuIndOficial'         => 'Sou Oficial?',
            'usuCertReservista'     => 'Certificado Reservista',
            'usuPostoGrad'          => 'Post/Grad:',
            'usuNomeGuerra'         => 'Nome de Guerra',
            'usuNomeUltBtl'         => 'Ultimo batalhão que serviu',
            'usuLinkedinUrl'        => 'Linked In'
        ];

        $this->validate($request,$rules,$messages,$customAttributes);

        try {
            Usuarios::create([
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
        } catch (Throwable $e) {
            $indErro = true;
        }
      
        if($indErro){
            $request->session()->flash('alert-danger', "Erro Inesperado, verifique o log de registros." . $e);
            //$request->session()->flash('alert-warning', "Para verificar o Log de registros acesse o caminho: CAMINHO_LOG.");
            return view('admin.reservista.cadastrar');
        }else{
            $request->session()->flash('alert-success', 'Dados criados com sucesso.');
            
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
            return redirect()->route($rota, ['permissaoUsuario' => $usuPermissao,'indStatus' => $indStatus]);
        }
    }
    
    public function edit(){
    }
    
    public function update(){
    }
    
    public function destroy(){
    }
}
