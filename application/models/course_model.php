<?php 
class course_model extends CI_Model{
	function get(){
		$this->db->select("tblcourse.id as id, course,tblcourse.desc, college");
		$this->db->join("tblcollege","tblcollege.id=tblcourse.coll_id");
		$this->db->order_by('college');
		$result=$this->db->get("tblcourse");
		$course=$result->result();
		return $course;
	}
	function get_course($id){
		$this->db->where("id",$id);
		$result=$this->db->get("tblcourse");
		$course=$result->result();
		return $course;
	}
	function insert($data){
		$message=$this->db->insert("tblcourse",$data);
		return $message;
	}
	function update($id,$data){
		$this->db->where("id",$id);
		$message=$this->db->update("tblcourse",$data);
		return $message;
	}
	
	function get_by_college($id){
		$this->db->where("coll_id",$id);
		$result=$this->db->get("tblcourse");
		$course=$result->result();
		return $course;
	}
}
