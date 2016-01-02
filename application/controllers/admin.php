<?php

class admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("scholarship_model");
	}
    function index(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$this->load->model('message_model');
		$this->load->model('scholarship_model');
		$this->load->model('scholar_model');
		$data['new_messages']=$this->message_model->count_unread(array(1,3,5));
		$data['pending_scholarships']=$this->scholarship_model->count_pending();
		$data['pending_scholars']=$this->scholar_model->count_pending();
        $this->load->view("admin/home_view.php",$data);
    }
    
	function logout(){
		$this->session->unset_userdata(array("super_admin_id"=>"",
												"admin_id"=>"",
												"college_user_id"=>"",
												"staff_id"=>"",
												"fname"=>"",
												"mname"=>"",
												"lname"=>"",
												"username"=>"",
												"college_id"=>"",
												"access_level"=>"",
												"admin_secret"=>""));
		redirect("admin/login");
	}
	function login(){
		if($this->input->post("username")){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("username","Username","trim|required|min_length[5]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("password","Password","trim|required|min_length[5]|max_length[100]|xss_clean");
			if($this->form_validation->run()==FALSE){
				$this->load->view("admin/login_view");
			}
			else{
				$hpass = hash("SHA256",$this->input->post("password")."dontmess")."4dm1n";
				$this->load->model("user_model");
				
				$data['login']=$this->user_model->get_login($this->input->post("username"),$hpass);	
				//echo $hpass . " ". $data['login'][0]->password;
				//print_r($data['login']);
				if(sizeof($data['login'])>0 && trim($data['login'][0]->password)==trim($hpass)&&$data['login'][0]->access_level>=2){
					if($data['login'][0]->access_level==5){
						$this->session->set_userdata(array("super_admin_id"=>$data['login'][0]->id,
												"fname"=>$data['login'][0]->fname,
												"mname"=>$data['login'][0]->mname,
												"lname"=>$data['login'][0]->lname,
												"username"=>$data['login'][0]->username,
												"access_level"=>$data['login'][0]->access_level,
												"admin_secret"=>$this->encrypt->encode("ic4ntThink0fAno+h3r")));
					}
					else if($data['login'][0]->access_level==4){
						$this->session->set_userdata(array("admin_id"=>$data['login'][0]->id,
												"fname"=>$data['login'][0]->fname,
												"mname"=>$data['login'][0]->mname,
												"lname"=>$data['login'][0]->lname,
												"username"=>$data['login'][0]->username,
												"access_level"=>$data['login'][0]->access_level,
												"admin_secret"=>$this->encrypt->encode("ic4ntThink0fAno+h3r")));
					}
					else if($data['login'][0]->access_level==3){
						$this->session->set_userdata(array("college_user_id"=>$data['login'][0]->id,
												"fname"=>$data['login'][0]->fname,
												"mname"=>$data['login'][0]->mname,
												"lname"=>$data['login'][0]->lname,
												"username"=>$data['login'][0]->username,
												"access_level"=>$data['login'][0]->access_level,
												"college_id"=>$data['login'][0]->college_id,
												"admin_secret"=>$this->encrypt->encode("ic4ntThink0fAno+h3r")));
					}
					else if($data['login'][0]->access_level==2){
						$this->session->set_userdata(array("staff_id"=>$data['login'][0]->id,
												"fname"=>$data['login'][0]->fname,
												"mname"=>$data['login'][0]->mname,
												"lname"=>$data['login'][0]->lname,
												"username"=>$data['login'][0]->username,
												"access_level"=>$data['login'][0]->access_level,												
												"admin_secret"=>$this->encrypt->encode("ic4ntThink0fAno+h3r")));
					}
					redirect("admin");
				}			
				else{
					//echo "login failed";
					$this->session->set_flashdata("login_failed","Username and Password did not match.");
					redirect("admin/login#message");
				}
			}
		}
		else{
			//echo "no data";
			$this->load->view("admin/login_view");
		}
	}
	
	function login_required(){
		if($this->input->post("username")){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("username","Username","trim|required|min_length[5]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("password","Password","trim|required|min_length[5]|max_length[100]|xss_clean");
			if($this->form_validation->run()==FALSE){
				$this->load->view("admin/login_view");
			}
			else{
				$hpass = hash("SHA256",$this->input->post("password")."dontmess")."4dm1n";
				$this->load->model("user_model");
				
				$data['login']=$this->user_model->get_login($this->input->post("username"),$hpass);	
				//echo $hpass . " ". $data['login'][0]->password;
				//print_r($data['login']);
				if(sizeof($data['login'])>0 && trim($data['login'][0]->password)==trim($hpass)&&$data['login'][0]->access_level>=2){
					if($data['login'][0]->access_level==5){
						$this->session->set_userdata(array("super_admin_id"=>$data['login'][0]->id,
												"fname"=>$data['login'][0]->fname,
												"mname"=>$data['login'][0]->mname,
												"lname"=>$data['login'][0]->lname,
												"username"=>$data['login'][0]->username,
												"access_level"=>$data['login'][0]->access_level,
												"admin_secret"=>$this->encrypt->encode("ic4ntThink0fAno+h3r")));
					}
					else if($data['login'][0]->access_level==4){
						$this->session->set_userdata(array("admin_id"=>$data['login'][0]->id,
												"fname"=>$data['login'][0]->fname,
												"mname"=>$data['login'][0]->mname,
												"lname"=>$data['login'][0]->lname,
												"username"=>$data['login'][0]->username,
												"access_level"=>$data['login'][0]->access_level,
												"admin_secret"=>$this->encrypt->encode("ic4ntThink0fAno+h3r")));
					}
					else if($data['login'][0]->access_level==3){
						$this->session->set_userdata(array("college_user_id"=>$data['login'][0]->id,
												"fname"=>$data['login'][0]->fname,
												"mname"=>$data['login'][0]->mname,
												"lname"=>$data['login'][0]->lname,
												"username"=>$data['login'][0]->username,
												"access_level"=>$data['login'][0]->access_level,
												"college_id"=>$data['login'][0]->college_id,
												"admin_secret"=>$this->encrypt->encode("ic4ntThink0fAno+h3r")));
					}
					else if($data['login'][0]->access_level==2){
						$this->session->set_userdata(array("staff_id"=>$data['login'][0]->id,
												"fname"=>$data['login'][0]->fname,
												"mname"=>$data['login'][0]->mname,
												"lname"=>$data['login'][0]->lname,
												"username"=>$data['login'][0]->username,
												"access_level"=>$data['login'][0]->access_level,												
												"admin_secret"=>$this->encrypt->encode("ic4ntThink0fAno+h3r")));
					}
					if($this->session->flashdata("last_viewed")){
						redirect($this->session->flashdata("last_viewed"));
					}else{
						redirect("admin");
					}
				}			
				else{
					//echo "login failed";
					$this->session->set_flashdata("login_failed","Username and Password did not match.");
					$this->session->set_flashdata("last_viewed",$this->session->flashdata("last_viewed"));
					redirect("admin/login_required#message");
				}
			}
		}
		else{
			$this->load->view("admin/session_expired_view");
		}
	}
	
    function course(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
    		$this->session->set_flashdata("last_viewed",$this->uri->uri_string());
			$this->load->view("admin/session_expired_view");
			return;
		}
    	$this->load->model("course_model");
		$data["courses"]=$this->course_model->get_course();
        $this->load->view("admin/course/course_view.php",$data);
    }
	
	
	function encode_grade(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$this->load->view("admin/scholar/encode_grade_view");
	}
	
	
}