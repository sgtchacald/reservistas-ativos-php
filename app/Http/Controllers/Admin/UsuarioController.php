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
                //dd($usuarios);
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
            
      try {
          Usuarios::create([
              'permissao_usuario'           => $request->input('permissaoUsuario'),
              'nome_completo'               => $request->input('nomeCompleto'),
              'cpf'                         => UtilsController::apenasNumeros($request->input('cpf')),
              'dt_nascimento'               => Carbon::parse($request->input('dtNascimento'))->format('Y-m-d H:i'),
              'estado_civil'                => $request->input('estadoCivil'),
              'sexo'                        => $request->input('sexo'),
              'ind_portador_deficiencia'    => $request->input('indPortadorDeficiencia'),
              'email'                       => $request->input('email'),
              'telefone_celular'            => UtilsController::apenasNumeros($request->input('telefoneCelular')),
              'telefone_residencial'        => UtilsController::apenasNumeros($request->input('telefoneResidencial')),
              'ind_disponivel_viagem'       => $request->input('indDisponivelViagem'),
              'ind_disponivel_mudar_cidade' => $request->input('indDisponivelMudarCidade'),
              'ind_celular_whatsapp'        => SimNao::retornaSimNaoSeVazio($request->input('indCelularWhatsapp')),
              'ind_msg_whatssap'            => SimNao::retornaSimNaoSeVazio($request->input('indMsgWhatsapp')),
              'url_imagem'                  => NULL,
              'tipo_forca'                  => SimNao::retornaSimNaoSeVazio($request->input('tipoForca')),
              'ind_oficial'                 => $request->input('indOficial'),
              'certificado_reservista'      => $request->input('certificadoReservista'),
              'posto_graduacao'             => $request->input('postoGraduacao'),
              'nome_de_guerra'              => $request->input('nomeDeGuerra'),
              'nome_ultimo_batalhao'        => $request->input('nomeUltimoBatalhao'),
              'url_linkedin'                => $request->input('urlLinkedIn'),
              'url_facebook'                => $request->input('urlFacebook'),
              'url_instagram'               => $request->input('urlInstagram'),
              'url_twitter'                 => $request->input('urlTwitter'),
              'url_youtube'                 => $request->input('urlYoutube'),
              'url_blog_site'               => $request->input('urlBlogSite'),
              'password'                    => Hash::make($senhaAleatoria),
              'usuario_id_created'          => Auth::user()->getAuthIdentifier(),
              'created_at'                  => date('Y-m-d H:i:s'),
              'ind_status'                  => 'A'
          ]);
      } catch (Throwable $e) {
          $indErro = true;
      }
      
      if($indErro){
          $request->session()->flash('alert-danger', "Erro Inesperado, verifique o log de registros.");
          $request->session()->flash('alert-warning', "Para verificar o Log de registros acesse o caminho: CAMINHO_LOG.");
          return view('admin.reservista.cadastrar');
      }else{
          $request->session()->flash('alert-success', 'Dados criados com sucesso.');
          //return index('R','A');
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
