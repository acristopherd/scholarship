<?php 
class user_model extends CI_Model{
	function get(){
		$this->db->select("tbluser.id as id,fname,mname,lname,username,access_level,type_id,type,college_id,college");
		$this->db->join("tbluser_grantee","tbluser_grantee.user_id=tbluser.id","left");
		$this->db->join("tbluser_college","tbluser_college.user_id=tbluser.id","left");
		$this->db->join("tblscholar_type","tbluser_grantee.type_id=tblscholar_type.id","left");
		$this->db->join("tblcollege","tbluser_college.college_id=tblcollege.id","left");
		$result=$this->db->get("tbluser");
		$user=$result->result();
		return $user;
	}
	function get_user($id){
		$this->db->where("id",$id);
		$result=$this->db->get("tbluser");
		$user=$result->result();
		return $user;
	}
	
	function get_by_level($level){
		$this->db->where("access_level",$level);
		$result=$this->db->get("tbluser");
		$user=$result->result();
		return $user;
	}
	
	function get_grantee($type){
		$this->db->select("user_id as id,fname,mname,lname,username,access_level");
		$this->db->join("tbluser_grantee","tbluser_grantee.user_id=tbluser.id","inner");
		$this->db->where('type_id',$type);
		$result=$this->db->get("tbluser");
		$user=$result->result();
		//echo $this->db->last_query();
		return $user;
	}
	function get_login($uname,$pw){
		$this->db->select("tbluser.id as id,fname,mname,lname,password,username,access_level,type_id,college_id");
		$this->db->join("tbluser_grantee","tbluser_grantee.user_id=tbluser.id","left");
		$this->db->join("tbluser_college","tbluser_college.user_id=tbluser.id","left");
		$this->db->where("username",$uname);
		//$this->db->where("password",$pw);
		$result=$this->db->get("tbluser");		
		$scholar=$result->result();
		//echo $this->db->last_query();
		return $scholar;
	}
	
	function insert($data){
		$message['success']=$this->db->insert("tbluser",$data);
		$message['insert_id']=$this->db->insert_id();
		return $message;
	}
	function update($id,$data){
		$this->db->where("id",$id);
		$message=$this->db->update("tbluser",$data);
		return $message;
	}
	
	function delete($id){
		$success = $this->db->delete("tbluser",array("id"=>$id));
		return $success;
	}
}
