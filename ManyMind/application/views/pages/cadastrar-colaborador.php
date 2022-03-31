<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="box-content">
        <h2><i class="fas fa-user-edit"></i> Cadastrar colaborador</h2>

        <form method="POST" action="<?= base_url('AppController/storeColaborador') ?>">

            <?php if(isset($mensagem) && $mensagem == 'sucesso') {
                echo '<div class="sucesso-box"><i class="fas fa-check"></i> Usuário cadastrado com sucesso</div>';
            } else if(isset($mensagem) && $mensagem == 'erro') {
                echo '<div class="erro-box"><i class="fas fa-times"></i> Não foi possível cadastrar o usuário</div>';
            }
            ?>

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Nome...">
            </div>
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuário para login..." required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="Senha...">
            </div>
            <div class="form-group">
                <label for="id_cargo">Cargo:</label>
                <select name="id_cargo" id="id_cargo">
                    <?php foreach($cargos as $key => $value) : ?>

                        <option value="<?= $value['id'] ?>"><?= $value['nome_cargo'] ?></option>

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
                <label for="id_funcao">Função:</label>
                <select name="id_funcao" id="id_funcao">
                    <?php foreach($funcoes as $key => $value) : ?>

                        <option value="<?= $value['id'] ?>"><?= $value['nome_funcao'] ?></option>

                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</div>