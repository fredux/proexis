<?php
class CategoriaTemperamento extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		
        if(!$this->session->userdata('loggedin') || !$this->session->userdata('admin')){
            redirect(base_url().'Home', 'refresh');
        }
		
	}

	function index(){
		$data['titulo'] = "Cadastros | Categorias do Temperamento";

		$this->load->model('cadastros/CategoriaTemperamento_model');
		$data['categoria_temperamento'] = $this->CategoriaTemperamento_model->listar();
        $data['acao'] = 'Adicionar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');
		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/categoria_temperamento',$data);
		$this->load->view('cadastros/elementos/html_footer');
	}

	function adicionar(){
		$this->load->library('form_validation');
		$config = array(
					array(
	                     'field'   => 'homeostatico',
	                     'label'   => 'Homeostático',
	                     'rules'   => 'required'
	                  ),
					array(
	                     'field'   => 'nosografico',
	                     'label'   => 'Nosográfico',
	                     'rules'   => 'required'
	                  ),
           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			 $data['homeostatico']  = $this->input->post('homeostatico');
			 $data['nosografico']  = $this->input->post('nosografico');
			 $data['obs']  = $this->input->post('obs');

			 $this->load->model('cadastros/CategoriaTemperamento_model');
			 if($this->CategoriaTemperamento_model->cadastrar($data)){
			 	redirect(base_url().'cadastros/CategoriaTemperamento/');
			 }
			 else{
			 	echo "Erro ao inserir Categoria do Temperamento";
			 }
		}
	}


	function alterar($id){
		$data['titulo'] = "Cadastros | Categoria do Temperamento";
		$this->load->model('cadastros/CategoriaTemperamento_model');
		$data['dados_CategoriaTemperamento'] = $this->CategoriaTemperamento_model->alterar($id);
		$data['acao'] = 'Alterar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');

		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/categoria_temperamento',$data);
		$this->load->view('cadastros/elementos/html_footer');
	}

	function gravarAlteracao(){
		$this->load->library('form_validation');
		$config = array(
					array(
	                     'field'   => 'homeostatico',
	                     'label'   => 'Homeostático',
	                     'rules'   => 'required'
	                  ),
					array(
	                     'field'   => 'nosografico',
	                     'label'   => 'Nosográfico',
	                     'rules'   => 'required'
	                  ),
           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->alterar($this->input->post('id'));
		}
		else{
			 $data['id'] = $this->input->post('id');
			 $data['homeostatico']  = $this->input->post('homeostatico');
			 $data['nosografico']  = $this->input->post('nosografico');
			 $data['obs']  = $this->input->post('obs');

			 $this->load->model('cadastros/CategoriaTemperamento_model');
			 if($this->CategoriaTemperamento_model->gravarAlteracao($data)){
			 	redirect(base_url().'cadastros/CategoriaTemperamento/');
			 }
			 else{
			 	echo "Erro ao alterar Trafor";
			 }
		}
	}

	function excluir($id){
		$this->load->model('cadastros/CategoriaTemperamento_model');
		if($this->CategoriaTemperamento_model->excluir($id)){
			redirect(base_url().'cadastros/CategoriaTemperamento/', 'refresh');
		}
		else{
			echo "Erro ao excluir Categorias do Temperamento";
		}
	}
}
