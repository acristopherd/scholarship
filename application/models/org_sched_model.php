<?php
class org_sched_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
		
	function get(){
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblorg_sched");		
		$announcement=$result->result();
		return $announcement;
	}
	
	
	function count(){
		$count =$this->db->count_all_results("tblorg_sched");
		return $count;
	}
	
	
	function add($data){
		
		$message['success']=$this->db->insert("tblorg_sched",$data);
		$message['id']= $this->db->insert_id();
		return $message;
	}
	
}
