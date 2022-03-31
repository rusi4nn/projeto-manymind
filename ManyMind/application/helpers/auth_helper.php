<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// verifica a permissao do usuario para acessar rotas e bloqueia caso não possa, redirecionando o usuário para a home
function permissao() {

    $ci = get_instance();
    $usuarioLogado = $ci->session->userdata('usuario');
    if(!$usuarioLogado) {
        $ci->session->set_flashdata("danger","Você precisa estar logado para acessar esta pagina");
        redirect('/');
    } else {
        
        if($usuarioLogado['id_cargo'] == 1) {

        } else {
            if($ci->uri->segment(2) == 'cadastrarColaborador' || $ci->uri->segment(2) == 'listarColaboradores' || $ci->uri->segment(2) == 'ativarColaborador' || $ci->uri->segment(2) == 'inativarColaboradores' || $ci->uri->segment(2) == 'ativarColaborador' || $ci->uri->segment(2) == 'inativarColaboradores') {
                redirect('/AppController');
            }
        }
    }
    return $usuarioLogado;
}