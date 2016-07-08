<?php
/*
 * Created on 10/09/2015
 *
 * Cadastro de Sinais sensações
 * para evoluirmos mais rapidamente
 *
 * @package		proexis
 * @subpackage	cadastros
 * @category	cadastros de Sinais
 * @author		Vitor Fred
 * @link
 *
 */

class Sinais extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
        if(!$this->session->userdata('loggedin') || !$this->session->userdata('admin')){
            redirect(base_url().'Home', 'refresh');
        }
	}

	function index(){
		$data['titulo'] = "Cadastros | Sinais";

		$this->load->model('cadastros/Sinais_model');
		$data['sinais'] = $this->Sinais_model->listar();
        $data['acao'] = 'Adicionar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');
		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/sinais',$data);
		$this->load->view('cadastros/elementos/html_footer');
	}

	function adicionar(){
		$this->load->library('form_validation');
		$config = array(
					array(
	                     'field'   => 'tipo_sinais',
	                     'label'   => 'Variável',
	                     'rules'   => 'required'
	                  ),

	                array('field'   => 'descricao_sinais',
	                     'label'   => 'Descrição',
	                     'rules'   => 'required|max_length[100]'
	                  ),
           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			 $data['tipo_sinais'] = $this->input->post('tipo_sinais');
			 $data['descricao_sinais'] = $this->input->post('descricao_sinais');

			 $this->load->model('cadastros/Sinais_model');
			 if($this->Sinais_model->cadastrar($data)){
			 	redirect(base_url().'cadastros/Sinais/');
			 }
			 else{
			 	echo "Erro ao inserir Sinais";
			 }
		}
	}


	function alterar($id){
		$data['titulo'] = "Cadastros | Alterar Sinais";
		$this->load->model('cadastros/Sinais_model');
		$data['dados_Sinais'] = $this->Sinais_model->alterar($id);
		$data['acao'] = 'Alterar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');

		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/sinais',$data);
		$this->load->view('cadastros/elementos/html_footer');
	}

	function gravarAlteracao(){
		$this->load->library('form_validation');
		$config = array(
					array(
	                     'field'   => 'tipo_sinais',
	                     'label'   => 'Variável',
	                     'rules'   => 'required'
	                  ),

	                array('field'   => 'descricao_sinais',
	                     'label'   => 'Descrição',
	                     'rules'   => 'required|max_length[100]'
	                  ),
           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->alterar($this->input->post('id'));
		}
		else{
			 $data['id'] = $this->input->post('id');
			 $data['tipo_sinais'] = $this->input->post('tipo_sinais');
			 $data['descricao_sinais'] = $this->input->post('descricao_sinais');

			 $this->load->model('cadastros/Sinais_model');
			 if($this->Sinais_model->gravarAlteracao($data)){
			 	redirect(base_url().'cadastros/Sinais/');
			 }
			 else{
			 	echo "Erro ao alterar Sinais";
			 }
		}
	}

	function excluir($id){
		$this->load->model('cadastros/Sinais_model');
		if($this->Sinais_model->excluir($id)){
			redirect(base_url().'cadastros/Sinais/', 'refresh');
		}
		else{
			echo "Erro ao excluir Sinais";
		}
	}
}
