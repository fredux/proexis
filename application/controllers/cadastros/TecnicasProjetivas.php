<?php
/*
 * Created on 29/09/2015
 *
 * Cadastro Técnicas projetivas
 *
 *
 * @package		proexis
 * @subpackage	cadastros
 * @category	cadastros de Técnicas Projetivas
 * @author		Vitor Fred
 * @link
 *
 */

class TecnicasProjetivas extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
        if(!$this->session->userdata('loggedin') || !$this->session->userdata('admin')){
            redirect(base_url().'Home', 'refresh');
        }
		$this->load->library("pagination");

	}

	function index(){
		$data['titulo'] = "Cadastros | Técnicas Projetivas";

		$this->load->model('cadastros/TecnicasProjetivas_model');
        $data['acao'] = 'Adicionar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');

        $config = array();
        $config['base_url'] = base_url() . 'cadastros/TecnicasProjetivas/index';
        $config['total_rows'] = $this->TecnicasProjetivas_model->recordCount();
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['tecnicas_projetivas'] = $this->TecnicasProjetivas_model->listar($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();


		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/tecnicas_projetivas',$data);
		$this->load->view('cadastros/elementos/html_footer');


	}

	function adicionar(){
		$this->load->library('form_validation');
		$config = array(
					array(
	                     'field'   => 'nome',
	                     'label'   => 'Nome',
	                     'rules'   => 'required|max_length[100]'
	                  ),
					array(
	                     'field'   => 'descricao',
	                     'label'   => 'Descri&ccedil;&atilde;o'
	                  )

           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			 $data['nome']  = $this->input->post('nome');
			 $data['descricao']  = $this->input->post('descricao');

			 $this->load->model('cadastros/TecnicasProjetivas_model');
			 if($this->TecnicasProjetivas_model->cadastrar($data)){
			 	redirect(base_url().'cadastros/TecnicasProjetivas/');
			 }
			 else{
			 	echo "Erro ao inserir Técnica Projetiva";
			 }
		}
	}


	function alterar($id){
		$data['titulo'] = "Cadastros | Alterar Técnica Projetiva";
		$this->load->model('cadastros/TecnicasProjetivas_model');
		$data['dados_TecnicasProjetivas'] = $this->TecnicasProjetivas_model->alterar($id);
		$data['acao'] = 'Alterar';
		$data['nome_usuario'] = $this->session->userdata('nome_usuario');
		$data['usuario']= $this->session->userdata('usuario');
		$data['admin']= $this->session->userdata('admin');

		$this->load->view('cadastros/elementos/html_header',$data);
		$this->load->view('cadastros/elementos/menu');
		$this->load->view('cadastros/tecnicas_projetivas',$data);
		$this->load->view('cadastros/elementos/html_footer');
	}

	function gravarAlteracao(){
		$this->load->library('form_validation');
		$config = array(
	               array(
	                     'field'=>'nome',
	                     'label'=>'Nome',
	                     'rules'=>'required|max_length[100]'
	                ),
	               array(
	                     'field'=>'descricao',
	                     'label'=>'Descri&ccedil;&atilde;o'
	                )
           	 		);
           	 		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->alterar($this->input->post('id'));
		}
		else{
			 $data['id'] = $this->input->post('id');
			 $data['nome'] = $this->input->post('nome');
			 $data['descricao'] = $this->input->post('descricao');

			 $this->load->model('cadastros/TecnicasProjetivas_model');
			 if($this->TecnicasProjetivas_model->gravarAlteracao($data)){
			 	redirect(base_url().'cadastros/TecnicasProjetivas/');
			 }
			 else{
			 	echo "Erro ao alterar Técnica Projetiva";
			 }
		}
	}

	function excluir($id){
		$this->load->model('cadastros/TecnicasProjetivas_model');
		if($this->TecnicasProjetivas_model->excluir($id)){
			redirect(base_url().'cadastros/TecnicasProjetivas/', 'refresh');
		}
		else{
			echo "Erro ao excluir Técinca Projetiva";
		}
	}
}
