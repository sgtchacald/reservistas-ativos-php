<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Usuarios extends Model {

    public function getUsuarios($tipo = null) {
        $query = DB::connection('MG')->table('usuarios')->whereNull('deleted_at');
        if ($tipo) {
            $query->where('tipo', $tipo);
        }
        return $query->get();
    }

    public function getUsuariosSelect($tipo = null) {
        $query = DB::connection('MG')->table('usuarios')->whereNull('deleted_at');
        if ($tipo) {
            $query->where('tipo', $tipo);
        }
        return $query->lists('nome', 'id');
    }

    public function getLoginSelect() {
        return DB::connection('MG')->table('usuarios')->lists('login', 'funcionario_id');
    }

    public function getIdUsuarios() {
        return DB::connection('MG')->table('usuarios')
                        ->where('funcionario_id', '<>', 'null')
                        ->lists('id', 'funcionario_id');
    }

    public function get_email_por_id($id) {
        return DB::connection('MG')->table('usuarios')
                        ->where('id', $id)
                        ->pluck('email');
    }

    public function get_email_por_id_funcionario($id) {
        return DB::connection('MG')->table('usuarios')
                        ->where('funcionario_id', $id)
                        ->pluck('email');
    }

    public function get_permissoes($id) {
        return DB::connection('MG')->table('permissao_opcoes_usuario')
                        ->where('usuario_id', $id)
                        ->lists('permissao_opcoes_id');
    }

    public function get_usuario_por_id($id) {
        return DB::connection('MG')->table('usuarios')
                        ->where('id', $id)
                        ->first();
    }

    public function get_usuario_por_id_funcionario($id) {
        return DB::connection('MG')->table('usuarios')
                        ->where('funcionario_id', $id)
                        ->first();
    }

    public function get_emails($ids) {
        if (is_array($ids)) {
            return DB::connection('MG')->table('usuarios')
                            ->whereIn('id', $ids)
                            ->lists('email');
        } else {
            return DB::connection('MG')->table('usuarios')
                            ->where('id', $ids)
                            ->pluck('email');
        }
    }

    public function get_usuario_por_email($email) {
        return DB::connection('MG')->table('usuarios')
                        ->where('email', $email)
                        ->whereNull('deleted_at')
                        ->first();
    }

    public function get_modulos_usuario($id) {
        return DB::connection('MG')->table('permissaousuarios')->where('usuario_id', $id)->lists('permissao_id');
    }
    
    public function get_inicio_data(){
        $Modulos        = new \App\Modulo;
        $Funcionario    = new \App\Funcionario();
        
        $data['modulos'] = \App\Permissaousuario::Modulo(Auth::user()->id);
        $modulos_usuarios = $this->get_modulos_usuario(Auth::user()->id);
        $aux_mod = [];
        foreach ($data['modulos'] as $key => $modulo) {
            $aux_mod[$modulo['id']]['descricao'] = $modulo['descricao'];
            $aux_mod[$modulo['id']]['rota'] = $modulo['rota'];
            
            $areas_mod = $Modulos->get_areas_modulo($modulo['id']);
            foreach ($areas_mod as $key => $area_modulo) {
                $aux_areas_per = [];
                $aux_areas_per['descricao'] = $area_modulo->descricao;
                $aux_areas_per['rota'] = $area_modulo->rota;
                $permissoes = $Modulos->get_permissoes($area_modulo->id);
                foreach ($permissoes as $key => $permissao) {
                    if(in_array($permissao->id, $modulos_usuarios)){
                        $aux_per['descricao'] = $permissao->descricao;
                        $aux_per['rota'] = $permissao->rota;
                        $aux_areas_per['permissoes'][] = $aux_per;
                    }
                }
                if(isset($aux_areas_per['permissoes'])){
                    $aux_mod[$modulo['id']]['areas'][$area_modulo->descricao] = $aux_areas_per;
                }
            }            
        }
        $data['modulos_es'] = $aux_mod;
        $data['usuario'] = Auth::user();
        $data['permissoes_opcoes'] = $this->get_permissoes(Auth::user()->id);
        
        $data['funcionario_logado'] = $Funcionario->getFuncionarioPorId2(Auth::user()->funcionario_id);
        $iniciais = explode(' ', $data['funcionario_logado']->nome);
        $aux_iniciais = [];
        foreach ($iniciais as $key => $value) {
            $aux_iniciais[] = substr($value, 0, 1);
            if ($key == 1) {
                break;
            }
        }
        $data['iniciais'] = implode('', $aux_iniciais);
        
        return $data;
    }
}
