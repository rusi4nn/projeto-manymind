<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        permissao();
    }

    // Carrega a home e seus metódos
	public function index()
	{
        
        $array = $this->session->userdata['usuario'];
        $data['identificacao'] = $array['id'];
        $data['nome'] = $array['nome'];
        $this->load->model("Funcao_model");
        $this->load->model("Cargos_model");
        $this->load->model("Colaboradores_model");
        $data['colaboradores'] = $this->Colaboradores_model->numTodos();
        $data['administradores'] = $this->Cargos_model->pegaNumCargo(1);
        $data['fornecedores'] = $this->Funcao_model->pegaNumFuncao(2);
        $this->load->view('templates/header');
        $this->load->view('templates/nav-top',$data);
		$this->load->view('pages/home');
        $this->load->view('templates/footer');

	}

    // Carrega o formulário para cadastrar colaborador
    public function cadastrarColaborador() {

        
        $array = $this->session->userdata['usuario'];
        $data['identificacao'] = $array['id'];
        $data['nome'] = $array['nome'];
        $this->load->model("Cargos_model");
        $this->load->model("Funcao_model");
        $this->load->model("Status_model");
        $data["status"] = $this->Status_model->index();
        $data["cargos"] = $this->Cargos_model->index();
        $data["funcoes"] = $this->Funcao_model->index();
        $data['mensagem'] = $this->uri->segment(3);
        $this->load->view('templates/header');
        $this->load->view('templates/nav-top',$data);
		$this->load->view('pages/cadastrar-colaborador',$data);
        $this->load->view('templates/footer');
    }

    // Realiza a inserção de colaboradores no banco
    public function storeColaborador() {

        
        $dados = $_POST;
        $this->load->model("Colaboradores_model");
        if($this->Colaboradores_model->store($dados)) {
            redirect("/AppController/cadastrarColaborador/sucesso");
        } else {
            redirect("/AppController/cadastrarColaborador/erro");
        }

    }

    // Carrega o formulário de editar o colaborador
    public function editarColaborador($id) {

        $this->load->model("Colaboradores_model");
        $status = $this->Colaboradores_model->show($id);
        if($status['id_status'] == 2) {
            redirect('/AppController/listarColaboradores');
        } else {
            $array = $this->session->userdata['usuario'];
            $cargo = $array['id_cargo'];
            $data['nome'] = $array['nome'];
            $data['identificacao'] = $array['id'];
            $this->load->model("Cargos_model");
            $this->load->model("Funcao_model");
            $this->load->model("Status_model");
            $data['dados'] = $this->Colaboradores_model->show($id);
            $data['cargos'] = $this->Cargos_model->index();
            $data['funcao'] = $this->Funcao_model->index();
            $data['status'] = $this->Status_model->index();
            $data['cargoUsuario'] = $cargo;
            $data['mensagem'] = $this->uri->segment(4);
            $this->load->view('templates/header');
            $this->load->view('templates/nav-top', $data);
		    $this->load->view('pages/editar-colaborador',$data);
            $this->load->view('templates/footer');
        }
    }

    // Realiza a edição do colaborador no banco
    public function updateColaborador($id) {

        
        $this->load->model("Colaboradores_model");
        $dados = $_POST;
        if($this->Colaboradores_model->update($id, $dados)) {
            redirect("AppController/editarColaborador/".$id."/sucesso");
        } else {
            redirect("AppController/editarColaborador/".$id."/erro");
        }
    }

    // Carrega a view de listagem de colaboradores caso seja administrador
    public function listarColaboradores() {

        
        $array = $this->session->userdata['usuario'];
        $data['identificacao'] = $array['id'];
        $data['nome'] = $array['nome'];
        $this->load->model("Colaboradores_model");
        $url = $this->uri->segment(3);
        if(isset($url)) {
            $paginaAtual = $url;
        } else {
            $paginaAtual = 1;
        }
        $porPagina = 5;
        $totalPaginas = $this->Colaboradores_model->pegaDadosMultiplos('tb_colaboradores','tb_status','tb_cargos');
        $paginasTotal = ceil(count($totalPaginas) / $porPagina);
        $colaboradores = $this->Colaboradores_model->pegaDadosMultiplos('tb_colaboradores','tb_status','tb_cargos',($paginaAtual - 1) * $porPagina, $porPagina);
        $data['paginaAtual'] = $paginaAtual;
        $data['porPagina'] = $porPagina;
        $data['totalPaginas'] = $paginasTotal;
        $data['colaboradores'] = $colaboradores;
        $this->load->view('templates/header');
        $this->load->view('templates/nav-top', $data);
		$this->load->view('pages/listar-colaboradores',$data);
        $this->load->view('templates/footer');
    }

    // carrega o formulário de cadastro do produto
    public function cadastrarProduto() {

        $array = $this->session->userdata['usuario'];
        $data['identificacao'] = $array['id'];
        $data['nome'] = $array['nome'];
        $this->load->model("Funcao_model");
        $this->load->model("Status_model");
        $status = $this->Status_model->index();
        $fornecedores = $this->Funcao_model->pegaUsuarioFuncao('2');

        $data['fornecedores'] = $fornecedores;
        $data['status'] = $status;
        $data['mensagem'] = $this->uri->segment(3);
        $this->load->view('templates/header');
        $this->load->view('templates/nav-top', $data);
		$this->load->view('pages/cadastrar-produto',$data);
        $this->load->view('templates/footer');
    }

    // Realiza a inserção do produto no banco
    public function storeProduto() {

        $data = $_POST;
        $this->load->model("Produtos_model");
        if($this->Produtos_model->store($data)) {
            redirect("/AppController/cadastrarProduto/sucesso");
        } else {
            redirect("/AppController/cadastrarProduto/erro");
        }
    }

    // carrega o formulário de edição do produto
    public function editarProduto($id) {

        
        $this->load->model("Produtos_model");
        $status = $this->Produtos_model->show($id);
        $data['nome'] = $array['nome'];
        if($status['id_status'] == 2) {
            redirect('/AppController/listarProdutos');
        } else {
            $data['dados'] = $this->Produtos_model->show($id);

            $array = $this->session->userdata['usuario'];
            $data['identificacao'] = $array['id'];
            $this->load->model("Funcao_model");
            $data['funcao'] = $this->Funcao_model->pegaUsuarioFuncao('2');
            $data['mensagem'] = $this->uri->segment(4);
            $this->load->view('templates/header');
            $this->load->view('templates/nav-top',$data);
            $this->load->view('pages/editar-produto',$data);
            $this->load->view('templates/footer');
        }
    }

    // Realiza a edição do produto no banco
    public function updateProduto($id) {

        
        $this->load->model("Produtos_model");
        $dados = $_POST;
        if($this->Produtos_model->update($id, $dados)) {
            redirect("AppController/editarProduto/".$id."/sucesso");
        } else {
            redirect("AppController/editarProduto/".$id."/erro");
        }
    }

    // Carrega a view de listagem de produto
    public function listarProdutos() {

        
        $array = $this->session->userdata['usuario'];
        $data['identificacao'] = $array['id'];
        $data['nome'] = $array['nome'];
        $data['idCargo'] = $array['id_cargo'];
        $this->load->model('Produtos_model');

        $url = $this->uri->segment(3);
        if(isset($url)) {
            $paginaAtual = $url;
        } else {
            $paginaAtual = 1;
        }
        $porPagina = 5;
        $totalPaginas = $this->Produtos_model->pegaDadosMultiplos('tb_produtos','tb_colaboradores');
        $paginasTotal = ceil(count($totalPaginas) / $porPagina);
        $produtos = $this->Produtos_model->pegaDadosMultiplos('tb_produtos','tb_colaboradores',NULL,($paginaAtual - 1) * $porPagina, $porPagina);
        $data['paginaAtual'] = $paginaAtual;
        $data['porPagina'] = $porPagina;
        $data['totalPaginas'] = $paginasTotal;
        $data['produtos'] = $produtos;
        $this->load->view('templates/header');
        $this->load->view('templates/nav-top',$data);
		$this->load->view('pages/listar-produtos', $data);
        $this->load->view('templates/footer');
    }

    // Acessa o metodo que ativa um produto caso seja administrador
    public function ativarProduto($id) {
        $this->load->model("Produtos_model");
        if($this->Produtos_model->ativar($id)) {
            redirect('/AppController/listarProdutos');
        }
    }
    
    // Acessa o metodo que inativa um produto caso seja administrador
    public function inativarProduto($id) {
        $this->load->model("Produtos_model");
        if($this->Produtos_model->inativar($id)) {
            redirect('/AppController/listarProdutos');
        }
    }

    // Acessa o metodo que ativa um colaborador caso seja administrador
    public function ativarColaborador($id) {
        
        $this->load->model("Colaboradores_model");
        if($this->Colaboradores_model->ativar($id)) {
            redirect('/AppController/listarColaboradores');
        }
        
    }

    // Acessa o metodo que inativa um colaborador caso seja administrador
    public function inativarColaborador($id) {
        $this->load->model("Colaboradores_model");
        if($this->Colaboradores_model->inativar($id)) {
            redirect('/AppController/listarColaboradores');
        }
        
    }
}
