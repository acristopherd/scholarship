<?php
class scholar_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function insert($data){
		$message['success']=$this->db->insert("tblscholar",$data);
		$message['id']= $this->db->insert_id();
		return $message;
	}
	
	
	function get(){
		$this->db->order_by("lname","asc");
		$this->db->order_by("gender","desc");
		$result=$this->db->get("tblscholar");
		
		$scholar=$result->result();
		return $scholar;
	}
	
	function get_by_id($id){
		$this->db->where("id",$id);
		$result=$this->db->get("tblscholar");
		
		$scholar=$result->result();
		return $scholar;
	}
	
	function get_login($email,$pw){
		$this->db->where("email",$email);
		$this->db->where("pass",$pw);
		$result=$this->db->get("tblscholar");		
		$scholar=$result->result();
		return $scholar;
	}
	
	function get_by_scholarship_id($id){
		$this->db->join("tblscholarship","tblscholarship.sid=tblscholar.id");
		$this->db->join("tblcourse","tblcourse.id=cour_id");
		$this->db->where("aid",$id);
		$result=$this->db->get("tblscholar");
		$scholar=$result->result();
		return $scholar;
	}
	
	function get_existing_scholar($fname,$mname,$lname){
		$this->db->where("fname",$fname);
		$this->db->where("mname",$mname);
		$this->db->where("lname",$lname);
		$this->db->select("id");
		$result=$this->db->get("tblscholar");
		//return $this->db->last_query();
		return $result->num_rows();
	}
	
	function get_existing_email($email){
		$this->db->where("email",$email);
		$this->db->select("id");
		$result=$this->db->get("tblscholar");
		//return $this->db->last_query();
		return $result->num_rows();
	}
	
	function confirm($id,$data){
		$this->db->where("id",$id);
		$this->db->update("tblscholar",$data);
	}
	
	function update($id,$data){
		$this->db->where("id",$id);
		$success=$this->db->update("tblscholar",$data);
		return $success;
	}
}
