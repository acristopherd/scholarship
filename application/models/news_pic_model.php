<?php 
class news_pic_model extends CI_Model{
	function get(){
		$result=$this->db->get("tblnews_pic");
		$requirement=$result->result();
		return $requirement;
	}
	
	function get_by_id($id){
		$this->db->where("news_id",$id);
		$result=$this->db->get("tblnews_pic");
		$requirement=$result->result();
		return $requirement;
	}
	
	function insert($data){
		$message=$this->db->insert("tblnews_pic",$data);
		return $message;
	}
	
	function delete($id){
		$message['success']=$this->db->delete("tblnews_pic",array("news_id"=>$id));
		//$message['id']= $this->db->insert_id();
		return $message;
	}
}
