<?php
class type_requirement_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
		
	function get($id){
		$this->db->where("type_id",$id);
		$result=$this->db->get("tbltype_requirement");
		
		$scholar=$result->result();
		return $scholar;
	}
	
	function insert($data){
		$message=$this->db->insert("tbltype_requirement",$data);
		return $message;
	}
	
	function delete_by_type($id){
		$this->db->delete("tbltype_requirement",array("type_id"=>$id));
	}
	
	
}
