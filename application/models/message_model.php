<?php
class message_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
		
	function get(){
		$this->db->join("tbluser","tbluser.id=tblmessage.user_id","inner");
		$this->db->select("tblmessage.id as id,subject,date_posted,fname,lname");
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblmessage");		
		$announcement=$result->result();
		return $announcement;
	}
	
	function get_by_id($id){		
		$this->db->join("tbluser","tbluser.id=tblmessage.user_id","inner");
		$this->db->where("tblmessage.id",$id);
		$this->db->select("tblmessage.id as id,subject,message,date_posted,fname,lname");
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblmessage");		
		$announcement=$result->result();
		return $announcement;
	}
	
	function get_some($limit=3,$start=0){
		$this->db->limit($limit,$start);
		$this->db->order_by("id","desc");
		$this->db->join("tbluser","tbluser.id=tblmessage.user_id","inner");
		$this->db->select(array("LEFT(message,50) as `message`","tblmessage.id as id,subject","date_posted","fname","lname"));
		$result=$this->db->get("tblmessage");		
		$announcement=$result->result();
		return $announcement;
	}
	
	function get_page($limit=0,$start=0){
		$this->db->limit($limit,$start);
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblmessage");		
		$announcement=$result->result();
		return $announcement;
	}
	function count(){
		$count =$this->db->count_all_results("tblmessage");
		return $count;
	}
	
	function add($data){
		
		$message['success']=$this->db->insert("tblmessage",$data);
		$message['id']= $this->db->insert_id();
		return $message;
	}
	
	function update($id,$data){
		$this->db->update("tblmessage",$data,array("id"=>$id));
	}
	
	function delete($id){
		$message['success']=$this->db->delete("tblmessage",array("id"=>$id));
		$message['id']= $this->db->insert_id();
		return $message;
	}
}
