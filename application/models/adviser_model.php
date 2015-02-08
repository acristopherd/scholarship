<?php
class adviser_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
		
	function get($id){
		$this->db->where("scholarship_id",$id);
		$result=$this->db->get("tbladviser");
		
		$scholar=$result->result();
		//echo $this->db->last_query();
		return $scholar;
	}
	
	function insert($data){
		
		$this->db->where("scholarship_id",$data['scholarship_id']);
		$result=$this->db->get("tbladviser");			
		$scholar=$result->result();
		if(sizeof($scholar)<=0){
			$message=$this->db->insert("tbladviser",$data);
			return $message;		
		}
		else{
			return 0;
		}
		
	}
	
	
	
	
}
