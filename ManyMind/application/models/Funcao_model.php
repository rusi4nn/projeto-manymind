<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Funcao_model extends CI_Model {
        
        // Metódo para retornar todas as funções
        public function index() {

           return $this->db->get("tb_funcao")->result_array();
        }

        // metódo para retornar colaboradores com uma determinada função
        public function pegaUsuarioFuncao($id) {
            $query = "
                SELECT
                    c.nome,
                    c.id,
                    c.id_status
                FROM
                    tb_colaboradores as c
                    INNER JOIN tb_funcao as f ON (c.id_funcao = f.id)
                    INNER JOIN tb_status as s ON (c.id_status = s.id)
                WHERE
                    f.id = ? AND c.id_status = 1
            ";
            $result = $this->db->query($query, $id);
            return $result->result_array();
        }

        // pega o numero de usuarios com uma determinada função
        public function pegaNumFuncao($id) {
            $query = "
                SELECT
                    c.id
                FROM
                    tb_colaboradores as c
                    INNER JOIN tb_funcao as f ON (c.id_funcao = f.id)
                WHERE
                    f.id = ?
            ";
            $result = $this->db->query($query, $id);
            return $result->num_rows();
        }
    }


?>