<?php
class user extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("user_model");
	}
    function index(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r"||$this->session->userdata("access_level")<4) {
			$this->load->view("error_404");
			return;
		}
		$this->load->model("college_model");
		$colleges=$this->college_model->get();
		$data['colleges']=array();
		$data['colleges']['']="-Select-";
		foreach($colleges as $college){
			$data['colleges'][$college->id]=$college->college;
		}
    	$this->load->model("scholartype_model");
		$types=$this->scholartype_model->get();
		$data["types"]=array();
		foreach($types as $type){
			$data["types"][$type->id]=$type->type;
		}
		$data["users"]=$this->user_model->get();
        $this->load->view("admin/user/view.php",$data);
    }
	
    function add(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r"||$this->session->userdata("access_level")<4) {
			$this->load->view("error_404");
			return;
		}
		$this->form_validation->set_message("password_check","Your password should contain atleast 1 Uppercase, 1 Lowercase and 1 Number.");
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		$this->form_validation->set_rules("firstname","First Name","trim|required|min_length[2]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("middlename","Middle Name","trim|min_length[0]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("lastname","Last Name","trim|required|min_length[2]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("uname","Username","trim|required|min_length[5]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("pass","Password","trim|required|min_length[8]|max_length[100]|xss_clean|callback_password_check");
		$this->form_validation->set_rules("cpass","Password","trim|required|matches[pass]");
		$this->form_validation->set_rules("lvl","Access Level","trim|required|greater_than[0]|xss_clean");
		$this->form_validation->set_rules("type","Scholarship","trim|xss_clean");
		if($this->form_validation->run()==FALSE){
			$this->load->model("college_model");
		$colleges=$this->college_model->get();
		$data['colleges']=array();
		$data['colleges']['']="-Select-";
		foreach($colleges as $college){
			$data['colleges'][$college->id]=$college->college;
		}
    	$this->load->model("scholartype_model");
		$types=$this->scholartype_model->get();
		$data["types"]=array();
		foreach($types as $type){
			$data["types"][$type->id]=$type->type;
		}
	        $this->load->view("admin/user/view.php",$data);
		}
		else{
			$hpass = hash("SHA256",$this->input->post("pass")."dontmess")."4dm1n";
			$data=array("fname"=>$this->input->post("firstname"),
						"mname"=>$this->input->post("middlename"),
						"lname"=>$this->input->post("lastname"),
						"username"=>$this->input->post("uname"),
						"password"=>$hpass,
						"access_level"=>$this->input->post("lvl"));
			$data["message"]=$this->user_model->insert($data);
			
			if($this->input->post("lvl")==1 && $data["message"]["success"]==1){
				$data["type"]=array("user_id"=>$data["message"]["insert_id"],"type_id"=>$this->input->post("type"));
				$this->load->model("user_grantee_model");
				$this->user_grantee_model->insert($data['type']);
			}
			
			if($this->input->post("lvl")==3 && $data["message"]["success"]==1){
				$data["college"]=array("user_id"=>$data["message"]["insert_id"],
				"college_id"=>$this->input->post("college"));
				$this->load->model("user_college_model");
				$this->user_college_model->insert($data['college']);
			}
			$this->session->set_flashdata("message","User has been created.");
    		redirect("user#message");
		}
    }
	
	function reset_pw(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r"||$this->session->userdata("access_level")<4) {
			$this->load->view("error_404");
			return;
		}
		$id=$this->uri->segment(3);
		if(md5($id."restm3")==$this->uri->segment(4)){
			$hpass = hash("SHA256","12345678"."dontmess")."4dm1n";
			$data=array("password"=>$hpass);
			$success=$this->user_model->update($id,$data);
			if($success==1){
				$this->session->set_flashdata("message","User password has been reset to 12345678.");
				redirect("user/#message");
			}
			else{
				$this->session->set_flashdata("message","Failed to delete. Please try again later");
				redirect("user/#message");
			}
		}
		else{
			redirect("user/");
		}
	}
    function edit(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r"||$this->session->userdata("access_level")<4) {
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

	function delete(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r"||$this->session->userdata("access_level")<4) {
			$this->load->view("error_404");
			return;
		}
		$id=$this->uri->segment(3);
		if(md5($id."dletm3")==$this->uri->segment(4)){
			$success=$this->user_model->delete($id);
			if($success==1){
				$this->session->set_flashdata("message","User has been deleted.");
				redirect("user/#message");
			}
			else{
				$this->session->set_flashdata("message","Failed to delete. Please try again later");
				redirect("user/#message");
			}
		}
		else{
			redirect("user/");
		}
	}

	public function password_check($str)
	{
	   if (preg_match('#[0-9]#', $str) && preg_match('#[a-z]#', $str)&& preg_match('#[A-Z]#', $str)) {
	     return TRUE;
	   }
	   return FALSE;
	}
}