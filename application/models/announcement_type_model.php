<?php 
class announcement_type_model extends CI_Model{
	function get(){
		$result=$this->db->get("tblannouncement_type");
		$user=$result->result();
		return $user;
	}
	function get_by_id($id){
		$this->db->where("announcement_id",$id);
		$result=$this->db->get("tblannouncement_type");
		$user=$result->result();
		return $user;
	}
	
	function insert($data){
		$message['success']=$this->db->insert("tblannouncement_type",$data);
		$message['insert_id']=$this->db->insert_id();
		return $message;
	}
	
}