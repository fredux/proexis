<?php
class CategoriaTemperamento_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function cadastrar($data){
    	return $this->db->insert('categoria_temperamento',$data);
    }

    function listar(){
    	$this->db->order_by('id');
    	$query = $this->db->get('categoria_temperamento');
    	return $query->result();
    }

	function alterar($id){
		$this->db->where('id',$id);
    	$query = $this->db->get('categoria_temperamento');
    	return $query->result();
    }

    function gravarAlteracao($data){
    	$this->db->where('id',$data['id']);
    	return $this->db->update('categoria_temperamento',$data);
    }

	function excluir($id){
    	$this->db->where('id',$id);
    	return $this->db->delete('categoria_temperamento');
    }
}
