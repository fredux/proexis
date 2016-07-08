<?php
class Trafar_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function cadastrar($data){
    	return $this->db->insert('trafar',$data);
    }

    function listar(){
    	$this->db->order_by('descricao_trafar');
    	$query = $this->db->get('trafar');
    	return $query->result();
    }

	function alterar($id){
		$this->db->where('id',$id);
    	$query = $this->db->get('trafar');
    	return $query->result();
    }

    function gravarAlteracao($data){
    	$this->db->where('id',$data['id']);
    	return $this->db->update('trafar',$data);
    }

	function excluir($id){
    	$this->db->where('id',$id);
    	return $this->db->delete('trafar');
    }
}
