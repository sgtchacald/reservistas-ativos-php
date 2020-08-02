<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuarios extends Authenticatable
{
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
        return 'That\'s a nice guy';
    }
    
    public function adminlte_profile_url(){
        return 'profile/username';
    }

    /**
     * Método para buscar todos os usuários
     */

    public function getUsuarios($indStatus,$permissaoUsuario){
        
        //return DB::table('usuarios')->where('ind_status' == $indStatus and 'permissao_usuario' == $permissaoUsuario)->get();
        return DB::table('USUARIOS')->get();
    }
    
}