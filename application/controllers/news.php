<?php

class news extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("news_model");
		$this->load->model("news_pic_model");
	}
    function index(){
    	if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
    	$data['newss']=$this->news_model->get();
        $this->load->view("admin/news/news_view.php",$data);
    }
    
    function view(){
    	$this->load->library('pagination');
		$url = site_url("news/view");
		$url=str_replace(".html", "",$url);
		$config['base_url'] = $url;
		$config['total_rows'] = $this->news_model->count();		
		$config['per_page'] = 10; 
		$config['use_query_string']=true;		
		//$config['next_tag_open'] = '<span class="icon-next">';
		//$config['next_tag_close'] = '</span>';
		$this->pagination->initialize($config); 
		$start = $this->uri->segment(3)?$this->uri->segment(3):0;
		$data['links']= $this->pagination->create_links();
    	
    	$news=$this->news_model->get_page($config['per_page'],$start);
		$data['newss']=array();
		foreach($news as $new){
			$pics=$this->news_pic_model->get_by_id($new->id);
			$data['newss'][]=array("info"=>$new,"pics"=>$pics);			
		}
		$this->load->view("news_view.php",$data);
    }
    
	function full_view(){
		$id=$this->uri->segment(3);
		$news=$this->news_model->get_by_id($id);
		$data['news']=$news[0];
		$this->load->view('admin/news/full_news_view',$data);
	}
	
	function get_latest(){
		$limit=1;
    	if($this->input->post("data")){
    		$limit =$this->input->post("data");
    	}
		
    	$news=$this->news_model->get_latest($limit);
		//echo $limit;
		//print_r($news);
		$data['newss']=array();
		foreach($news as $new){
			$pics=$this->news_pic_model->get_by_id($new->id);
			$data['newss'][]=array("info"=>$new,"pics"=>$pics);			
		}
		echo json_encode($data['newss']);
    }
	function add(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$this->load->view("admin/news/add.php");
	}
	
	function delete(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$id = $this->uri->segment(3);
		$files=$this->news_pic_model->get_by_id($id);
		$upload_path=realpath(APPPATH."../news");
		foreach($files as $file){
			unlink($upload_path."/".$file->loc);
			unlink($upload_path."/thumbs/".$file->loc);
		}
		
		$delete=$this->news_model->delete($id);
		$delete=$this->news_pic_model->delete($id);
		if($delete){
			$this->session->set_flashdata("message","Successfully deleted.");
			redirect("news#message");
		}
		else{
			$this->session->set_flashdata("message","Delete failed. Please try again later.");
			redirect("news#message");
		}
	}
	function save(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		$this->form_validation->set_message('check_title','A news with this title already exists.');
		$this->form_validation->set_rules("a_title","Title","trim|required|min_length[1]|max_length[80]|callback_check_title|xss_clean");
		$this->form_validation->set_rules("a_date","Date","trim|xss_clean");
		$this->form_validation->set_rules("a_from","From","trim|required|min_length[1]|max_length[80]|xszs_clean");
		$this->form_validation->set_rules("a_msg","Message","trim|required|min_length[1]|max_length[5000]|xss_clean");
		if($this->form_validation->run()==FALSE){
			$this->load->view("admin/news/add.php");
		}
		else{
			$file_counter=0;
			foreach ($_FILES['pics']['name'] as $key => $value) {
				$filenames[]=md5($this->input->post("title")).time()."_".$file_counter++;
			}
			
			//echo sizeof($_FILES);
			$data['save']=array("title"=>$this->input->post("a_title"),
								"news"=>$this->input->post("a_msg"),
								"news_date"=>$this->input->post("a_date"),
								"author"=>$this->input->post("a_from"),
								"date_posted"=>mdate("%Y-%m-%d %h:%i:%s"));
								//print_r($data['save']);
			$success=$this->news_model->add($data['save']);
			$uploadpath = realpath(APPPATH."../news");
			$config['upload_path'] = $uploadpath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name']=$filenames;
			$config['overwrite']=TRUE;
			$config['max_size']	= '20960KB';		
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_multi_upload('pics'))
			{
				/*$data['error']= "Error uploading file.";
				$this->load->view("news/add",$data);
				return;
				 * 
				 */
				//echo $this->upload->display_errors();//$this -> load -> view("literature_view.php",$data);
			}
			else {
				
				$this->load->model("news_pic_model");
				$this->load->helper("date");
				$uploadpath = realpath(APPPATH."../news");
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
					$data["pic_insert"]=array("news_id"=>$success['id'],
													"loc"=>$file["file_name"]);
					$this->news_pic_model->insert($data["pic_insert"]);
				}
				
				
				
			}
			if($success['success']==1){
				$this->session->set_flashdata("message","Your news has been successfully saved.");
				redirect("news#message");
			}
			else{
				$this->session->set_flashdata("message","Your news was not saved. Please try again later.");
				redirect("news#message");
			}			
		}
	}

	function check_title(){
		$title = $this->input->post('a_title');
		$news=$this->news_model->get_by_title($title);
		if(sizeof($news)>0){
			return false;
		}
		else {
			return true;
		}
	}
}