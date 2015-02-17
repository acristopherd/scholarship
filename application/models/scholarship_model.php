<?php

class scholarship_model extends CI_Model{
	function insert($data){
		$message['success']=$this->db->insert("tblscholarship",$data);
		$message['id']= $this->db->insert_id();
		return $message;
	}
	
	function check($sid,$sem,$sy){
		$this->db->where("sid",$sid);
		$this->db->where("semester",$sem);
		$this->db->where("sy",$sy);
		$result=$this->db->get("tblscholarship");
		$scholarship=$result->result();
		return $scholarship;
	}
	function update_average($id,$data){
		$this->db->update("tblscholarship",$data,array("aid"=>$id));
	}
	function get(){
		$result=$this->db->get("tblscholarship");
		$scholarship=$result->result();
		return $scholarship;
	}
	
	function get_latest_by_id($id){
		$result=$this->db->query("select * from tblscholarship 
								where sid=$id order by aid desc limit 0,1");/*where sy=(select distinct sy from tblscholarship order by aid asc limit 0,1) and 
								semester=(select distinct semester from tblscholarship order by aid asc limit 0,1)*/
		//echo $this->db->last_query();
		return $result->result();
	}
	function get_latest_by_college(){
		$result=$this->db->query("select coll_id,count(aid) as sos,college from tblscholarship 
								inner join tblcollege on tblcollege.id = coll_id
								where sy=(select distinct sy from tblscholarship order by aid asc limit 0,1) and 
								semester=(select distinct semester from tblscholarship order by aid asc limit 0,1)
								group by coll_id");/**/
		return $result->result();
	}
	
	function get_latest_by_type(){
		$result=$this->db->query("select scholar_type,count(aid) as sos,type from tblscholarship 
								inner join tblscholar_type on tblscholar_type.id = scholar_type
								where sy=(select distinct sy from tblscholarship order by aid asc limit 0,1) and 
								semester=(select distinct semester from tblscholarship order by aid asc limit 0,1)
								group by scholar_type");/**/
		return $result->result();
	}
	
	function get_existing_scholarship($sy,$sem,$id){
		$this->db->where("sy",$sy);
		$this->db->where("semester",$sem);
		$this->db->where("sid",$id);
		$this->db->select("aid");
		$result=$this->db->get("tblscholarship");
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	
	function get_by_id($scholar_id){
		$this->db->where("sid",$scholar_id);
		$this->db->join("tblscholar_type", "tblscholarship.scholar_type=tblscholar_type.id");
		$this->db->order_by("aid","desc"); 	
		$result=$this->db->get("tblscholarship");		
		$scholarship=$result->result();
		return $scholarship;
	}
	
	function get_by_scholarship($scholar_id){
		$this->db->where("aid",$scholar_id);
		$this->db->join("tblscholar_type", "tblscholarship.scholar_type=tblscholar_type.id");
		$result=$this->db->get("tblscholarship");		
		$scholarship=$result->result();
		//echo $this->db->last_query();
		return $scholarship;
	}
	
	function get_scholars($data=NULL){
		$this->db->join("tblscholar","tblscholar.id=tblscholarship.sid","inner");
		$this->db->join("tblscholar_type","tblscholar_type.id=tblscholarship.scholar_type","inner");	
		if(empty($data)){
			$result=$this->db->get("tblscholarship");
		}	
		else{
			$result=$this->db->get_where("tblscholarship",$data);
		}
		$this->db->order_by("tblscholarship.scholar_type","asc");
		$scholarship=$result->result();
		//echo $this->db->last_query();
		return $scholarship;
	}
	
	function get_scholars_by_college($data=NULL){
		$sql="select * from tblscholarship 
								inner join tblscholar on tblscholarship.sid = tblscholar.id
								inner join tblcollege on tblcollege.id = tblscholarship.coll_id
								inner join tblscholar_type on scholar_type = tblscholar_type.id
								inner join tblcourse on tblscholarship.cour_id = tblcourse.id
								where sy= ? and 
								semester= ?	and 
								approved =1 and tblscholarship.coll_id= ?";
		
		$result=$this->db->query($sql,$data);
		$scholarship=$result->result();
		//echo $this->db->last_query();
		return $scholarship;
	}
	
	function get_scholars_by_course($data=NULL){
		$sql="select * from tblscholarship 
								inner join tblscholar on tblscholarship.sid = tblscholar.id
								inner join tblcollege on tblcollege.id = tblscholarship.coll_id
								inner join tblscholar_type on scholar_type = tblscholar_type.id
								inner join tblcourse on tblscholarship.cour_id = tblcourse.id
								where sy= ? and 
								semester= ?	and 
								approved =1 and tblscholarship.cour_id= ?";
		
		$result=$this->db->query($sql,$data);
		$scholarship=$result->result();
		//echo $this->db->last_query();
		return $scholarship;
	}
	
	function get_scholars_by_type($data=NULL){
		$sql="select * from tblscholarship 
								inner join tblscholar on tblscholarship.sid = tblscholar.id
								inner join tblcollege on tblcollege.id = tblscholarship.coll_id
								inner join tblscholar_type on scholar_type = tblscholar_type.id
								inner join tblcourse on tblscholarship.cour_id = tblcourse.id
								where sy= ? and 
								semester= ?	and 
								approved =1 and scholar_type= ?";
		
		$result=$this->db->query($sql,$data);
		$scholarship=$result->result();
		//echo $this->db->last_query();
		return $scholarship;
	}
	
	function confirm($aid){
		$data = array("approved"=>"1");
		$success=$this->db->update("tblscholarship",$data,array("aid"=>$aid));
		return $success;
	}
	
	function confirm_all($data){
		$success=$this->db->update_batch("tblscholarship",$data,"aid");
		return $success;
	}
	function get_requirements($aid){
		$this->db->join("tbltype_requirement","tblscholarship.scholar_type=tbltype_requirement.type_id","inner");
		$this->db->join("tblrequirement","tblrequirement.scholarship_id = tblscholarship.aid and tblrequirement.scholar_type=tbltype_requirement.id","left");
		$this->db->where("aid",$aid);
		$this->db->distinct();
		$result=$this->db->get("tblscholarship");
		$requirements=$result->result();
		//echo $this->db->last_query();
		return $requirements;
	}
	function get_colleges(){		
		$result=$this->db->query("select distinct(coll_id),college,tblcollege.desc from tblscholarship inner join tblcollege on tblcollege.id = coll_id");
		$colleges=$result->result();
		return $colleges;
	}
	function get_courses(){		
		$result=$this->db->query("select distinct(cour_id),course,tblcourse.desc from tblscholarship inner join tblcourse on tblcourse.id = cour_id");
		$courses=$result->result();
		return $courses;
	}
	function get_sems(){		
		$result=$this->db->query("select distinct(semester) from tblscholarship");
		$courses=$result->result();
		return $courses;
	}
	function get_sys(){		
		$result=$this->db->query("select distinct(sy) from tblscholarship");
		$courses=$result->result();
		return $courses;
	}
	function get_types(){
		$result=$this->db->query("select distinct(scholar_type),type from tblscholarship inner join tblscholar_type on tblscholarship.scholar_type = tblscholar_type.id");
		$types=$result->result();
		return $types;
	}
	function get_towns(){		
		$result=$this->db->query("select distinct(town)from tblscholarship inner join tblscholar on tblscholar.id = tblscholarship.sid");
		$courses=$result->result();
		return $courses;
	}
}
