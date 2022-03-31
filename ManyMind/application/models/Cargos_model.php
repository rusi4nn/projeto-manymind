<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Cargos_model extends CI_Model {
        
        // Retorna todos os cargos
        public function index() {
            return $this->db->get("tb_cargos")->result_array();
        }

        // Retorna o numero de colaboradores com um determinado cargo
        public function pegaNumCargo($id) {
            $query = "
                SELECT
                    c.id
                FROM
                    tb_colaboradores as c
                    INNER JOIN tb_cargos as f ON (c.id_funcao = f.id)
                WHERE
                    f.id = ?
            ";
            $result = $this->db->query($query, $id);
            return $result->num_rows();
        }
    }


?>