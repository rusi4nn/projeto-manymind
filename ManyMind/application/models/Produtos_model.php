<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Produtos_model extends CI_Model {
        
        // cadastra um produto no banco de dados
        public function store($dados) {

            if(strlen($dados['nome_produto']) >= 3 && $dados['id_fornecedor'] != 0 && $dados['id_status'] > 0) {
                if($this->db->insert('tb_produtos', $dados)) {
                    return true;
                }
            }
        }

        // realiza um innner join da tabela usuario com outras
        public function pegaDadosMultiplos($tabela, $tabela2, $tabela3 = null, $start = null, $end = null) {
            if($start == null && $end == null) {
                if($tabela3 != null) {
                    $query = "
                        SELECT
                            p.id,
                            p.id_status,
                            p.nome_produto,
                            f.nome
                        FROM
                            $tabela AS p
                            INNER JOIN $tabela2 AS f ON (p.id_fornecedor = f.id)
                            INNER JOIN $tabela3 AS cr ON (c.id_cargo = cr.id)
                        WHERE 
                            f.id_status = 1

                    ";
                    // Caso for utilizar 3 tabelas, atualizar o alias da 3 tabela e adaptar o restante da query
                } else {
                    $query = "
                        SELECT
                            p.id,
                            p.id_status,
                            p.nome_produto,
                            f.nome
                        FROM
                            $tabela AS p
                            INNER JOIN $tabela2 AS f ON (p.id_fornecedor = f.id)
                        WHERE 
                            f.id_status = 1

                    ";
                }
            } else {
                if($tabela3 != null) {
                    $query = "
                        SELECT
                            p.id,
                            p.id_status,
                            p.nome_produto,
                            f.nome
                        FROM
                            $tabela AS p
                            INNER JOIN $tabela2 AS f ON (p.id_fornecedor = f.id)
                            INNER JOIN $tabela3 AS cr ON (c.id_cargo = cr.id)
                            LIMIT $start, $end

                    ";
                    // Caso for utilizar 3 tabelas, atualizar o alias da 3 tabela e adaptar o restante da query
                } else {
                    $query = "
                        SELECT
                            p.id,
                            p.id_status,
                            p.nome_produto,
                            f.nome
                        FROM
                            $tabela AS p
                            INNER JOIN $tabela2 AS f ON (p.id_fornecedor = f.id)
                            LIMIT $start, $end
                    ";
                }
            }
            $result = $this->db->query($query);

            return $result->result_array();
        }

        // recupera os dados de um produto em específico
        public function show($id) {
            return $this->db->get_where("tb_produtos", array(
                "id" => $id
            ))->row_array();
        }

        // atualiza um produto em específico no banco de dados
        public function update($id, $dados) {
            if(strlen($dados['nome_produto']) >= 3 && $dados['id_fornecedor'] > 0) {
                $this->db->where("id", $id);
                if($this->db->update('tb_produtos',$dados)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // ativa um produto
        public function ativar($id) {
            $query = "UPDATE tb_produtos SET id_status = 1 WHERE id = ?";
            return $this->db->query($query, $id);
        }

        // desativa um produto
        public function inativar($id) {

            $query = "UPDATE tb_produtos SET id_status = 2 WHERE id = ?";
            return $this->db->query($query, $id);
        }
    }


?>