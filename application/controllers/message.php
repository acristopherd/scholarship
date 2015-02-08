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
    
	function view(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$id=$this->uri->segment(3);
		$data["messages"]=$this->message_model->get_by_id($id);
		$data["attachments"]=$this->message_attach_model->get_by_id($id);
		$data["update"]=$this->message_model->update($id,array("read"=>"1"));
        $this->load->view("admin/message/full_message_view.php",$data);
	}
	
	function view_some(){
		$messages=$this->message_model->get_some();
		$messages=array_reverse($messages);
		echo json_encode($messages);
	}
	
	function add(){
		
		$this->load->view("send");
	}
	
	function delete(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$id = $this->uri->segment(3);
		$files=$this->message_attach_model->get_by_id($id);
		$upload_path=realpath(APPPATH."../attachment");
		foreach($files as $file){
			unlink($upload_path."/".$file->loc);
			unlink($upload_path."/thumbs/".$file->loc);
		}
		
		$delete=$this->message_model->delete($id);
		$delete=$this->message_attach_model->delete($id);
		if($delete){
			$this->session->set_flashdata("message","Successfully deleted.");
			redirect("message#message");
		}
		else{
			$this->session->set_flashdata("message","Delete failed. Please try again later.");
			redirect("message#message");
		}
	}
	
	function delete_all(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		
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
			redirect("message#message");
		}
		else{
			$this->session->set_flashdata("message","Delete failed. Please try again later.");
			redirect("message#message");
		}
	}
	
	function save(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		$this->form_validation->set_rules("a_title","Title","trim|required|min_length[1]|max_length[80]|xss_clean");
		$this->form_validation->set_rules("a_msg","Message","trim|required|min_length[1]|max_length[5000]|xss_clean");
		if($this->form_validation->run()==FALSE){
			echo "validation failed";
			$this->load->view("send");
		}
		else{
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
				$data['error']= "Error uploading file.";
				echo "error uploading";
				$this->load->view("send",$data);
				return;
				//echo $this->upload->display_errors();//$this -> load -> view("literature_view.php",$data);
			}
			else {
				$data['save']=array("subject"=>$this->input->post("a_title"),
								"message"=>$this->input->post("a_msg"),
								"user_id"=>$this->session->userdata("grantee_id"),
								"date_posted"=>mdate("%Y-%m-%d %h:%i:%s"));
								//print_r($data['save']);
				$success=$this->message_model->add($data['save']);
				$this->load->model("message_attach_model");
				$this->load->helper("date");
				$uploadpath = realpath(APPPATH."../attachment");
				//create image thumbnail
				$config_t['image_library'] = 'gd2';                
                $config_t['maintain_ratio'] = TRUE;
                $config_t['width'] = 100;
                $config_t['height'] = 100;
                $this->load->library('image_lib'); 
                
				
				foreach($this->upload->get_multi_upload_data() as $file){
					$config_t['source_image'] = $uploadpath."/".$file["file_name"];
                	$config_t['new_image'] = $uploadpath."/thumbs/";
					$this->image_lib->initialize($config_t);
					if(!$this->image_lib->resize()){}
					$data["attach_insert"]=array("message_id"=>$success['id'],
													"loc"=>$file["file_name"]);
					$this->message_attach_model->insert($data["attach_insert"]);
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
	}
}