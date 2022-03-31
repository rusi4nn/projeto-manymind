<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Status_model extends CI_Model {
        
        // retorna todos os status da tabela
        public function index() {

           return $this->db->get("tb_status")->result_array();
        }
    }


?>