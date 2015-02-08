<?php 
class scholartype_model extends CI_Model{
	function get(){
		$result=$this->db->get("tblscholar_type");
		$type=$result->result();
		return $type;
	}
	
	function get_by_id($id){
		$this->db->where("id",$id);
		$result=$this->db->get("tblscholar_type");
		$college=$result->result();
		return $college;
	}
	function insert($data){
		$message["success"]=$this->db->insert("tblscholar_type",$data);
		$message["insert_id"]=$this->db->insert_id();
		return $message;
	}
	function update($id,$data){
		$this->db->where("id",$id);
		$message=$this->db->update("tblscholar_type",$data);
		return $message;
	}
	function delete($id){
		$message=$this->db->delete("tblscholar_type",array("id"=>$id));
		return $message;
	}
}