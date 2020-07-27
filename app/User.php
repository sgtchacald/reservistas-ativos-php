<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $primaryKey = 'usuario_id';
    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'usuario_id',
        'empresa_id',
        'permissao_usuario',
        'ind_oficial',
        'certificado_reservista',
        'tipo_forca',
        'posto_graduacao',
        'nome_de_guerra',
        'nome_ultimo_batalhao',
        'cpf',
        'nome_completo',
        'dt_nascimento',
        'estado_civil',
        'sexo',
        'email',
        'telefone_residencial',
        'telefone_celular',
        'ind_celular_whatsapp',
        'ind_msg_whatssap',
        'ind_portador_deficiencia',
        'url_imagem',
        'url_linkedin',
        'url_facebook',
        'url_twitter',
        'url_youtube',
        'url_instagram',
        'url_blog_site',
        'ind_disponivel_viagem',
        'ind_disponivel_mudar_cidade',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'usuario_id_created',
        'usuario_id_updated',
        'usuario_id_deleted',
        'ind_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function adminlte_image(){
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc(){
        return 'That\'s a nice guy';
    }
    
    public function adminlte_profile_url(){
        return 'profile/username';
    }
    
}
