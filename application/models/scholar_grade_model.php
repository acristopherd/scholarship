<?php 
class scholar_grade_model extends CI_Model{
	
	
	function insert($data){
		$message=$this->db->insert("tblgrade",$data);
		return $message;
	}
	
	function get($id,$sy,$sem){
		$this->db->where("sid",$id);
		$result=$this->db->get("tblgrade");
		$grade=$result->result();
		return $grade;
	}
	
	function get_by_aid($aid){
		$this->db->where("sid",$aid);
		$this->db->limit(1,0);
		$result=$this->db->get("tblgrade");
		$grade=$result->result();
		return $grade;
	}
}
