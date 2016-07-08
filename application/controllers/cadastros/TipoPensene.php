<?php
class TipoPensene extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
        if(!$this->session->userdata('loggedin') || !$this->session->userdata('admin')){
            redirect(base_url().'Home', 'refresh');
        }
	}

	function index(){
		$data['titulo'] = "Cadastros | Tipo de Pensene";

		$this->load->model('cadastros/TipoPensene_model');
		$data['tipo_pensene'] = $this->TipoPensene_model->listar();
        $data['acao'] = 'Adicionar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario'] = $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');
		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/tipo_pensene',$data);
		$this->load->view('cadastros/elementos/html_footer');
	}

	function adicionar(){
		$this->load->library('form_validation');
		$config = array(
	               array(
	                     'field'=>'pensene_tipo',
	                     'label'=>'pensene_tipo',
	                     'rules'=>'required|max_length[45]'
	                ),
					array(
	                     'field'   => 'descricao_tipo',
	                     'label'   => 'Descri&ccedil;&atilde;o',
	                     'rules'   => 'required|max_length[200]'
	                  )
           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			 $data['pensene_tipo']  = $this->input->post('pensene_tipo');
			 $data['descricao_tipo'] = $this->input->post('descricao_tipo');

			 $this->load->model('cadastros/TipoPensene_model');
			 if($this->TipoPensene_model->cadastrar($data)){
			 	redirect(base_url().'cadastros/TipoPensene/');
			 }
			 else{
			 	echo "Erro ao inserir Tipo de Pensene";
			 }
		}
	}


	function alterar($id){
		$data['titulo'] = "Cadastros | Alterar Tipo de Pensene";
		$this->load->model('cadastros/TipoPensene_model');
		$data['dados_TipoPensene'] = $this->TipoPensene_model->alterar($id);
		$data['acao'] = 'Alterar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');

		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/tipo_pensene',$data);
		$this->load->view('cadastros/elementos/html_footer');
	}

	function gravarAlteracao(){
		$this->load->library('form_validation');
		$config = array(
	               array(
	                     'field'=>'pensene_tipo',
	                     'label'=>'pensene_tipo',
	                     'rules'=>'required|max_length[45]'
	                ),
					array(
	                     'field'   => 'descricao_tipo',
	                     'label'   => 'Descri&ccedil;&atilde;o',
	                     'rules'   => 'required|max_length[200]'
	                  )
           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->alterar($this->input->post('id'));
		}
		else{
			 $data['id'] = $this->input->post('id');
			 $data['pensene_tipo'] = $this->input->post('pensene_tipo');
			 $data['descricao_tipo'] = $this->input->post('descricao_tipo');

			 $this->load->model('cadastros/TipoPensene_model');
			 if($this->TipoPensene_model->gravarAlteracao($data)){
			 	redirect(base_url().'cadastros/TipoPensene/');
			 }
			 else{
			 	echo "Erro ao alterar tipo de Pensene";
			 }
		}
	}

	function excluir($id){
		$this->load->model('cadastros/TipoPensene_model');
		if($this->TipoPensene_model->excluir($id)){
			redirect(base_url().'cadastros/TipoPensene/', 'refresh');
		}
		else{
			echo "Erro ao excluir Tipo de Pensene";
		}
	}
}
