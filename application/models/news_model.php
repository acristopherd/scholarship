<?php
class news_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
		
	function get(){
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblnews");		
		$announcement=$result->result();
		return $announcement;
	}
	function get_by_id($id){
		$this->db->order_by("id","desc");
		$this->db->where('id',$id);
		$result=$this->db->get("tblnews");		
		$announcement=$result->result();
		return $announcement;
	}
	
	function get_page($limit=0,$start=0){
		$this->db->limit($limit,$start);
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblnews");		
		$announcement=$result->result();
		return $announcement;
	}
	
	function get_by_title($id){
		$this->db->order_by("id","desc");
		$this->db->where('title',$id);
		$result=$this->db->get("tblnews");		
		$announcement=$result->result();
		return $announcement;
	}
	
	function get_latest($limit){
		$this->db->limit(0,0);
		$this->db->order_by("id","desc");
		$result=$this->db->query("select id,title, left(news,100) as msg,`author` from tblnews order by id desc limit 0,".$limit);		
		$announcement=$result->result();
		//echo $this->db->last_query();
		return $announcement;
	}
	
	function count(){
		$count =$this->db->count_all_results("tblnews");
		return $count;
	}
	
	function add($data){
		
		$message['success']=$this->db->insert("tblnews",$data);
		$message['id']= $this->db->insert_id();
		return $message;
	}
	
	function delete($id){
		$message['success']=$this->db->delete("tblnews",array("id"=>$id));
		$message['id']= $this->db->insert_id();
		return $message;
	}
}
