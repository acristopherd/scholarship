<?php
class announcement_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
		
	function get(){
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblannouncement");		
		$announcement=$result->result();
		return $announcement;
	}
	
	function get_latest(){
		$this->db->limit(1,0);
		$this->db->order_by("id","desc");
		$result=$this->db->query("select id,title, left(message,100) as msg,`from` from tblannouncement order by id desc limit 0,1");		
		$announcement=$result->result();
		return $announcement;
	}
	
	function get_page($limit=0,$start=0,$type){
		$this->db->join("tblannouncement_type","tblannouncement.id=tblannouncement_type.announcement_id","left");
		$this->db->where("type_id",$type);
		$this->db->or_where("type_id");
		$this->db->order_by("tblannouncement.id","desc");
		$this->db->limit($limit,$start);
		
		$result=$this->db->get("tblannouncement");		
		$announcement=$result->result();
		return $announcement;
	}
	
	function count(){
		$count =$this->db->count_all_results("tblannouncement");
		return $count;
	}
	
	function count_by_type($type){
		$this->db->join("tblannouncement_type","tblannouncement.id=tblannouncement_type.announcement_id","left");
		$this->db->where("type_id",$type);
		$this->db->or_where("type_id");
		$count =$this->db->count_all_results("tblannouncement");
		return $count;
	}
	
	function add($data){
		
		$message['success']=$this->db->insert("tblannouncement",$data);
		$message['id']= $this->db->insert_id();
		return $message;
	}
	
	function delete($id){
		$message['success']=$this->db->delete("tblannouncement",array("id"=>$id));
		$message['id']= $this->db->insert_id();
		return $message;
	}
}
