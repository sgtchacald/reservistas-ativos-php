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
    
    public function index($permissaoUsuario, $indStatus){
       
        $usuarios =  $this->usuarios->getUsuarios($permissaoUsuario, $indStatus);
        
        switch ($permissaoUsuario) {
            case 'R':
                return view('admin.reservista.selecionar')->with(compact('usuarios'));
                break;
            case 'E':
                return view('admin.representanteempresas.selecionar')->with(compact('usuarios'));
                break;
            case 'A':
                return view('admin.usuarios.selecionar')->with(compact('usuarios'));
                break;
        }
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

        $request->validate([
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
            'usuLinkedinUrl'        => 'bail|required',
        ]);
            
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
                    $rota = 'reservista.selecionar';
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
    
    public function testaValoresEmTela(Request $request){
        echo "permissaoUsuario: "           . $request->input('permissaoUsuario') . '<br>';
        echo "nomeCompleto: "               . $request->input('nomeCompleto') . '<br>';
        echo "cpf: "                        . UtilsController::apenasNumeros($request->input('cpf')) . '<br>';
        echo "dtNascimento: "               . Carbon::parse($request->input('dtNascimento'))->format('d-m-Y') . '<br>';
        echo "estadoCivil: "                . $request->input('estadoCivil') . '<br>';
        echo "sexo: "                       . $request->input('sexo') . '<br>';
        echo "indPortadorDeficiencia: "     . $request->input('indPortadorDeficiencia') . '<br>';
        echo "email: "                      . $request->input('email') . '<br>';
        echo "telefoneCelular: "            . UtilsController::apenasNumeros($request->input('telefoneCelular')) . '<br>';
        echo "telefoneResidencial: "        . UtilsController::apenasNumeros($request->input('telefoneResidencial')) . '<br>';
        echo "indDisponivelViagem: "        . $request->input('indDisponivelViagem') . '<br>';
        echo "indDisponivelMudarCidade: "   . $request->input('indDisponivelMudarCidade') . '<br>';
        echo "indCelularWhatsapp: "         . SimNao::retornaSimNaoSeVazio($request->input('indCelularWhatsapp')) . '<br>';
        echo "indMsgWhatsapp: "             . SimNao::retornaSimNaoSeVazio($request->input('indMsgWhatsapp')) . '<br>';
        echo "tipoForca: "                  . $request->input('tipoForca') . '<br>';
        echo "certificadoReservista: "      . $request->input('certificadoReservista') . '<br>';
        echo "postoGraduacao: "             . $request->input('postoGraduacao') . '<br>';
        echo "nomeDeGuerra: "               . $request->input('nomeDeGuerra') . '<br>';
        echo "nomeUltimoBatalhao: "         . $request->input('nomeUltimoBatalhao') . '<br>';
        echo "urlLinkedIn: "                . $request->input('urlLinkedIn') . '<br>';
        echo "urlFacebook: "                . $request->input('urlFacebook') . '<br>';
        echo "urlInstagram: "               . $request->input('urlInstagram') . '<br>';
        echo "urlTwitter: "                 . $request->input('urlTwitter') . '<br>';
        echo "urlBlogSite: "                . $request->input('urlBlogSite') . '<br>';      
    }
}
