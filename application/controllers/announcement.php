<?php

class announcement extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("announcement_model");
		$this->load->model("announcement_type_model");
	}
    function index(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		
    	$data['announcements']=$this->announcement_model->get();
        $this->load->view("admin/announcement/announcement_view.php",$data);
    }
    
    function view(){
    	if(!$this->session->userdata("user_id")) {
			$this->load->view("error_404");
			return;
		}
		$this->load->model("scholarship_model");
		$scholar_type =$this->scholarship_model->get_latest_by_id($this->session->userdata("user_id"));
    	$this->load->library('pagination');
		$url = site_url("announcement/view");
		$url=str_replace(".html", "",$url);
		$config['base_url'] = $url;
		$config['total_rows'] = $this->announcement_model->count_by_type($scholar_type[0]->scholar_type);		
		$config['per_page'] = 4; 
		$config['use_query_string']=true;
		
		$this->pagination->initialize($config); 
		$start = $this->uri->segment(3)?$this->uri->segment(3):0;
		$data['links']= $this->pagination->create_links();
    	
		$data['announcements']=array();
		
		
    	$announcements=$this->announcement_model->get_page($config['per_page'],$start,$scholar_type[0]->scholar_type);
    	//$data['announcements']=$this->announcement_model->get_page($config['per_page'],$start);
		foreach($announcements as $announcement){
			$type=$this->announcement_type_model->get_by_id($announcement->id);
			/*if(sizeof($type)==0){
				$data['announcements'][]=array('all'=>$announcement);
			}
			elseif($type->)*/
			$data['announcements'][]=array('all'=>$announcement,'type'=>$type);
			//print_r($announcement);
		}
		//print_r($data['announcements']);
    	$this->load->view("announcement_view.php",$data);
    }
	function add(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$this->load->model("scholartype_model");
		$types=$this->scholartype_model->get();
		$data["types"]=array();
		foreach($types as $type){
			$data["types"][$type->id]=$type->type;
		}
		$this->load->view("admin/announcement/add.php",$data);
	}
	
	function delete(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$id = $this->uri->segment(3);
		$delete=$this->announcement_model->delete($id);
		if($delete){
			$this->session->set_flashdata("message","Successfully deleted.");
			redirect("announcement#message");
		}
		else{
			$this->session->set_flashdata("message","Delete failed. Please try again later.");
			redirect("announcement#message");
		}
	}
	function save(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		$this->form_validation->set_rules("a_title","Title","trim|required|min_length[1]|max_length[80]|xss_clean");
		$this->form_validation->set_rules("a_date","Date","trim|xss_clean");
		$this->form_validation->set_rules("a_time","Time","trim|xss_clean");
		$this->form_validation->set_rules("a_venue","Venue","trim|max_length[80]|xss_clean");
		$this->form_validation->set_rules("a_from","From","trim|required|min_length[1]|max_length[80]|xszs_clean");
		$this->form_validation->set_rules("a_msg","Message","trim|required|min_length[1]|max_length[5000]|xss_clean");
		if($this->form_validation->run()==FALSE){
			$this->load->view("admin/announcement/add.php");
		}
		else{
			$data['save']=array("title"=>$this->input->post("a_title"),
								"message"=>$this->input->post("a_msg"),
								"venue"=>$this->input->post("a_venue"),
								"date_of_event"=>$this->input->post("a_date"),
								"time_of_event"=>$this->input->post("a_time"),
								"from"=>$this->input->post("a_from"),
								"date_posted"=>mdate("%Y-%m-%d %h:%i:%s"));
			$result=$this->announcement_model->add($data['save']);
			
			$this->load->model("announcement_type_model");
			
			foreach($this->input->post("types") as $type){
				$data["announcement_type"]=array("announcement_id"=>$result["id"],"type_id"=>$type);
				$this->announcement_type_model->insert($data["announcement_type"]);
			}
			if($result['success']==1){
				$this->session->set_flashdata("message","Your announcement has been successfully saved.");
				redirect("announcement#message");
			}
			else{
				$this->session->set_flashdata("message","Your announcement was not saved. Please try again later.");
				redirect("announcement#message");
			}
		}
	}

	function get_latest(){
		$announcement = $this->announcement_model->get_latest();
		echo json_encode($announcement);
	}

}