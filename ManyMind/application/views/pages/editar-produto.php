<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="box-content">
        <h2><i class="fas fa-user-edit"></i> Editar produto</h2>

        <form method="POST" action="<?= base_url('AppController/updateProduto/'.$dados['id']) ?>">

            <div class="form-group">
            <?php if(isset($mensagem) && $mensagem == 'sucesso') {
                echo '<div class="sucesso-box"><i class="fas fa-check"></i> Produto editado com sucesso</div>';
            } else if(isset($mensagem) && $mensagem == 'erro') {
                echo '<div class="erro-box"><i class="fas fa-times"></i> Não foi possível editar o produto</div>';
            }
            ?>
                <label for="nome">Nome:</label>
                <input type="text" name="nome_produto" value="<?= $dados['nome_produto'] ?>" placeholder="Produto...">
            </div>
            <div class="form-group">
                <label for="id_fornecedor">Fornecedor:</label>
                <select name="id_fornecedor" id="id_fornecedor">
                    <?php foreach($funcao as $key => $value) : ?>
                        <?php if($value['id'] == $dados['id_fornecedor']) { ?>
                            <option selected value="<?= $value['id'] ?>"><?= $value['nome'] ?></option>
                        <?php } else { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['nome'] ?></option>
                        <?php } ?>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</div>