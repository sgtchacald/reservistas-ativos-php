<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Usuarios extends Authenticatable{
    use Notifiable;

    protected $primaryKey = 'id';
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
        'tipopermissao',
        //Informacoes Civis
        'name',
        'cpf',
        'dtnascimento',
        'estadocivil',
        'genero',
        'indportadordeficiencia',
        'email',
        'telefonecelular',
        'telefonefixo',
        'indviagem',
        'indmudarcidade',
        'indcelwhatsapp',
        'indrecebermsg',
        'urlfotoanexo',
        //Informacoes militares
        'tipoforca',
        'indoficial',
        'nrcertificado',
        'urlcertificadoanexo',
        'postograduacao',
        'nomeguerra',
        'nomeultimobtl',
        //Informações Geográficas
        'idlogradouro',
        //Informações Sociais
        'resumoprofissional',
        //Informações Sociais
        'urllinkedin',
        'urlfacebook',
        'urlinstagram',
        'urltwitter',
        'urlyoutube',
        'urlblogsite',
        //Informações Segurança Usuário
        'dtverificacaoemail',
        'password',
        'indstatus',
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
        'password', 'remember_token'
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
            $descricaoUsuarioLogado =
                (\App\Dominios\TipoForca::getDominio())[$usuarioLogado->tipoforca]
                . " - "
                . $usuarioLogado->nomeultimobtl
                . " - "
                . (\App\Dominios\PostoGraduacao::getDominio())[$usuarioLogado->postograduacao];
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
                    ->select('*')
                    ->where('tipopermissao','=', $permissaoUsuario)
                    ->where('indstatus','=', $indStatus)
                    ->orderBy('id','desc')
                    ->get();
    }

    public function getUsuario($id){
        return DB::table('USUARIOS')
                ->where('id','=', $id)
                ->get();
    }

    public function getUsuarioLogado(){
        return DB::table('USUARIOS')
                ->where('id', '=', auth()->user()->id)
                ->get();
    }

    public static function getNomeUsuario($id){
        $query = DB::table('USUARIOS')
                ->select('name')
                ->where('id','=', $id)
                ->get();

        return $query[0]->name;
    }

    public static function getEmailUsuario($id){
        $query = DB::table('USUARIOS')
                ->select('email')
                ->where('id','=', $id)
                ->get();

        return $query[0]->email;
    }

    public static function getidByCPF($cpf){
        $query = DB::table('USUARIOS')
                ->select('id')
                ->where('cpf','=', $cpf)
                ->get();

        return ($query != null) ? $query[0]->id : '';
    }

    public static function verificaSeExisteCPF($cpf){
        $query = DB::table('USUARIOS')
                ->where('cpf','=', $cpf)
                ->count();
        return  $query > 0 ? false : true;
    }

}
