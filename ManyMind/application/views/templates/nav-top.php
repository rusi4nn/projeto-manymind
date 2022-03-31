<div class="menu">
        <div class="menu-wrapper">
            <div class="box-usuario">
                <div class="avatar-usuario">
                    <i class="fas fa-user"></i>      
                </div>
                <div class="nome-usuario">
                    <p><?= $nome ?></p>
                </div>
            </div>
            <div class="items-menu">
                <h2>Administração do Painel</h2>
                <a href="<?= base_url('AppController/cadastrarColaborador') ?>">Cadastrar Colaborador</a>
                <a href="<?= base_url('AppController/cadastrarProduto') ?>">Cadastrar Produto</a>
                <a href="<?= base_url('AppController/editarColaborador/'.$identificacao) ?>">Editar Colaborador</a>
                <h2>Gestão</h2>
                <a href="<?= base_url('AppController/listarColaboradores') ?>">Listar Colaboradores</a>
                <a href="<?= base_url('AppController/listarProdutos') ?>">Listar Produtos</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <header>
        <div class="center">
            <div class="lateral menu-btn">
                <i class="fas fa-bars"></i>
            </div>

            <div class="lateral empresa">
                <p>ManyMinds</p>
            </div>

            <div class="logout">
                <a <?php if($this->uri->segment(1) == 'AppController' && $this->uri->segment(2) == '') { ?> style="background: #60727a;padding: 15px;" <?php } ?> href="<?= base_url('/AppController') ?>"><i class="fas fa-home"></i> <span>Página inicial</span></a>
                <a href="<?= base_url('/IndexController/logout') ?>"><i class="fas fa-user-alt-slash"></i> <span>Sair</span></a>
            </div>
            <div class="clear"></div>
        </div>
    </header>