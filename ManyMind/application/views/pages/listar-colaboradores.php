<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="box-content">
        <h2><i class="fas fa-id-badge"></i> Colaboradores Cadastrados</h2>

        <div class="wrapper-table">
            <table>
                <tr>
                    <td>Nome</td>
                    <td>Cargo</td>
                    <td>Status</td>
                    <td>#</td>
                    <td>#</td>
                </tr>

                <?php foreach($colaboradores as $key => $value) : ?>
                <tr>
                    <td><?= $value['nome'] ?></td>
                    <td><?= $value['nome_cargo'] ?></td>
                    <td><?= $value['nome_status'] ?></td>
                    <td><a class="btn edit" href="<?= base_url('/AppController/editarColaborador/'.$value['id']) ?>"><i class="fas fa-user-edit"></i></a></td>
                    <?php if($value['id_status'] == '1') {?>
                        <td><a class="btn inativar" href="<?= base_url('/AppController/inativarColaborador/'.$value['id']) ?>"><i class="fas fa-user-alt-slash"></i> Inativar</a></td>
                    <?php } else if($value['id_status'] == '2') { ?>
                        <td><a class="btn ativar" href="<?= base_url('/AppController/ativarColaborador/'.$value['id']) ?>"><i class="fas fa-user-check"></i> Ativar</a></td>
                    <?php } ?>
                </tr>

                <?php endforeach ?>

            </table>
        </div>

        <div class="paginacao">
        <?php

            for($i = 1; $i <= $totalPaginas; $i++) {
                if($i == $paginaAtual) {
                    echo '<a class="page-selected" href="'.base_url('').'AppController/listarColaboradores/'.$i.'">'.$i.'</a>';
                } else {
                    echo '<a href="'.base_url('').'AppController/listarColaboradores/'.$i.'">'.$i.'</a>';
                }
            }

        ?>
        </div>
    </div>
</div>