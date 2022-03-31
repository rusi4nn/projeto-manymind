<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="box-content">
        <h2><i class="fas fa-id-badge"></i> Produtos Cadastrados</h2>

        <div class="wrapper-table">
            <table>
                <tr>
                    <td>Produto</td>
                    <td>Fornecedor</td>
                    <td>#</td>
                    <td>#</td>
                </tr>

                <?php foreach($produtos as $key => $value) : ?>
                    <tr>
                        <td><?= $value['nome_produto'] ?></td>
                        <td><?= $value['nome'] ?></td>
                        <td><a class="btn edit" href="<?= base_url('/AppController/editarProduto/'.$value['id']) ?>"><i class="fas fa-edit"></i></a></td>
                        <?php if($idCargo == 1) { ?>
                            <?php if($value['id_status'] == '1') { ?>
                                <td><a class="btn inativar" href="<?= base_url('/AppController/inativarProduto/'.$value['id']) ?>"><i class="fas fa-user-alt-slash"></i> Inativar</a></td>
                            <?php } else if($value['id_status'] == '2') { ?>
                                <td><a class="btn ativar" href="<?= base_url('/AppController/ativarProduto/'.$value['id']) ?>"><i class="fas fa-user-alt-slash"></i> Ativar</a></td>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                <?php endforeach ?>

            </table>
        </div>

        <div class="paginacao">
        <?php

            for($i = 1; $i <= $totalPaginas; $i++) {
                if($i == $paginaAtual) {
                    echo '<a class="page-selected" href="'.base_url('').'AppController/listarProdutos/'.$i.'">'.$i.'</a>';
                } else {
                    echo '<a href="'.base_url('').'AppController/listarProdutos/'.$i.'">'.$i.'</a>';
                }
            }

        ?>
        </div>
    </div>
</div>