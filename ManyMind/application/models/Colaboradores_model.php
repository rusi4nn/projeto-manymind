<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Colaboradores_model extends CI_Model {
        
        // Realiza a inserção de um colaborador no banco de dados
        public function store($dados) {

            if(strlen($dados['nome']) >= 3 && strlen($dados['usuario']) >= 3 && strlen($dados['senha']) >= 3) {
                $query = "SELECT usuario FROM tb_colaboradores WHERE usuario = ?";
                $result = $this->db->query($query, array($dados['usuario']));
                if($result->num_rows() > 0) {
                    return false;
                } else {
                    if($this->db->insert('tb_colaboradores', $dados)) {
                        return true;
                    } else {
                        return false;
                    }
                }
                
            } else {
                return false;
            }
        }
        
        // ->Metódo que retorna todos os dados de uma tabela
        // public function selectAll($tabela, $start = null, $end = null) {
        //     if($start == null && $end == null) {
        //         return $sql = $this->db->query("SELECT * FROM $tabela")->result_array();
        //     } else {
        //         return $sql = $this->db->query("SELECT * FROM $tabela LIMIT $start,$end")->result_array();
        //     }
        // }

        // Realiza um inner join da tabela colaboradores com outras
        public function pegaDadosMultiplos($tabela, $tabela2, $tabela3 = null, $start = null, $end = null) {
            if($start == null && $end == null) {
                if($tabela3 != null) {
                    $query = "
                        SELECT
                            c.id,
                            c.id_status,
                            c.nome,
                            s.nome_status,
                            cr.nome_cargo
                        FROM
                            $tabela AS c
                            INNER JOIN $tabela2 AS s ON (c.id_status = s.id)
                            INNER JOIN $tabela3 AS cr ON (c.id_cargo = cr.id)
                            ORDER BY
                                s.id DESC

                    ";
                } else {
                    $query = "
                        SELECT
                            c.id,
                            c.id_status,
                            c.nome,
                            s.nome_status
                        FROM
                            $tabela AS c
                            INNER JOIN $tabela2 AS s ON (c.id_status = s.id)
                            ORDER BY
                                s.id DESC

                    ";
                }
            } else {
                if($tabela3 != null) {
                    $query = "
                        SELECT
                            c.id,
                            c.nome,
                            c.id_status,
                            s.nome_status,
                            cr.nome_cargo
                        FROM
                            $tabela AS c
                            INNER JOIN $tabela2 AS s ON (c.id_status = s.id)
                            INNER JOIN $tabela3 AS cr ON (c.id_cargo = cr.id)
                            ORDER BY
                                cr.id ASC
                            LIMIT $start, $end
                            

                    ";
                } else {
                    $query = "
                        SELECT
                            c.id,
                            c.id_status,
                            c.nome,
                            s.nome_status,
                        FROM
                            $tabela AS c
                            INNER JOIN $tabela2 AS s ON (c.id_status = s.id)
                            ORDER BY
                                cr.id ASC
                            LIMIT $start, $end
                            
                    ";
                }
            }
            $result = $this->db->query($query);

            return $result->result_array();
        }

        // recupera dados de um determinado colaborador
        public function show($id) {
            return $this->db->get_where("tb_colaboradores", array(
                "id" => $id
            ))->row_array();
        }

        // atualiza um colaborador no banco
        public function update($id, $dados) {
            if(strlen($dados['nome']) >= 3 && strlen($dados['usuario']) >= 3 && strlen($dados['senha']) >= 3) {
                $this->db->where("id", $id);
                if($this->db->update('tb_colaboradores',$dados)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // ativa um colaborador
        public function ativar($id) {
            $query = "UPDATE tb_colaboradores SET id_status = 1 WHERE id = ?";
            return $this->db->query($query, $id);
        }

        // inativa um colaborador
        public function inativar($id) {

            $query = "UPDATE tb_colaboradores SET id_status = 2 WHERE id = ?";
            return $this->db->query($query, $id);
        }

        // Retorna o numero de registros no banco de dados
        public function numTodos() {
            $query = $this->db->query("SELECT id FROM tb_colaboradores");
            return $query->num_rows();
        }
    }


?>