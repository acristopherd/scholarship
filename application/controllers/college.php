<?php

class college extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("college_model");
	}
	
    function index(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
    	
		$data["colleges"]=$this->college_model->get();
        $this->load->view("admin/college/college_view.php",$data);
    }
	
    function add(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		$this->form_validation->set_rules("accronym","Accronym","trim|required|min_length[2]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("name","college Name","trim|required|min_length[5]|max_length[100]|xss_clean");
		if($this->form_validation->run()==FALSE){
			$this->load->model("college_model");
			$data["colleges"]=$this->college_model->get();				
	        $this->load->view("admin/college/college_view.php",$data);
		}
		else{
			$data["insert"]=array("college"=>$this->input->post("accronym"),"desc"=>$this->input->post("name"));
			
			$data["message"]=$this->college_model->insert($data["insert"]);
			if($data["message"]){
				$this->session->set_flashdata("message","New college has been successfully added.");
    			redirect("college/#message");
			}
			else{
				$this->session->set_flashdata("message","Failed. Try again later.");
    			redirect("college/#message");
			}
		}
    }
	
    function edit(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
    	if($this->uri->segment(3)){
    		$id = $this->uri->segment(3);
			$this->load->model("college_model");
			$data["colleges"]=$this->college_model->get_college($id);
			echo "uri";
	        $this->load->view("admin/college/college_edit_view.php",$data);
    	}
		else{
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
	    	$this->form_validation->set_rules("id","ID","trim|required|min_length[1]|max_length[20]|xss_clean");
			$this->form_validation->set_rules("accronym","Accronym","trim|required|min_length[2]|max_length[20]|xss_clean");
			$this->form_validation->set_rules("name","college Name","trim|required|min_length[5]|max_length[100]|xss_clean");
			if($this->form_validation->run()==FALSE){
				$this->load->view("admin/college/college_edit_view.php");
			}
			else{
				$data["fields"]=array("college"=>$this->input->post("accronym"),"desc"=>$this->input->post("name"));
				$data["id"]=$this->input->post("id");
				$this->load->model("college_model");
				$data["message"]=$this->college_model->update($data["id"],$data["fields"]);
	    		redirect("college/");
			}
		}
    	
    	
    }
}