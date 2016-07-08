<?php
class FenomenosParapsiquicos_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function cadastrar($data){
    	return $this->db->insert('fenomenos_parapsiquicos',$data);
    }

    function listar(){
    	$this->db->order_by('descricao');
    	$query = $this->db->get('fenomenos_parapsiquicos');
    	return $query->result();
    }

	function alterar($id){
		$this->db->where('id',$id);
    	$query = $this->db->get('fenomenos_parapsiquicos');
    	return $query->result();
    }

    function gravarAlteracao($data){
    	$this->db->where('id',$data['id']);
    	return $this->db->update('fenomenos_parapsiquicos',$data);
    }

	function excluir($id){
    	$this->db->where('id',$id);
    	return $this->db->delete('fenomenos_parapsiquicos');
    }
}
