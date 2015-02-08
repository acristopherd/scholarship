<?php 
class message_attach_model extends CI_Model{
	function get(){
		$result=$this->db->get("tblmessage_attach");
		$requirement=$result->result();
		return $requirement;
	}
	
	function get_by_id($id){
		$this->db->where("message_id",$id);
		$result=$this->db->get("tblmessage_attach");
		$requirement=$result->result();
		return $requirement;
	}
	
	function insert($data){
		$message=$this->db->insert("tblmessage_attach",$data);
		return $message;
	}
	
	function delete($id){
		$message['success']=$this->db->delete("tblmessage_attach",array("message_id"=>$id));
		//$message['id']= $this->db->insert_id();
		return $message;
	}
}
