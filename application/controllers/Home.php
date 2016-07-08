<?php
class Home extends CI_Controller  {

	function __construct(){
		parent::__construct();
	}

	function index(){
		$data['titulo'] = "Administra&ccedil;&atilde;o | Login";

		$this->load->view('cadastros/elementos/html_header',$data);
	    $this->load->view('login');
		$this->load->view('cadastros/elementos/html_footer');
	}

	function login(){
		$this->load->library('form_validation');
		$config = array(
	               array(
	                     'field'=>'login',
	                     'label'=>'Login',
	                     'rules'=>'required|min_length[4]|max_length[10]|htmlspecialchars'
	               ),
					array(
	                     'field'   => 'senha',
	                     'label'   => 'Senha',
	                     'rules'   => 'required|min_length[4]|max_length[10]|htmlspecialchars'
	               )
           	 	);
        $this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{

			$data['login'] = $this->input->post('login');
			$data['senha'] = $this->input->post('senha');

			$this->load->model('cadastros/Usuarios_model');
			$login = $this->Usuarios_model->login($data);

			if(count($login)>0){

				$newdata = array(
					'nome_usuario' => $login[0]->nome,
                   	'usuario'  => $data['login'],
                   	'admin'  => $login[0]->admin,
                   	'loggedin' => TRUE
				);


				$this->load->library('session');
				$this->session->set_userdata($newdata);

				//redirect(base_url().'cadastros/TipoPensene', 'refresh');

		 		$data['titulo'] = "Proexis";
				$data['nome_usuario'] = $this->session->userdata('nome_usuario');
				$data['usuario']= $this->session->userdata('usuario');
				$data['admin']=$login[0]->admin;

				$this->load->view('cadastros/elementos/html_header',$data);
				$this->load->view('cadastros/elementos/menu',$data);
				$this->load->view('cadastros/elementos/html_footer');

			}
			else{
				$this->index();
			}
		}
	}

	function logout(){
		$this->load->library('session');
		$this->session->sess_destroy();
		$this->index();
	}
}
