<?php
class message_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
		
	function get($type=0){
		//$this->db->join("tbluser","tbluser.id=tblmessage.user_id","inner");
		$this->db->select("tblmessage.id as id,subject,date_posted,from_name,from_desc");
		//$this->db->where('msg_type',$type);
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblmessage");		
		$message=$result->result();
		return $message;
	}
	function get_inbox($to=0,$type=array()){
		//$this->db->join("tbluser","tbluser.id=tblmessage.user_id","inner");
		$this->db->select("tblmessage.id as id,subject,date_posted,from_name,from_desc,msg_read");
		$this->db->where('msg_to',$to);
		if(sizeof($type)>0)$this->db->where_in('msg_type',$type);
		$this->db->order_by("tblmessage.id","desc");
		$result=$this->db->get("tblmessage");		
		$message=$result->result();
		return $message;
	}
	
	function get_sent($from=0,$type=1){
		$this->db->join("tbluser","tbluser.id=tblsent_message.msg_to","left");
		$this->db->join("tblscholar","tblscholar.id=tblsent_message.msg_to","left");
		$this->db->join("tblmember","tblmember.id=tblsent_message.msg_to","left");
		$this->db->select("tblsent_message.id as id,subject,date_posted,msg_to,msg_type,tblscholar.fname as sfname,tblscholar.lname as slname,tbluser.fname as fname,tbluser.lname as lname,tblmember.fname as mfname,tblmember.lname as mlname");
		$this->db->where('msg_from',$from);
		if(sizeof($type)>0)$this->db->where_in('msg_type',$type);
		$this->db->order_by("tblsent_message.id","desc");
		$result=$this->db->get("tblsent_message");	
		//echo $this->db->last_query();	
		$message=$result->result();
		return $message;
	}
	
	function get_by_id($id){		
		//$this->db->join("tbluser","tbluser.id=tblmessage.user_id","inner");
		$this->db->where("tblmessage.id",$id);
		
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblmessage");		
		$message=$result->result();
		return $message;
	}
	function get_sent_by_id($id){		
		//$this->db->join("tbluser","tbluser.id=tblmessage.user_id","inner");
		$this->db->join("tbluser","tbluser.id=tblsent_message.msg_to","left");
		$this->db->join("tblscholar","tblscholar.id=tblsent_message.msg_to","left");
		$this->db->join("tblmember","tblmember.id=tblsent_message.msg_to","left");
		$this->db->select("tblsent_message.id as id,subject,message,date_posted,msg_to,msg_type,tblscholar.fname as sfname,tblscholar.lname as slname,tbluser.fname as fname,tbluser.lname as lname,tblmember.fname as mfname,tblmember.lname as mlname");
		
		$this->db->where("tblsent_message.id",$id);
		
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblsent_message");		
		$message=$result->result();
		return $message;
	}
	function get_some($limit=3,$start=0){
		$this->db->limit($limit,$start);
		$this->db->order_by("tblmessage.id","desc");
		//$this->db->join("tbluser","tbluser.id=msg_from","inner");
		$this->db->select(array("LEFT(message,50) as `message`","tblmessage.id as id,subject","date_posted","from_name","msg_read"));
		$this->db->where_in('msg_type',array('1','3','5'));
		$result=$this->db->get("tblmessage");		
		$message=$result->result();
		return $message;
	}
	
	function get_page($limit=0,$start=0){
		$this->db->limit($limit,$start);
		$this->db->order_by("id","desc");
		$result=$this->db->get("tblmessage");		
		$message=$result->result();
		return $message;
	}
	function count(){
		$count =$this->db->count_all_results("tblmessage");
		return $count;
	}
	
	function add($data){
		$this->db->trans_start();
		$message['success']=$this->db->insert("tblmessage",$data);
		$message['id']= $this->db->insert_id();
		$this->db->insert("tblsent_message",$data);
		$this->db->trans_complete();
		
		return $message;
	}
	function add_batch($data){
		$this->db->trans_start();
		$message['success']=$this->db->insert_batch("tblmessage",$data);
		$message['id']= $this->db->insert_id();
		$this->db->insert_batch("tblsent_message",$data);
		$this->db->trans_complete();
		
		return $message;
	}
	
	function update($id,$data){
		$this->db->update("tblmessage",$data,array("id"=>$id));
	}
	
	function delete($id){
		$message['success']=$this->db->delete("tblmessage",array("id"=>$id));
		$message['id']= $this->db->insert_id();
		return $message;
	}
	
	function delete_sent($id){
		$message['success']=$this->db->delete("tblsent_message",array("id"=>$id));
	
		return $message;
	}
}
