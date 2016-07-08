<?php
class Trafor_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function cadastrar($data){
    	return $this->db->insert('trafor',$data);
    }

   function recordCount() {
        return $this->db->count_all('trafor');
    }

    function listar($limit, $start){
        $this->db->limit($limit, $start);

  	    $this->db->order_by('nome_trafor');
    	$query = $this->db->get('trafor');
    	return $query->result();
    }

	function alterar($id){
		$this->db->where('id',$id);
    	$query = $this->db->get('trafor');
    	return $query->result();
    }

    function gravarAlteracao($data){
    	$this->db->where('id',$data['id']);
    	return $this->db->update('trafor',$data);
    }

	function excluir($id){
    	$this->db->where('id',$id);
    	return $this->db->delete('trafor');
    }
}
