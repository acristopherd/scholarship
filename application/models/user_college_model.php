<?php 
class user_college_model extends CI_Model{
	function get(){
		$result=$this->db->get("tbluser_college");
		$user=$result->result();
		return $user;
	}
	
	function insert($data){
		$message['success']=$this->db->insert("tbluser_college",$data);
		$message['insert_id']=$this->db->insert_id();
		return $message;
	}
	
}
