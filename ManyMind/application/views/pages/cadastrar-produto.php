<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="box-content">
        <h2><i class="fas fa-user-edit"></i> Cadastrar produto</h2>

        <form method="POST" action="<?= base_url('AppController/storeProduto') ?>">

            <div class="form-group">
            <?php if(isset($mensagem) && $mensagem == 'sucesso') {
                echo '<div class="sucesso-box"><i class="fas fa-check"></i> Produto cadastrado com sucesso</div>';
            } else if(isset($mensagem) && $mensagem == 'erro') {
                echo '<div class="erro-box"><i class="fas fa-times"></i> Não foi possível cadastrar o produto</div>';
            }
            ?>
                <label for="nome">Nome:</label>
                <input type="text" name="nome_produto" placeholder="Produto...">
            </div>
            <div class="form-group">
                <label for="id_fornecedor">Fornecedor:</label>
                <select name="id_fornecedor" id="id_fornecedor">
                    <?php foreach($fornecedores as $key => $value) : ?>
                        <option value="<?= $value['id'] ?>"><?= $value['nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_status">Status:</label>
                <select name="id_status" id="id_status">
                    <?php foreach($status as $key => $value) : ?>
                        <option value="<?= $value['id'] ?>"><?= $value['nome_status'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</div>