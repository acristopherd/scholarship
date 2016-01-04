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
	
	function get_pending(){
		$this->db->order_by('id','desc');
		$this->db->where('account_approved',0);
		$result=$this->db->get("tblscholar");
		//echo $this->db->last_query();
		$scholar=$result->result();
		return $scholar;
	}
	
	function count_pending(){
		$this->db->where('account_approved',0);
		$this->db->from('tblscholar');
		$result=$this->db->count_all_results();
		//echo $this->db->last_query();
		
		return $result;
	}
	
	function get_confirmed(){
		$this->db->order_by("lname","asc");
		$this->db->order_by("gender","desc");
		$this->db->where('confirmed','1');
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
	
	function get_by_aid($aid){
		$this->db->select("fname,mname,lname,college,dean,tblcollege.desc as college_name,yr_level,tblcourse.desc as course_name,gender");
		$this->db->join("tblscholarship","tblscholarship.sid=tblscholar.id");
		$this->db->join("tblcourse","tblcourse.id=cour_id");
		$this->db->join("tblcollege","tblcollege.id=tblscholarship.coll_id");
		$this->db->where("aid",$aid);
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
	
	function delete($id){
		$success=$this->db->delete('tblscholar',array('id'=>$id));
		return  $success;
	}
}
