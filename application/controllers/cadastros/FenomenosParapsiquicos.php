<?php
/*
 * Created on 03/09/2015
 *
 * Cadastro de fenômenos parapsíquico já mapeados.
 *
 *
 * @package proexis
 * @subpackage cadastros
 * @category cadastros de tabelas
 * @author Vitor Fred
 * @link
 *
 */
class FenomenosParapsiquicos extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'session' );
		if (! $this->session->userdata ( 'loggedin' ) || ! $this->session->userdata ( 'admin' )) {
			redirect ( base_url () . 'Home', 'refresh' );
		}
	}
	function index() {
		$data ['titulo'] = "Cadastros | Fenômenos parapsíquicos";
		
		$this->load->model ( 'cadastros/FenomenosParapsiquicos_model' );
		$data ['fenomenos_parapsiquicos'] = $this->FenomenosParapsiquicos_model->listar ();
		$data ['acao'] = 'Adicionar';
		$data ['nome_usuario'] = $this->session->userdata ( 'nome_usuario' );
		$data ['usuario'] = $this->session->userdata ( 'usuario' );
		$data ['admin'] = $this->session->userdata ( 'admin' );
		$this->load->view ( 'cadastros/elementos/html_header', $data );
		$this->load->view ( 'cadastros/elementos/menu' );
		$this->load->view ( 'cadastros/fenomenos_parapsiquicos', $data );
		$this->load->view ( 'cadastros/elementos/html_footer' );
	}
	function adicionar() {
		$this->load->library ( 'form_validation' );
		$config = array (
				array (
						'field' => 'nome',
						'label' => 'Nome',
						'rules' => 'required|max_length[30]' 
				),
				array (
						'field' => 'descricao',
						'label' => 'Descri&ccedil;&atilde;o',
						'rules' => 'required|max_length[200]' 
				) 
		)
		;
		$this->form_validation->set_rules ( $config );
		
		if ($this->form_validation->run () == FALSE) {
			$this->index ();
		} else {
			$data ['nome'] = $this->input->post ( 'nome' );
			$data ['descricao'] = $this->input->post ( 'descricao' );
			
			$this->load->model ( 'cadastros/FenomenosParapsiquicos_model' );
			if ($this->FenomenosParapsiquicos_model->cadastrar ( $data )) {
				redirect ( base_url () . 'cadastros/FenomenosParapsiquicos/' );
			} else {
				echo "Erro ao inserir Fenômenos Parapsíquicos";
			}
		}
	}
	function alterar($id) {
		$data ['titulo'] = "Cadastros | Alterar Fenômenos parapsíquicos";
		$this->load->model ( 'cadastros/FenomenosParapsiquicos_model' );
		$data ['dados_FenomenosParapsiquicos'] = $this->FenomenosParapsiquicos_model->alterar ( $id );
		$data ['acao'] = 'Alterar';
		$data ['nome_usuario'] = $this->session->userdata ( 'nome_usuario' );
		$data ['usuario'] = $this->session->userdata ( 'usuario' );
		$data ['admin'] = $this->session->userdata ( 'admin' );
		
		$this->load->view ( 'cadastros/elementos/html_header', $data );
		$this->load->view ( 'cadastros/elementos/menu' );
		$this->load->view ( 'cadastros/fenomenos_parapsiquicos', $data );
		$this->load->view ( 'cadastros/elementos/html_footer' );
	}
	function gravarAlteracao() {
		$this->load->library ( 'form_validation' );
		$config = array (
				array (
						'field' => 'nome',
						'label' => 'Nome',
						'rules' => 'required|max_length[30]' 
				),
				array (
						'field' => 'descricao',
						'label' => 'Descri&ccedil;&atilde;o',
						'rules' => 'required|max_length[200]' 
				) 
		);
		$this->form_validation->set_rules ( $config );
		
		if ($this->form_validation->run () == FALSE) {
			$this->alterar ( $this->input->post ( 'id' ) );
		} else {
			$data ['id'] = $this->input->post ( 'id' );
			$data ['nome'] = $this->input->post ( 'nome' );
			$data ['descricao'] = $this->input->post ( 'descricao' );
			
			$this->load->model ( 'cadastros/FenomenosParapsiquicos_model' );
			if ($this->FenomenosParapsiquicos_model->gravarAlteracao ( $data )) {
				redirect ( base_url () . 'cadastros/FenomenosParapsiquicos/' );
			} else {
				echo "Erro ao alterar Fenômenos Parapsíquicos";
			}
		}
	}
	function excluir($id) {
		$this->load->model ( 'cadastros/FenomenosParapsiquicos_model' );
		if ($this->FenomenosParapsiquicos_model->excluir ( $id )) {
			redirect ( base_url () . 'cadastros/FenomenosParapsiquicos/', 'refresh' );
		} else {
			echo "Erro ao Fenômenos Parapsíquicos";
		}
	}
}
