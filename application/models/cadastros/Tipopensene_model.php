<?php
class TipoPensene_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function cadastrar($data){
    	return $this->db->insert('tipo_pensene',$data);
    }

    function listar(){
    	$this->db->order_by('pensene_tipo');
    	$query = $this->db->get('tipo_pensene');
    	return $query->result();
    }

	function alterar($id){
		$this->db->where('id',$id);
    	$query = $this->db->get('tipo_pensene');
    	return $query->result();
    }

    function gravarAlteracao($data){
    	$this->db->where('id',$data['id']);
    	return $this->db->update('tipo_pensene',$data);
    }

	function excluir($id){
    	$this->db->where('id',$id);
    	return $this->db->delete('tipo_pensene');
    }
}
