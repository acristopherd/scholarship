<?php

class scholarshiptype extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("scholartype_model");
		$this->load->model("type_requirement_model");
	}
	
    function index(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
    	
		
		$types=$this->scholartype_model->get();
		foreach($types as $type){
			$requirements = $this->type_requirement_model->get($type->id);
			$data['types'][]=array("info"=>$type,"requirements"=>$requirements);
		}
        $this->load->view("admin/scholarship_type/scholarship_type_view.php",$data);
    }
	
    function add(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		$this->form_validation->set_rules("name","Scholarship Name","trim|required|min_length[5]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("min_grade","Minimum Grade","trim|required|min_length[1]|max_length[100]|xss_clean");		
		$this->form_validation->set_rules("min_ave","Average","trim|required|min_length[1]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("requirements[]","Requirements","trim|max_length[100]|xss_clean");
		if($this->form_validation->run()==FALSE){			
			$types=$this->scholartype_model->get();
			foreach($types as $type){
				$requirements = $this->type_requirement_model->get($type->id);
				$data['types'][]=array("info"=>$type,"requirements"=>$requirements);
			}				
	        $this->load->view("admin/scholarship_type/scholarship_type_view.php",$data);
		}
		else{
			$data=array("type"=>$this->input->post("name"),
						"minimum_grade"=>$this->input->post("min_grade"),
						"average"=>$this->input->post("min_ave"));
			
			
			$data["message"]=$this->scholartype_model->insert($data);
			if($data["message"]["success"]){
				foreach($this->input->post("requirements") as $requirement){
					$data["requirement"]=array("type_id"=>$data["message"]["insert_id"],"requ_name"=>$requirement);
					$this->type_requirement_model->insert($data["requirement"]);
				}
			}
			$this->session->set_flashdata("message","Scholarship type successfully added.");
			redirect("scholarshiptype/#message");
		}
    }
	
    function edit(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
    	if($this->uri->segment(3)){
    		$id = $this->uri->segment(3);
			
			
			$types=$this->scholartype_model->get_by_id($id);
			foreach($types as $type){
				$requirements = $this->type_requirement_model->get($type->id);
				$data['types'][]=array("info"=>$type,"requirements"=>$requirements);
			}
	        $this->load->view("admin/scholarship_type/edit_scholarship_type_view.php",$data);
    	}
		else{
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
	    	$this->form_validation->set_rules("id","ID","trim|required|min_length[1]|max_length[20]|xss_clean");
			$this->form_validation->set_rules("name","Scholarship Name","trim|required|min_length[5]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("min_grade","Minimum Grade","trim|required|min_length[1]|max_length[100]|xss_clean");		
			$this->form_validation->set_rules("min_ave","Average","trim|required|min_length[1]|max_length[100]|xss_clean");		
			$this->form_validation->set_rules("requirements[]","Requirements","trim|max_length[100]|xss_clean");
			if($this->form_validation->run()==FALSE){
				$this->load->view("admin/scholarship_type/edit_scholarship_type_view.php");
			}
			else{
				$data["fields"]=array("type"=>$this->input->post("name"),
										"minimum_grade"=>$this->input->post("min_grade"),
										"average"=>$this->input->post("min_ave"));
				$data["id"]=$this->input->post("id");
				
				$data["message"]=$this->scholartype_model->update($data["id"],$data["fields"]);
				
				//$this->type_requirement_model->delete_by_type($data["id"]);
				if($data["message"]){
					foreach($this->input->post("requirements") as $requirement){
						$data["requirement"]=array("type_id"=>$data["id"],"requ_name"=>$requirement);
						$this->type_requirement_model->insert($data["requirement"]);
					}
				}
	    		redirect("scholarshiptype/");
			}
		}
    	
    	
    }
    
    function delete(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$id = $this->uri->segment(3);
		$delete=$this->scholartype_model->delete($id);
		$this->type_requirement_model->delete_by_type($id);
		if($delete){
			$this->session->set_flashdata("message","Successfully deleted.");
			redirect("scholarshiptype#message");
		}
		else{
			$this->session->set_flashdata("message","Delete failed. Please try again later.");
			redirect("scholarshiptype#message");
		}
	}

}