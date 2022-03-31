<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller {

	// Carrega a página de login
	public function index()
	{
		$dados['mensagem'] = $this->uri->segment(3);
		$this->load->view('pages/login', $dados);

	}

	// Realiza o login de fato no dashboard
	public function login() {

		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];

		$this->load->model("Login_model");
		$login = $this->Login_model->index($usuario,$senha);

		if($login) {
			$this->session->set_userdata("usuario",$login);
			redirect('/AppController');
		} else {
			redirect('/IndexController/index/erro');
		}

	}

	// Desloga e destroi a seção
	public function logout() {

		$this->session->unset_userdata('usuario');
		redirect("/");
	}
}
