<?php
class Trafor extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
        if(!$this->session->userdata('loggedin') || !$this->session->userdata('admin')){
            redirect(base_url().'Home', 'refresh');
        }
		$this->load->library("pagination");
	}

	function index(){

		$data['titulo'] = "Cadastros | Trafor - Traço-Força";

		$this->load->model('cadastros/Trafor_model');
        $data['acao'] = 'Adicionar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');

        $config = array();
        $config['base_url'] = base_url() . 'cadastros/Trafor/index';
        $config['total_rows'] = $this->Trafor_model->recordCount();
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['trafor'] = $this->Trafor_model->listar($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();


		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/trafor',$data);
		$this->load->view('cadastros/elementos/html_footer');


	}

	function adicionar(){
		$this->load->library('form_validation');
		$config = array(
					array(
	                     'field'   => 'nome_trafor',
	                     'label'   => 'Nome',
	                     'rules'   => 'required'
	                  ),

           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			 $data['nome_trafor']  = $this->input->post('nome_trafor');
			 $data['descricao_trafor']  = $this->input->post('descricao_trafor');

			 $this->load->model('cadastros/Trafor_model');
			 if($this->Trafor_model->cadastrar($data)){
			 	redirect(base_url().'cadastros/Trafor/');
			 }
			 else{
			 	echo "Erro ao inserir Trafor";
			 }
		}
	}


	function alterar($id){
		$data['titulo'] = "Cadastros | Alterar Trafor";
		$this->load->model('cadastros/Trafor_model');
		$data['dados_Trafor'] = $this->Trafor_model->alterar($id);
		$data['acao'] = 'Alterar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');

		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/trafor',$data);
		$this->load->view('cadastros/elementos/html_footer');
	}

	function gravarAlteracao(){
		$this->load->library('form_validation');
		$config = array(
	               array(
	                     'field'=>'nome_trafor',
	                     'label'=>'Nome',
	                     'rules'=>'required'
	                ),
           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->alterar($this->input->post('id'));
		}
		else{
			 $data['id'] = $this->input->post('id');
			 $data['nome_trafor'] = $this->input->post('nome_trafor');
			 $data['descricao_trafor'] = $this->input->post('descricao_trafor');

			 $this->load->model('cadastros/Trafor_model');
			 if($this->Trafor_model->gravarAlteracao($data)){
			 	redirect(base_url().'cadastros/Trafor/');
			 }
			 else{
			 	echo "Erro ao alterar Trafor";
			 }
		}
	}

	function excluir($id){
		$this->load->model('cadastros/Trafor_model');
		if($this->Trafor_model->excluir($id)){
			redirect(base_url().'cadastros/Trafor/', 'refresh');
		}
		else{
			echo "Erro ao excluir Trafor";
		}
	}
}
