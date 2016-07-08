<?php
class Sinais_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function cadastrar($data){
    	return $this->db->insert('sinais',$data);
    }

    function listar(){
    	$this->db->order_by('tipo_sinais, descricao_sinais', 'ASC');
    	$query = $this->db->get('sinais');
    	return $query->result();
    }

	function alterar($id){
		$this->db->where('id',$id);
    	$query = $this->db->get('sinais');
    	return $query->result();
    }

    function gravarAlteracao($data){
    	$this->db->where('id',$data['id']);
    	return $this->db->update('sinais',$data);
    }

	function excluir($id){
    	$this->db->where('id',$id);
    	return $this->db->delete('sinais');
    }
}
