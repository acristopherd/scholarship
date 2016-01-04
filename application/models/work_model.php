<?php
class work_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function update_work($scholar_id,$data){
		$this->db->delete("tblwork",array("scholar_id"=>$scholar_id));
		$success=$this->db->insert_batch("tblwork",$data);
		return $success;
	}
	
	function get_by_id($scholar_id){
		$this->db->from('tblwork');
		$this->db->where(array('scholar_id'=>$scholar_id));
		$result = $this->db->get();
		return $result->result();
	}
}
