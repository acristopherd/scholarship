<?php

class course extends CI_Controller{
    function index(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
    		$this->session->set_flashdata("last_viewed",$this->uri->uri_string());
			$this->load->view("admin/session_expired_view");
			return;
		}
    	$this->load->model("course_model");
		$this->load->model("college_model");
		$data["courses"]=$this->course_model->get();
		$colleges=$this->college_model->get();
		$data['colleges']=array();
		$data['colleges'][-1]="-Select-";
		foreach($colleges as $college){
			$data['colleges'][$college->id]=$college->college;
		}
        $this->load->view("admin/course/course_view.php",$data);
    }
	
    function add(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
    		$this->session->set_flashdata("last_viewed",$this->uri->uri_string());
			$this->load->view("admin/session_expired_view");
			return;
		}
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		$this->form_validation->set_rules("accronym","Accronym","trim|required|min_length[2]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("name","Course Name","trim|required|min_length[5]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("college","College","trim|required|greater_than[0]|xss_clean");
		if($this->form_validation->run()==FALSE){
			$this->load->model("course_model");
			$this->load->model("college_model");
			$data["courses"]=$this->course_model->get();
			$colleges=$this->college_model->get();
			$data['colleges']=array();
			$data['colleges'][-1]="-Select-";
			foreach($colleges as $college){
				$data['colleges'][$college->id]=$college->college;
			}
	        $this->load->view("admin/course/course_view.php",$data);
		}
		else{
			$data=array("course"=>$this->input->post("accronym"),"desc"=>$this->input->post("name"),"coll_id"=>$this->input->post("college"));
			$this->load->model("course_model");
			$data["message"]=$this->course_model->insert($data);
    		redirect("course/");
		}
    }
	
    function edit(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
    		$this->session->set_flashdata("last_viewed",$this->uri->uri_string());
			$this->load->view("admin/session_expired_view");
			return;
		}
    	if($this->uri->segment(3)){
    		$id = $this->uri->segment(3);
			$this->load->model("course_model");
			$this->load->model("college_model");
			$data["courses"]=$this->course_model->get();
			$colleges=$this->college_model->get();
			$data['colleges']=array();
			$data['colleges'][-1]="-Select-";
			foreach($colleges as $college){
				$data['colleges'][$college->id]=$college->college;
			}
			$data['edit']=$this->course_model->get_course($id);
	        $this->load->view("admin/course/course_edit_view.php",$data);
    	}
		else{
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
	    	$this->form_validation->set_rules("id","ID","trim|required|min_length[1]|max_length[20]|xss_clean");
			$this->form_validation->set_rules("accronym","Accronym","trim|required|min_length[2]|max_length[20]|xss_clean");
			$this->form_validation->set_rules("name","Course Name","trim|required|min_length[5]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("college","College","trim|required|greater_than[0]|xss_clean");
			if($this->form_validation->run()==FALSE){
				$this->load->view("admin/course/course_edit_view.php");
			}
			else{
				$data["fields"]=array("course"=>$this->input->post("accronym"),"desc"=>$this->input->post("name"),"coll_id"=>$this->input->post("college"));
				$data["id"]=$this->input->post("id");
				$this->load->model("course_model");
				$data["message"]=$this->course_model->update($data["id"],$data["fields"]);
	    		redirect("course/");
			}
		}
    	
    }

	function getcourse(){
		$college=$this->input->post("college");
		$this->load->model("course_model");
		$data["courses"]=$this->course_model->get_by_college($college);
		foreach($data["courses"] as $course){
			echo "<option value=\"".$course->id."\">".$course->course."</option>";
		}
	}
}