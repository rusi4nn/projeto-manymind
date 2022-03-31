<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Login_model extends CI_Model {
        
        // método para verificar se existe um colaborador com determinado usuario e senha
        public function index($usuario,$senha) {

            $this->db->where("usuario", $usuario);
            $this->db->where("senha", $senha);
            $logado = $this->db->get("tb_colaboradores")->row_array();

            return $logado;
        }
    }


?>