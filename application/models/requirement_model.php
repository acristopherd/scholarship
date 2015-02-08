<?php 
class requirement_model extends CI_Model{
	function get(){
		$result=$this->db->get("tblrequirement");
		$requirement=$result->result();
		return $requirement;
	}
	
	function get_by_id($id){
		$this->db->where("scholarship_id",$id);
		$result=$this->db->get("tblrequirement");
		$requirement=$result->result();
		return $requirement;
	}
	
	function insert($data){
		$message=$this->db->insert("tblrequirement",$data);
		return $message;
	}
	
}
