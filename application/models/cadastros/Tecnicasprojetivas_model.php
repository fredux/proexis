<?php
class TecnicasProjetivas_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function cadastrar($data){
    	return $this->db->insert('tecnicas_projetivas',$data);
    }

   function recordCount() {
        return $this->db->count_all('tecnicas_projetivas');
    }

    function listar($limit, $start){
        $this->db->limit($limit, $start);

  	    $this->db->order_by('nome');
    	$query = $this->db->get('tecnicas_projetivas');
    	return $query->result();
    }

	function alterar($id){
		$this->db->where('id',$id);
    	$query = $this->db->get('tecnicas_projetivas');
    	return $query->result();
    }

    function gravarAlteracao($data){
    	$this->db->where('id',$data['id']);
    	return $this->db->update('tecnicas_projetivas',$data);
    }

	function excluir($id){
    	$this->db->where('id',$id);
    	return $this->db->delete('tecnicas_projetivas');
    }
}
