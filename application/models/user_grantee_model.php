<?php 
class user_grantee_model extends CI_Model{
	function get(){
		$result=$this->db->get("tbluser_grantee");
		$user=$result->result();
		return $user;
	}
	
	function insert($data){
		$message['success']=$this->db->insert("tbluser_grantee",$data);
		$message['insert_id']=$this->db->insert_id();
		return $message;
	}
	
}
