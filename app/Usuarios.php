<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuarios extends Authenticatable{
    use Notifiable;
    
    protected $primaryKey = 'idusuario';
    protected $table = 'USUARIOS';
    
    const CREATED_AT = 'dtcadastro';
    const UPDATED_AT = 'dtedicao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idempresa',
        'usupermissao',
        //Informacoes Civis
        'usucpf',
        'name',
        'usudtnascimento',
        'usuestadocivil',
        'usugenero',
        'usuindportdeficiente',
        'email',
        'usutelcelular',
        'usutelfixo',
        'usuindviagem',
        'usuindmudarcidade',
        'usuindcelwhatsapp',
        'usuindmsg',
        'usuimagemurl',
        //Informacoes militares
        'usutipoforca',
        'usuindoficial',
        'usucertreservista',
        'usupostograd',
        'usunomeguerra',
        'usunomeultbtl',   
        //Informações Sociais
        'usulinkedinurl',
        'usufacebookurl',
        'usuinstagramurl',
        'usutwitterurl',
        'usuyoutubeurl',
        'usublogsiteurl',
        //Informações Segurança Usuário
        'usudtverificacaoemail',
        'password',            
        'usuindstatus',
        //Informações Segurança 
        'dtcadastro',
        'dtedicao',
        'dtexclusao',
        'usucriou',
        'usueditou',
        'usuexcluiu'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ususenha', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * MÉTODOS NECESSÁRIOS INFORMAÇÕES DO USUÁRIO PARA O TEMPLATE ADMIN LTE
     */

    public function adminlte_image(){
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc(){

        foreach ($this->getUsuarioLogado() as $usuarioLogado) {
            $descricaoUsuarioLogado = (\App\Dominios\PostoGraduacao::getDominio())[$usuarioLogado->usupostograd] . ' - ' . (\App\Dominios\TipoForca::getDominio())[$usuarioLogado->usutipoforca];
        }
        
        return $descricaoUsuarioLogado;
    }
    
    public function adminlte_profile_url(){
        return 'profile/username';
    }

    /**
     * Método para buscar todos os usuários
     */

    public function getUsuarios($permissaoUsuario, $indStatus){
        return DB::table('USUARIOS')
                ->where('usupermissao','=','R','and','usuindstatus','=','A')
                ->get();
    }

    public function getUsuarioLogado(){
        return DB::table('USUARIOS')
                ->where('idUsuario', '=', auth()->user()->idusuario)
                ->get();
    } 
    
}