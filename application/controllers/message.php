<?php

class message extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("message_model");
		$this->load->model("message_attach_model");
	}
    function index(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$data["messages"]=$this->message_model->get();
        $this->load->view("admin/message/message_view.php",$data);
    }
	
	function inbox(){
		//if(!$this->session->userdata('access_level')>4){//$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
		if($this->session->userdata('admin_id')||$this->session->userdata('super_admin_id')){
			$data["messages"]=$this->message_model->get_inbox(0);
			
	        $this->load->view("admin/message/message_view.php",$data);
		}
		else if($this->session->userdata('grantee_id')){
			$data["messages"]=$this->message_model->get_inbox($this->session->userdata('grantee_id'),array(2));
        	$this->load->view("grantee/message/message_view.php",$data);
		}
		else if($this->session->userdata('user_id')){
			$data["messages"]=$this->message_model->get_inbox($this->session->userdata('user_id'),array(4));
        	$this->load->view("message/message_view.php",$data);
		}
		else{
			$this->load->view("error_404");
			return;
		}
	}
	
	function sent(){
		if($this->session->userdata('admin_id')||$this->session->userdata('super_admin_id')){
			$data["messages"]=$this->message_model->get_sent(0);
	        $this->load->view("admin/message/sent_message_view.php",$data);
		}
		else if($this->session->userdata('grantee_id')){
			$data["messages"]=$this->message_model->get_sent($this->session->userdata('grantee_id'),array(1));
        	$this->load->view("grantee/message/sent_message_view.php",$data);
		}
		else if($this->session->userdata('user_id')){
			$data["messages"]=$this->message_model->get_sent($this->session->userdata('user_id'),array(3));
        	$this->load->view("message/sent_message_view.php",$data);
		}
		else{
			$this->load->view("error_404");
			return;
		}
	}
    
	function view(){		
		$id=$this->uri->segment(3);
		$data["messages"]=$this->message_model->get_by_id($id);
		$data["attachments"]=$this->message_attach_model->get_by_id($id);
		$data["update"]=$this->message_model->update($id,array("msg_read"=>"1"));
		if($this->session->userdata('admin_id')||$this->session->userdata('super_admin_id')){
			$this->load->view("admin/message/full_message_view.php",$data);
		}
		else if($this->session->userdata('grantee_id')){
			$this->load->view("grantee/message/full_message_view.php",$data);
		}
		else if($this->session->userdata('user_id')){
			$this->load->view("message/full_message_view.php",$data);
		}
		else{
			$this->load->view("error_404");
		}
	}
	function view_sent(){		
		$id=$this->uri->segment(3);
		$data["messages"]=$this->message_model->get_sent_by_id($id);
		$data["attachments"]=$this->message_attach_model->get_by_id($id);
		//$data["update"]=$this->message_model->update($id,array("msg_read"=>"1"));
		if($this->session->userdata('admin_id')||$this->session->userdata('super_admin_id')){
			$this->load->view("admin/message/full_sent_view.php",$data);
		}
		else if($this->session->userdata('grantee_id')){
			$this->load->view("grantee/message/full_sent_view.php",$data);
		}
		else if($this->session->userdata('user_id')){
			$this->load->view("message/full_sent_view.php",$data);
		}
		else{
			$this->load->view("error_404");
		}
	}
	
	function view_some(){
		$messages=$this->message_model->get_some();
		$messages=array_reverse($messages);
		echo json_encode($messages);
	}
	
	function sponsor_send(){
		//echo $this->session->userdata('access_level');
		if($this->session->userdata('access_level')!=1) {
			$this->load->view("error_404");
			return;
		}
		if(isset($_POST['a_title'])){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("a_title","Title","trim|required|min_length[1]|max_length[80]|xss_clean");
			$this->form_validation->set_rules("a_msg","Message","trim|required|min_length[1]|max_length[5000]|xss_clean");
			if($this->form_validation->run()==FALSE){
				//echo "validation failed";
				$this->load->view("grantee/message/sponsor_send");
			}
			else{
				
				if(count($_FILES)>0){
				$file_counter=0;
				foreach ($_FILES['attachment']['name'] as $key => $value) {
					$filenames[]=md5($this->input->post("title")).time()."_".$file_counter++;
				}
				
				$uploadpath = realpath(APPPATH."../attachment");
				$config['upload_path'] = $uploadpath;
				$config['allowed_types'] = 'pdf|docx|doc|xls|xlsx';
				$config['file_name']=$filenames;
				$config['overwrite']=TRUE;
				$config['max_size']	= '20960KB';		
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_multi_upload('attachment'))
				{
					$data['error']= "Error uploading attachment(s).";
					//echo "error uploading";
					$this->load->view("grantee/message/sponsor_send",$data);
					return;
					//echo $this->upload->display_errors();//$this -> load -> view("literature_view.php",$data);
				}
				}
			
				$data['save']=array("subject"=>$this->input->post("a_title"),
								"message"=>$this->input->post("a_msg"),
								"date_posted"=>mdate("%Y-%m-%d %h:%i:%s"),
								"msg_from"=>$this->session->userdata("grantee_id"),
								"from_name"=>$this->session->userdata("fname")." ".$this->session->userdata("lname"),
								"from_desc"=>"Scholarship Sponsor",
								"msg_to"=>"0",
								"msg_type"=>"1");
								//print_r($data['save']);
				$success=$this->message_model->add($data['save']);
				if(count($_FILES)>0){
					foreach($this->upload->get_multi_upload_data() as $file){						
						$data["attach_insert"]=array("message_id"=>$success['id'],
														"loc"=>$file["file_name"]);
						$this->message_attach_model->insert($data["attach_insert"]);
					}
				}
				
				if($success['success']==1){
					$this->session->set_flashdata("message","Your message has been successfully saved.");
					redirect("osa#message");
				}
				else{
					$this->session->set_flashdata("message","Your message was not saved. Please try again later.");
					redirect("osa#message");
				}
				
						
			}	
		}
		else{
			$this->load->view("grantee/message/sponsor_send");
		}
	}

	function scholar_send(){
		//echo $this->session->userdata('access_level');
		if(!$this->session->userdata('user_id')) {
			$this->load->view("error_404");
			return;
		}
		if(isset($_POST['a_title'])){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("a_to","To","trim|required|min_length[1]|max_length[80]|xss_clean");
			$this->form_validation->set_rules("a_title","Title","trim|required|min_length[1]|max_length[80]|xss_clean");
			$this->form_validation->set_rules("a_msg","Message","trim|required|min_length[1]|max_length[5000]|xss_clean");
			if($this->form_validation->run()==FALSE){
				//echo "validation failed";
				$data['to']=array("3"=>"Admin");
				$this->load->model('scholarship_model');
				$scholarship = $this->scholarship_model->get_latest_by_id($this->session->userdata('user_id'));
				$this->load->model('user_model');
				//echo $scholarship[0]->scholar_type;
				$ids = $this->user_model->get_grantee($scholarship[0]->scholar_type);
				if(sizeof($ids)>0){
					$data['to']['8']="Sponsor";
				}
				$this->load->view("message/send",$data);
			}
			else{
				$tos=array();
				//$type=0;
				if($this->input->post('a_to')==3){
					$tos[]=0;
				}
				else if($this->input->post('a_to')==8){
					$this->load->model('scholarship_model');
					$scholarship = $this->scholarship_model->get_latest_by_id($this->session->userdata('user_id'));
					$this->load->model('user_model');
					//echo $scholarship[0]->scholar_type;
					$ids = $this->user_model->get_grantee($scholarship[0]->scholar_type);
					foreach($ids as $id){
						$tos[]=$id->id;
					}
				}
				$save=array();
				//print_r($tos);
				foreach($tos as $to ){
					$save[]=array("subject"=>$this->input->post("a_title"),
								"message"=>$this->input->post("a_msg"),
								"date_posted"=>mdate("%Y-%m-%d %h:%i:%s"),
								"msg_from"=>$this->session->userdata("user_id"),
								"from_name"=>$this->session->userdata("fname")." ".$this->session->userdata("lname"),
								"from_desc"=>"Scholar",
								"msg_to"=>$to,
								"msg_type"=>$this->input->post("a_to"));
				}
				
				//print_r($data['save']);
				$success=$this->message_model->add_batch($save);
				
				if($success['success']==1){
					$this->session->set_flashdata("message","Your message has been successfully saved.");
					redirect("osa#message");
				}
				else{
					$this->session->set_flashdata("message","Your message was not saved. Please try again later.");
					redirect("osa#message");
				}
				
						
			}	
		}
		else{
			$data['to']=array("3"=>"Admin");
			$this->load->model('scholarship_model');
			$scholarship = $this->scholarship_model->get_latest_by_id($this->session->userdata('user_id'));
			$this->load->model('user_model');
			//echo $scholarship[0]->scholar_type;
			$ids = $this->user_model->get_grantee($scholarship[0]->scholar_type);
			if(sizeof($ids)>0){
				$data['to']['8']="Sponsor";
			}
			$this->load->view("message/send",$data);
		}
	}

	function admin_send(){
		//echo $this->session->userdata('access_level');
		if($this->session->userdata('access_level')<4) {
			$this->load->view("error_404");
			return;
		}
		if(isset($_POST['a_title'])){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("a_to","To","trim|required|min_length[1]|max_length[80]|xss_clean");
			$this->form_validation->set_rules("a_title","Title","trim|required|min_length[1]|max_length[80]|xss_clean");
			$this->form_validation->set_rules("a_msg","Message","trim|required|min_length[1]|max_length[5000]|xss_clean");
			if($this->form_validation->run()==FALSE){
				//echo "validation failed";
				$this->load->view("admin/message/send");
			}
			else{
				
				$tos=array();
				//$type=0;
				if($this->input->post('a_to')==2){
					$this->load->model('user_model');
					$ids = $this->user_model->get_by_level(1);
					foreach($ids as $id){
						$tos[]=$id->id;
					}
				}
				else if($this->input->post('a_to')==4){
					$this->load->model('scholar_model');
					$ids = $this->scholar_model->get_confirmed();
					foreach($ids as $id){
						$tos[]=$id->id;
					}
				}
				$save=array();
				foreach($tos as $to ){
					$save[]=array("subject"=>$this->input->post("a_title"),
								"message"=>$this->input->post("a_msg"),
								"date_posted"=>mdate("%Y-%m-%d %h:%i:%s"),
								"msg_from"=>$this->session->userdata("grantee_id"),
								"from_name"=>"OSA",
								"from_desc"=>"Admin",
								"msg_to"=>$to,
								"msg_type"=>$this->input->post("a_to"));
				}
				
				//print_r($data['save']);
				$success=$this->message_model->add_batch($save);
				
				if($success['success']==1){
					$this->session->set_flashdata("message","Your message has been successfully saved.");
					redirect("message/sent#message");
				}
				else{
					$this->session->set_flashdata("message","Your message was not saved. Please try again later.");
					redirect("message/admin_send#message");
				}
				
						
			}	
		}
		else{
			$this->load->view("admin/message/send");
		}
	}
	
	function delete_sent(){
		$id = $this->uri->segment(3);
		
		$delete=$this->message_model->delete_sent($id);
		if($delete){
			$this->session->set_flashdata("message","Successfully deleted.");
			redirect("message/sent#message");
		}
		else{
			$this->session->set_flashdata("message","Delete failed. Please try again later.");
			redirect("message/sent#message");
		}
	}
	
	function delete(){
		
		$id = $this->uri->segment(3);
		$files=$this->message_attach_model->get_by_id($id);
		$upload_path=realpath(APPPATH."../attachment");
		foreach($files as $file){
			unlink($upload_path."/".$file->loc);
			
		}
		
		$delete=$this->message_model->delete($id);
		$delete=$this->message_attach_model->delete($id);
		if($delete){
			$this->session->set_flashdata("message","Successfully deleted.");
			redirect("message/inbox#message");
		}
		else{
			$this->session->set_flashdata("message","Delete failed. Please try again later.");
			redirect("message/inbox#message");
		}
	}
	
	function delete_all_sent(){
		
		foreach($this->input->post("selected") as $id){
			
			$delete=$this->message_model->delete_sent($id);
			
		}
		if($delete){
			$this->session->set_flashdata("message","Successfully deleted.");
			if($this->session->userdata('grantee_id'))
			redirect("message/sent#message");
		}
		else{
			$this->session->set_flashdata("message","Delete failed. Please try again later.");
			redirect("message/sent#message");
		}
	}

	function delete_all(){
		
		$upload_path=realpath(APPPATH."../attachment");
		foreach($this->input->post("selected") as $id){
			$files=$this->message_attach_model->get_by_id($id);
			
			foreach($files as $file){
				unlink($upload_path."/".$file->loc);
				unlink($upload_path."/thumbs/".$file->loc);
			}
			
			$delete=$this->message_model->delete($id);
			$delete_attach=$this->message_attach_model->delete($id);
		}
		if($delete&&$delete_attach){
			$this->session->set_flashdata("message","Successfully deleted.");
			redirect("message/inbox#message");
		}
		else{
			$this->session->set_flashdata("message","Delete failed. Please try again later.");
			redirect("message/inbox#message");
		}
	}
		
	function save(){
		
	}
}