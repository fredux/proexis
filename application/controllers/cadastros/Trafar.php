<?php
/*
 * Created on 03/09/2015
 *
 * Cadastro de traço fardo - Traços que precisamos transformar
 * para evoluirmos mais rapidamente
 *
 * @package		proexis
 * @subpackage	cadastros
 * @category	cadastros de Sinais
 * @author		Vitor Fred
 * @link
 *
 */

class Trafar extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
        if(!$this->session->userdata('loggedin') || !$this->session->userdata('admin')){
            redirect(base_url().'Home', 'refresh');

        }

	}

	function index(){
		$data['titulo'] = "Cadastros | Trafor - Traço-Fardo";

		$this->load->model('cadastros/Trafar_model');
		$data['trafar'] = $this->Trafar_model->listar();
        $data['acao'] = 'Adicionar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');
		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/trafar',$data);
		$this->load->view('cadastros/elementos/html_footer');
	}

	function adicionar(){
		$this->load->library('form_validation');
		$config = array(
					array(
	                     'field'   => 'nome_trafar',
	                     'label'   => 'Nome',
	                     'rules'   => 'required|max_length[30]'
	                  ),
					array(
	                     'field'   => 'descricao_trafar',
	                     'label'   => 'Descri&ccedil;&atilde;o',
	                     'rules'   => 'max_length[200]'
	                  )

           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			 $data['nome_trafar']  = $this->input->post('nome_trafar');
			 $data['descricao_trafar']  = $this->input->post('descricao_trafar');

			 $this->load->model('cadastros/Trafar_model');
			 if($this->Trafar_model->cadastrar($data)){
			 	redirect(base_url().'cadastros/Trafar/');
			 }
			 else{
			 	echo "Erro ao inserir Trafar";
			 }
		}
	}


	function alterar($id){
		$data['titulo'] = "Cadastros | Alterar Trafar";
		$this->load->model('cadastros/Trafar_model');
		$data['dados_Trafar'] = $this->Trafar_model->alterar($id);
		$data['acao'] = 'Alterar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');

		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/trafar',$data);
		$this->load->view('cadastros/elementos/html_footer');
	}

	function gravarAlteracao(){
		$this->load->library('form_validation');
		$config = array(
	               array(
	                     'field'=>'nome_trafar',
	                     'label'=>'Nome',
	                     'rules'=>'required|max_length[30]'
	                ),
	               array(
	                     'field'=>'descricao_trafar',
	                     'label'=>'Descri&ccedil;&atilde;o',
	                     'rules'=>'max_length[200]'
	                )
           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->alterar($this->input->post('id'));
		}
		else{
			 $data['id'] = $this->input->post('id');
			 $data['nome_trafar'] = $this->input->post('nome_trafar');
			 $data['descricao_trafar'] = $this->input->post('descricao_trafar');

			 $this->load->model('cadastros/Trafar_model');
			 if($this->Trafar_model->gravarAlteracao($data)){
			 	redirect(base_url().'cadastros/Trafar/');
			 }
			 else{
			 	echo "Erro ao alterar Trafar";
			 }
		}
	}

	function excluir($id){
		$this->load->model('cadastros/Trafar_model');
		if($this->Trafar_model->excluir($id)){
			redirect(base_url().'cadastros/Trafar/', 'refresh');
		}
		else{
			echo "Erro ao excluir Trafar";
		}
	}
}
