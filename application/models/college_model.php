<?php 
class college_model extends CI_Model{
	function get(){
		$result=$this->db->get("tblcollege");
		$college=$result->result();
		return $college;
	}
	function get_college($id){
		$this->db->where("id",$id);
		$result=$this->db->get("tblcollege");
		$college=$result->result();
		return $college;
	}
	function insert($data){
		$message=$this->db->insert("tblcollege",$data);
		return $message;
	}
	function update($id,$data){
		$this->db->where("id",$id);
		$message=$this->db->update("tblcollege",$data);
		return $message;
	}
}
