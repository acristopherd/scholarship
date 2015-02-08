<?php

class osa extends CI_Controller{
	function index(){
		$this->load->view("home_view.php");
	}
	
	function grantee(){
		if($this->input->post("uname")){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("uname","Username","trim|required|min_length[5]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("password","Password","trim|required|min_length[5]|max_length[100]|xss_clean");
			if($this->form_validation->run()==FALSE){
				$this->load->view("grantee/login_view");
			}
			else{
				$hpass = hash("SHA256",$this->input->post("password")."dontmess")."4dm1n";
				$this->load->model("user_model");
				$data['login']=$this->user_model->get_login($this->input->post("uname"),$hpass);	
				if(sizeof($data['login'])>0 && trim($data['login'][0]->password)==trim($hpass)){
					
					$this->session->set_userdata(array("grantee_id"=>$data['login'][0]->id,
												"fname"=>$data['login'][0]->fname,
												"mname"=>$data['login'][0]->mname,
												"lname"=>$data['login'][0]->lname,
												"lvl"=>$data['login'][0]->access_level,
												"type_id"=>$data['login'][0]->type_id));
					$this->session->set_flashdata("message","Login successful.");
					
					if($this->session->userdata("last_page")){
						redirect($this->session->userdata("last_page")."#message");
					}
					else{
						redirect("osa/#message");
					}						
					
				}	
						
				else{
					
					$this->session->set_flashdata("login_failed","Username and password mismatched.");
					redirect("osa/grantee");
				}
			}
		}
		else{
			$this->load->view("grantee/login_view");
		}					
	}

	function grantee_logout(){
		$this->session->unset_userdata(array("grantee_id"=>"",
												"fname"=>"",
												"mname"=>"",
												"lname"=>"",
												"email"=>""));
		$this->session->set_flashdata("message","You have successfully logout.");
		redirect("osa");
	}
	
	function our_scholars(){
		if($this->session->userdata("grantee_id")){
			if($this->session->userdata("lvl")==1){
				$type_id = $this->session->userdata("type_id");
				$where['scholar_type'] = $type_id;
				$this->load->model("scholarship_model");
				$scholars=$this->scholarship_model->get_scholars($where);		
				$data['scholars']=array();
				foreach($scholars as $scholar){
					$requirements = $this->scholarship_model->get_requirements($scholar->aid);
					$data['scholars'][]=array("info"=>$scholar,"requirements"=>$requirements);
				}
				//print_r($data['scholars']);
				$this->load->view("grantee/scholar_view",$data);
			}
		}
		else{
			redirect("osa");
		}
	}
	
	function error404(){
		$this->load->view("error_404");
	}
	
}