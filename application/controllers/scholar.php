<?php
class scholar extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model("scholar_model");
		$this->load->model("scholarship_model");
	}
	
	function index(){
		redirect("osa");
	}
	function logout(){
		$this->session->unset_userdata(array("user_id"=>"",
												"fname"=>"",
												"mname"=>"",
												"lname"=>"",
												"email"=>""));
		$this->session->set_flashdata("message","You have successfully logout.");
		redirect("osa");
	}
	
	function login(){
		if($this->input->post("email")){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("email","Email","trim|required|min_length[5]|max_length[100]|xss_clean|email");
			$this->form_validation->set_rules("password","Password","trim|required|min_length[5]|max_length[100]|xss_clean");
			if($this->form_validation->run()==FALSE){
				$this->load->view("login_view");
			}
			else{
				$hpass = hash("SHA256",$this->input->post("password")."x4*b9");
				$data['login']=$this->scholar_model->get_login($this->input->post("email"),$hpass);	
				if(sizeof($data['login'])>0 && $data['login'][0]->pass==$hpass){
					//print_r($data['login']);
					$this->session->set_userdata(array("user_id"=>$data['login'][0]->id,
												"fname"=>$data['login'][0]->fname,
												"mname"=>$data['login'][0]->mname,
												"lname"=>$data['login'][0]->lname,
												"email"=>$data['login'][0]->email,
												"confirmed"=>$data['login'][0]->confirmed));
					$this->session->set_flashdata("message","Your account is not yet verified. Please verify your account via email.");
					if($this->session->userdata("confirmed")==0){
						redirect("scholar/send_verify");
					}
					else{
						if($this->session->userdata("last_page")){
							redirect($this->session->userdata("last_page"));
						}
						else{
							redirect("osa");
						}						
					}
				}	
						
				else{
					
					$this->session->set_flashdata("login_failed","Username and password mismatched.");
					redirect("scholar/login");
				}
			}
		}
		else{
			$this->load->view("login_view");
		}
	}
	
	function signup(){
		$data['post']=array();
		$this->load->view("scholar_signup.php",$data);
	}
	
	function add(){
		$this->form_validation->set_message("password_check","Your password should contain atleast 1 Uppercase, 1 Lowercase and 1 Number.");
		$this->form_validation->set_message("captcha_check","Wrong CAPTCHA");
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		$this->form_validation->set_rules("firstname","First Name","trim|required|min_length[2]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("middlename","Middle Name","trim|min_length[0]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("lastname","Last Name","trim|required|min_length[2]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("bdate","Birthdate","trim|required|min_length[2]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("sex","Sex","trim|required|min_length[2]|max_length[6]|xss_clean");
		$this->form_validation->set_rules("status","Civil Status","trim|required|min_length[2]|max_length[15]|xss_clean");
		$this->form_validation->set_rules("contact","Contact No","trim|required|min_length[2]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("brgy","Barangay","trim|required|min_length[2]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("town","Town/City","trim|required|min_length[2]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("prov","Province","trim|required|min_length[2]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("father","Father's Name","trim|required|min_length[1]|max_length[100]|xss_clean");		
		$this->form_validation->set_rules("father_occu","Father's Occupation","trim|required|min_length[1]|max_length[100]|xss_clean");		
		$this->form_validation->set_rules("father_educ","Father's Highest Educational Assignment","trim|required|min_length[5]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("mother","Mother's Name","trim|required|min_length[1]|max_length[100]|xss_clean");		
		$this->form_validation->set_rules("mother_occu","Mother's Occupation","trim|required|min_length[1]|max_length[100]|xss_clean");		
		$this->form_validation->set_rules("mother_educ","Mother's Highest Educational Assignment","trim|required|min_length[1]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("income","Combined Monthly Income","trim|required|greater_than[0]|xss_clean");
		$this->form_validation->set_rules("no_of_children","No of Children","trim|required|greater_than[0]|less_than[13]|xss_clean");
		$this->form_validation->set_rules("school_grad","School Graduated","trim|required|min_length[1]|max_length[100]|xss_clean");
		$this->form_validation->set_rules("school_addr","Address of School","trim|required|min_length[1]|max_length[100]|xss_clean");	
		$this->form_validation->set_rules("email","Email","trim|required|min_length[5]|max_length[100]|xss_clean|valid_email");
		$this->form_validation->set_rules("pass","Password","trim|required|min_length[8]|max_length[100]|xss_clean|callback_password_check");
		$this->form_validation->set_rules("cpass","Password","trim|required|matches[pass]");
		//$this->form_validation->set_rules("captcha","CAPTCHA","trim|required|callback_captcha_check");
						
		if($this->form_validation->run()==FALSE){
			$data['post']=$_POST;
			$this->load->view("scholar_signup.php",$data);
		}
		else{
			
			$hpass = hash("SHA256",$this->input->post("pass")."x4*b9");
		    $data=array("stud_No"=>"",
					"fname"=>ucwords($this->input->post("firstname")),
					"mname"=>ucwords($this->input->post("middlename")),
					"lname"=>ucwords($this->input->post("lastname")),
					"birthdate"=>$this->input->post("bdate"),
					"gender"=>$this->input->post("sex"),
					"civil_status"=>$this->input->post("status"),
					"contact_no"=>$this->input->post("contact"),
					"brgy"=>ucwords($this->input->post("brgy")),
					"town"=>ucwords($this->input->post("town")),
					"prov"=>ucwords($this->input->post("prov")),
					"fa_name"=>ucwords($this->input->post("father")),
					"fa_occup"=>ucwords($this->input->post("father_occu")),
					"fa_educ"=>ucwords($this->input->post("father_educ")),
					"mo_name"=>ucwords($this->input->post("mother")),
					"mo_occup"=>ucwords($this->input->post("mother_occu")),
					"mo_educ"=>ucwords($this->input->post("mother_educ")),
					"com_mon_inc"=>$this->input->post("income"),
					"no_of_chil"=>$this->input->post("no_of_children"),
					"school_grad"=>ucwords($this->input->post("school_grad")),
					"addr_school"=>ucwords($this->input->post("school_addr")),
					"email"=>$this->input->post("email"),
					"pass"=>$hpass);
			$ci = new CI_Controller();
			$ci->load->model("scholar_model");
			$data["message"]=$ci->scholar_model->insert($data);
			$this->session->set_userdata(array("user_id"=>$data['message']['id'],
												"fname"=>$this->input->post("firstname"),
												"mname"=>$this->input->post("middlename"),
												"lname"=>$this->input->post("lastname"),
												"email"=>$this->input->post("email")));
			redirect("scholar/send_verify"); 					
				
		}
	}
	
	function edit_personal(){
		$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
		if($this->input->post("firstname")){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("firstname","First Name","trim|required|min_length[2]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("middlename","Middle Name","trim|min_length[0]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("lastname","Last Name","trim|required|min_length[2]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("bdate","Birthdate","trim|required|min_length[2]|max_length[20]|xss_clean");
			$this->form_validation->set_rules("sex","Sex","trim|required|min_length[2]|max_length[6]|xss_clean");
			$this->form_validation->set_rules("status","Civil Status","trim|required|min_length[2]|max_length[15]|xss_clean");
			$this->form_validation->set_rules("contact","Contact No","trim|required|min_length[2]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("brgy","Barangay","trim|required|min_length[2]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("town","Town/City","trim|required|min_length[2]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("prov","Province","trim|required|min_length[2]|max_length[100]|xss_clean");
			$hpass = hash("SHA256",$this->input->post("pass")."x4*b9");
			if($hpass!=$data['scholar'][0]->pass){
				$data['error']="You have entered an incorrect password. Changes are not saved.";
				$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
				$this->load->view("scholar/edit_personal",$data);
				return;	
			}
			if($this->form_validation->run()==FALSE){			
				$this->load->view("scholar/edit_personal");
			}			
			else{
				$update=array("stud_No"=>"",
					"fname"=>ucwords($this->input->post("firstname")),
					"mname"=>ucwords($this->input->post("middlename")),
					"lname"=>ucwords($this->input->post("lastname")),
					"birthdate"=>$this->input->post("bdate"),
					"gender"=>$this->input->post("sex"),
					"civil_status"=>$this->input->post("status"),
					"contact_no"=>$this->input->post("contact"),
					"brgy"=>ucwords($this->input->post("brgy")),
					"town"=>ucwords($this->input->post("town")),
					"prov"=>ucwords($this->input->post("prov")));
				$success=$this->scholar_model->update($this->session->userdata("user_id"),$update);
				if($success){
					$this->session->set_flashdata("message","Your new information has been saved.");
					redirect("osa#message");
				}
				else{
					$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
					echo "failed to save.";
					$this->load->view("scholar/edit_personal",$data);
				}

			}
		}
		else{
			
			$this->load->view("scholar/edit_personal",$data);
		}
		
	}

	function edit_family(){
		$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
		if($this->input->post("father")){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("father","Father's Name","trim|required|min_length[1]|max_length[100]|xss_clean");		
			$this->form_validation->set_rules("father_occu","Father's Occupation","trim|required|min_length[1]|max_length[100]|xss_clean");		
			$this->form_validation->set_rules("father_educ","Father's Highest Educational Assignment","trim|required|min_length[5]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("mother","Mother's Name","trim|required|min_length[1]|max_length[100]|xss_clean");		
			$this->form_validation->set_rules("mother_occu","Mother's Occupation","trim|required|min_length[1]|max_length[100]|xss_clean");		
			$this->form_validation->set_rules("mother_educ","Mother's Highest Educational Assignment","trim|required|min_length[1]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("income","Combined Monthly Income","trim|required|greater_than[0]|xss_clean");
			$this->form_validation->set_rules("no_of_children","No of Children","trim|required|greater_than[0]|less_than[13]|xss_clean");
		
			$hpass = hash("SHA256",$this->input->post("pass")."x4*b9");
			if($hpass!=$data['scholar'][0]->pass){
				$data['error']="You have entered an incorrect password. Changes are not saved.";
				$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
				$this->load->view("scholar/edit_family",$data);
				return;	
			}
			if($this->form_validation->run()==FALSE){			
				$this->load->view("scholar/edit_family");
			}			
			else{
				$update=array("fa_name"=>ucwords($this->input->post("father")),
					"fa_occup"=>ucwords($this->input->post("father_occu")),
					"fa_educ"=>ucwords($this->input->post("father_educ")),
					"mo_name"=>ucwords($this->input->post("mother")),
					"mo_occup"=>ucwords($this->input->post("mother_occu")),
					"mo_educ"=>ucwords($this->input->post("mother_educ")),
					"com_mon_inc"=>$this->input->post("income"),
					"no_of_chil"=>$this->input->post("no_of_children"));
				$success=$this->scholar_model->update($this->session->userdata("user_id"),$update);
				if($success){
					$this->session->set_flashdata("message","Your new information has been saved.");
					redirect("osa#message");
				}
				else{
					$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
					echo "failed to save.";
					$this->load->view("scholar/edit_family",$data);
				}

			}
		}
		else{
			
			$this->load->view("scholar/edit_family",$data);
		}
		
	}

	function edit_educ(){
		$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
		if($this->input->post("school_addr")){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("school_grad","School Graduated","trim|required|min_length[1]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("school_addr","Address of School","trim|required|min_length[1]|max_length[100]|xss_clean");
			$hpass = hash("SHA256",$this->input->post("pass")."x4*b9");
			if($hpass!=$data['scholar'][0]->pass){
				$data['error']="You have entered an incorrect password. Changes are not saved.";
				$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
				$this->load->view("scholar/edit_educ",$data);
				return;	
			}
			if($this->form_validation->run()==FALSE){			
				$this->load->view("scholar/edit_educ");
			}			
			else{
				$update=array("school_grad"=>ucwords($this->input->post("school_grad")),
					"addr_school"=>ucwords($this->input->post("school_addr")));
				$success=$this->scholar_model->update($this->session->userdata("user_id"),$update);
				if($success){
					$this->session->set_flashdata("message","Your new information has been saved.");
					redirect("osa#message");
				}
				else{
					$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
					echo "failed to save.";
					$this->load->view("scholar/edit_educ",$data);
				}

			}
		}
		else{
			
			$this->load->view("scholar/edit_educ",$data);
		}
		
	}
	
	function edit_account(){
		$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
		if($this->input->post("new_pass")){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("email","Email","trim|required|min_length[5]|max_length[100]|xss_clean|valid_email");
			$this->form_validation->set_rules("new_pass","Password","trim|required|min_length[8]|max_length[100]|xss_clean|callback_password_check");
			$this->form_validation->set_rules("cnew_pass","Password","trim|required|matches[pass]");
			$hpass = hash("SHA256",$this->input->post("pass")."x4*b9");
			if($hpass!=$data['scholar'][0]->pass){
				$data['error']="You have entered an incorrect password. Changes are not saved.";
				$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
				$this->load->view("scholar/edit_account",$data);
				return;	
			}
			if($this->form_validation->run()==FALSE){			
				$this->load->view("scholar/edit_account");
			}			
			else{
				$new_hpass = hash("SHA256",$this->input->post("new_pass")."x4*b9");
				$update=array("email"=>$this->input->post("email"),
					"pass"=>$new_hpass);
				$success=$this->scholar_model->update($this->session->userdata("user_id"),$update);
				if($success){
					$this->session->set_flashdata("message","Your new information has been saved.");
					redirect("osa#message");
				}
				else{
					$data['scholar']=$this->scholar_model->get_by_id($this->session->userdata("user_id"));
					echo "failed to save.";
					$this->load->view("scholar/edit_account",$data);
				}

			}
		}
		else{
			
			$this->load->view("scholar/edit_account",$data);
		}
		
	}
	
	public function password_check($str)
	{
	   if (preg_match('#[0-9]#', $str) && preg_match('#[a-z]#', $str)&& preg_match('#[A-Z]#', $str)) {
	     return TRUE;
	   }
	   return FALSE;
	}
	
	public function captcha_check(){
		$ci = new CI_Controller();
		$ci->load->model("captcha_model");
		if($ci->captcha_model->check_captcha($this->input->post("captcha"),$this->input->ip_address())>0)
			return TRUE;
		else
			return FALSE;
	}
	
	function apply(){
		$this->session->set_userdata("last_page",$this->uri->uri_string());
		if(!$this->session->userdata("user_id")){
			$this->session->set_flashdata("message","You need to login first or ".anchor("scholar/signup","signup")." for a scholar account before you can access the page.");
			redirect("scholar/login#dialog");
		}
		else if($this->session->userdata("confirmed")>0){
			$this->session->set_flashdata("message","Verify your account first before applying for scholarship.");
			redirect("scholar/send_verify#message");
		}
		$this->load->model("scholartype_model");
		$types=$this->scholartype_model->get();
		$data['type']=array();
		$data['type'][-1]="-Select-";
		foreach($types as $type){
			$data['type'][$type->id]=$type->type;
		}
		$this->load->model("college_model");
		$colleges=$this->college_model->get();
		$data['colleges']=array();
		$data['colleges'][-1]="-Select-";
		foreach($colleges as $college){
			$data['colleges'][$college->id]=$college->college;
		}
		$this->load->model("course_model");
		$courses=$this->course_model->get();
		$data['courses']=array();
		$data['courses'][-1]="-Select-";
		foreach($courses as $course){
			$data['courses'][$course->id]=$course->course;
		}
		
		if(isset($_POST['scholar_type'])){
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
			$this->form_validation->set_rules("scholar_type","Scholarship Type","trim|required|greater_than[-1]|xss_clean");
			$this->form_validation->set_rules("sem","Semester","trim|required|min_length[0]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("sy","School Year","trim|required|min_length[2]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("no_of_units","Units","trim|required|greater_than[0]|xss_clean");
			$this->form_validation->set_rules("no_of_subj","Subjects","trim|required|greater_than[0]|xszs_clean");
			$this->form_validation->set_rules("yr_lvl","Year Level","trim|required|greater_than[-1]|xss_clean");
			$this->form_validation->set_rules("college","College","trim|required|greater_than[-1]|xss_clean");
			$this->form_validation->set_rules("course","Course","trim|required|greater_than[-1]|xss_clean");
			$this->form_validation->set_rules("no_of_units","Units","trim|required|greater_than[1]|xss_clean");
			if($this->form_validation->run()==FALSE){
				//echo $_POST['scholar_type'];
				if(isset($_POST['scholar_type'])){
					$this->load->model("type_requirement_model");
					$requirements=$this->type_requirement_model->get($_POST['scholar_type']);
					$data['requirements']=array();
					foreach($requirements as $requirement){
						$data['requirements'][$requirement->id]=$requirement->requ_name;
					}
				}
				$this->load->view("scholar_apply",$data);
			}
			else{
				$old_record = $this->scholarship_model->check($this->session->userdata("user_id"),$this->input->post("sem"),$this->input->post("sy"));
				if(sizeof($old_record)>0){
					$this->session->set_flashdata("message","You have already applied for scholarship.");
					redirect("scholar/my_scholarship#message");
				}
				$file_counter=1;
				$filenames=array();
				//upload of files
				$uploadpath = realpath(APPPATH."../requirements");
				$config['upload_path'] = $uploadpath;
				$config['allowed_types'] = 'pdf|gif|jpg|png';
				
				$config['overwrite']=TRUE;
				$config['max_size']	= '20960KB';		
				$this->load->library('upload');
				$filenames=array();
				foreach($_FILES as $key=>$file){
					if($file['error']>0) continue;					
					$config['file_name']=$this->session->userdata("lname")."_".md5($this->session->userdata("user_id").$this->session->userdata("lname").$file_counter).time()."_".$file_counter++;
					$this->upload->initialize($config);					
					if ( ! $this->upload->do_upload($key))
					{
						$data['error']= "Error uploading file.";
						$this->load->view("scholar_apply",$data);
						return;						
					}
					$upload_data=$this->upload->data();
					$ids=explode("_",$key);
					
					$filenames[]=array("filename"=>$upload_data['file_name'],"req_id"=>$ids[1]);					
				}
				
				$data["insert"]=array("sid"=>$this->session->userdata("user_id"),
											"scholar_type"=>$this->input->post("scholar_type"),
											"semester"=>$this->input->post("sem"),
											"sy"=>$this->input->post("sy"),
											"no_of_units"=>$this->input->post("no_of_units"),
											"no_of_subjects"=>$this->input->post("no_of_subj"),
											"yr_level"=>$this->input->post("yr_lvl"),
											"coll_id"=>$this->input->post("college"),
											"cour_id"=>$this->input->post("course"));
				$success=$this->scholarship_model->insert($data["insert"]);
				$this->load->model("requirement_model");
				$this->load->helper("date");
				if($success['success']==1){
				$uploadpath = realpath(APPPATH."../requirements");
				//create image thumbnail
				$config_t['image_library'] = 'gd2';                
                $config_t['maintain_ratio'] = TRUE;
                $config_t['width'] = 100;
                $config_t['height'] = 100;
                $this->load->library('image_lib'); 
				foreach($filenames as $file){
					$config_t['source_image'] = $uploadpath."/".$file["filename"];
                	$config_t['new_image'] = $uploadpath."/thumbs/";
					$this->image_lib->initialize($config_t);
					if(!$this->image_lib->resize()){}
					$data["requirement_insert"]=array("scholarship_id"=>$success['id'],
													"file_name"=>$file["filename"],
													"upload_date"=>mdate("%Y-%m-%d"),
													"scholar_type"=>$file["req_id"]);
					$this->requirement_model->insert($data["requirement_insert"]);
				}
				
				}
				$this->session->set_flashdata("message","You have successfully applied for scholarship.");
								
				redirect("scholar/my_scholarship#message");
				/*
				foreach ($_FILES['requirements']['name'] as $key => $value) {
					$filenames[]=md5($this->session->userdata("user_id").$this->session->userdata("lname").$file_counter).time()."_".$file_counter++;
				}
				print_r($filenames);
				$uploadpath = realpath(APPPATH."../requirements");
				$config['upload_path'] = $uploadpath;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name']=$filenames;
				$config['overwrite']=TRUE;
				$config['max_size']	= '20960KB';		
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_multi_upload('requirements'))
				{
					$data['error']= "Error uploading file.";
					$this->load->view("scholar_apply",$data);
					//echo $this->upload->display_errors();//$this -> load -> view("literature_view.php",$data);
				}
				else {
					
					$data["insert"]=array("sid"=>$this->session->userdata("user_id"),
											"scholar_type"=>$this->input->post("scholar_type"),
											"semester"=>$this->input->post("sem"),
											"sy"=>$this->input->post("sy"),
											"no_of_units"=>$this->input->post("no_of_units"),
											"no_of_subjects"=>$this->input->post("no_of_subj"),
											"yr_level"=>$this->input->post("yr_lvl"),
											"coll_id"=>$this->input->post("college"),
											"cour_id"=>$this->input->post("course"));
					$this->load->model("scholarship_model");
					$success=$this->scholarship_model->insert($data["insert"]);
					$this->load->model("requirement_model");
					$this->load->helper("date");
					foreach($this->upload->get_multi_upload_data() as $file){
						$data["requirement_insert"]=array("scholarship_id"=>$success['id'],
														"file_name"=>$file["file_name"],
														"upload_date"=>mdate("%Y-%m-%d"),
														"scholar_type"=>$this->input->post("scholar_type"));
						$this->requirement_model->insert($data["requirement_insert"]);
					}
					
					
					$this->session->set_flashdata("msg","You have successfully applied for scholarship.");
					//redirect("scholar/my_scholarship");
					 
				 
				  
					
				}
				 
				 */
				  
				 
			}
		}
		else{
			$this->load->view("scholar_apply",$data);			
		}
		
	}
	
	function late_requirement(){
		if(isset($_POST['scholarhship_id'])){
				$this->form_validation->set_rules("scholarship_id","Field","trim|required|greater_than[-1]|xss_clean");
			
				$uploadpath = realpath(APPPATH."../requirements");
				$config['upload_path'] = $uploadpath;
				$config['allowed_types'] = 'pdf|gif|jpg|png';				
				$config['overwrite']=TRUE;
				$config['max_size']	= '20960KB';		
				$this->load->library('upload');
				$config['file_name']=$this->session->userdata("lname")."_".md5($this->session->userdata("user_id").$this->session->userdata("lname").'1').time()."_".'1';
				$this->upload->initialize($config);					
				if ( ! $this->upload->do_upload('requirement'))
				{
					$data['error']= "Error uploading file.";
					$this->load->view("scholar_apply",$data);
					return;						
				}
				else{
					
				$upload_data=$this->upload->data();
				
				$this->load->model("requirement_model");
				$this->load->helper("date");
			
				$uploadpath = realpath(APPPATH."../requirements");
				//create image thumbnail
				$config_t['image_library'] = 'gd2';                
                $config_t['maintain_ratio'] = TRUE;
                $config_t['width'] = 100;
                $config_t['height'] = 100;
                $this->load->library('image_lib'); 
				
				$config_t['source_image'] = $uploadpath."/".$upload_data["file_name"];
            	$config_t['new_image'] = $uploadpath."/thumbs/";
				$this->image_lib->initialize($config_t);
				if(!$this->image_lib->resize()){}
				$data["requirement_insert"]=array("scholarship_id"=>$this->input->post('scholarhship_id'),
												"file_name"=>$upload_data["file_name"],
												"upload_date"=>mdate("%Y-%m-%d"),
												"scholar_type"=>$this->input->post("req_id"));
				//print_r($data['requirement_insert']);
				$this->requirement_model->insert($data["requirement_insert"]);
				$this->session->set_flashdata("message","You have successfully submitted you 1 requirement.");
								
				redirect("scholar/my_scholarship#message");
				}
				
		}
		else{
			$this->session->set_flashdata("message","No data submitted.");
			//echo "no data";
			redirect('scholar/my_scholarship');
		}
	}
	function get_requirements(){		
		$this->load->model("type_requirement_model");
		$requirements=$this->type_requirement_model->get($this->input->post("type"));
		$data['requirements']=array();
		foreach($requirements as $requirement){
			$data['requirements'][$requirement->id]=$requirement->requ_name;
		}
		$json=json_encode($data['requirements']);
		echo $json;
	}
	
	function get_latest_by_college(){
		$scholars = $this->scholarship_model->get_latest_by_college();
		echo json_encode($scholars);
	}
	
	function get_latest_by_type(){
		$scholars = $this->scholarship_model->get_latest_by_type();
		echo json_encode($scholars);
	}
	
	function get_existing_scholarship(){
		$sy = $this->input->post("sy");//"2015-2016";//
		$sem = $this->input->post("sem");//1;//
		$sid = $this->session->userdata("user_id");
		$count["count"] = $this->scholarship_model->get_existing_scholarship($sy,$sem,$sid);
		$count["sem"]=$sem;
		$count['sy']=$sy;
		echo json_encode($count);
	}
	
	function get_existing_scholar(){
		$fname = $this->input->post("firstname");//"2015-2016";//
		$mname = $this->input->post("middlename");//1;//
		$lname = $this->input->post("lastname");
		
		$count["count"] = $this->scholar_model->get_existing_scholar($fname,$mname,$lname);
		echo json_encode($count);
	}
	function get_existing_email(){
		$email = $this->input->post("email");//"2015-2016";//
		$count["count"] = $this->scholar_model->get_existing_email($email);
		echo json_encode($count);
	}

	function session_set(){
		$this->session->set_userdata(array("user_id"=>1,
												"fname"=>"Allan Cristopher",
												"mname"=>"Navarro",
												"lname"=>"Donato",
												"email"=>"andonato@unp.edu.ph"));
			
	}
	
	function session_get(){
		echo $this->session->userdata("user_id");
	}
	function my_scholarship(){
		if(!$this->session->userdata("user_id")){
			redirect("osa");
		}
		$data["scholarships"]=$this->scholarship_model->get_by_id($this->session->userdata("user_id"));
		$this->load->model("requirement_model");
		foreach($data['scholarships'] as $key=>$scholarship){
			$data["requirements"][$scholarship->aid][]=$this->scholarship_model->get_requirements($scholarship->aid);
		}
		
		$this->load->view("my_scholarship_view",$data);
	}
	function send_verify(){
		if($this->input->post("email")){
			$message=$this->send_mail($this->input->post("email"), $this->session->userdata("fname"),  $this->session->userdata("mname"),  $this->session->userdata("lname"),  $this->session->userdata("user_id"));
			$data['email_sent']=$message.". The verification email has been sent. Please check your inbox to verify your account.";
			$this->load->view("verify_account_view",$data);
		}
		else{
			$this->load->view("verify_account_view");
		}
		
	}
	
	function verify(){
		$id= $this->uri->segment(4);
		$email=$this->uri->segment(3);
		$scholar=$this->scholar_model->get_by_id($id);
		
		if(md5($scholar[0]->email."5x*y3")==$email){
			$this->scholar_model->confirm($id,array("confirmed"=>1));
			$this->session->set_flashdata("message","Your account is now verified. You can now apply for scholarship.");
			redirect("osa#message");
		}
		else{
			$this->session->set_flashdata("message","Your request cannot be proccessed this time. Please try again later.");
			redirect("osa#message");
		}
		 
	}
	
	function view_scholar(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$where  = array();
		$data['selected'] = array("college"=>$this->input->get("college"),
							"course"=>$this->input->get("course"),
							"town"=>$this->input->get("town"),
							"sex"=>$this->input->get("sex"),
							"sy"=>$this->input->get("sy"),
							"sem"=>$this->input->get("sem"),
							"type"=>$this->input->get("type"),
							"approved"=>$this->input->get("approved"));
		if($this->input->get("approved")>-1){
			$where['approved'] = $this->input->get("approved");
		}
		if($this->input->get("type")>-1){
			$where['scholar_type'] = $this->input->get("type");
		}
		if($this->input->get("sy")>-1){
			$where['sy'] = $this->input->get("sy");
		}
		if($this->input->get("sem")>-1){
			$where['semester'] = $this->input->get("sem");
		}
		if($this->input->get("college")>-1){
			$where['coll_id'] = $this->input->get("college");
		}
		if($this->input->get("course")>-1){
			$where['cour_id'] = $this->input->get("course");
		}
		if($this->input->get("town")>-1){
			$where['town'] = $this->input->get("town");
		}
		if($this->input->get("sex")>-1){
			$where['gender'] = $this->input->get("sex");
		}
		
		$scholars=$this->scholarship_model->get_scholars($where);
		
		$sems=$this->scholarship_model->get_sems();
		$data["sems"][-1]="All";
		foreach($sems as $sem){
			$word="";
			switch($sem->semester){
				case "1":	
					$word="1st";
					break;
				case "2":	
					$word="2nd";
					break;
				case "3":	
					$word="Summer";
					break;
			}
			$data["sems"][$sem->semester]= $word;
		}
		$sys=$this->scholarship_model->get_sys();
		$data["sys"][-1]="All";
		foreach($sys as $sy){
			$data["sys"][$sy->sy]= $sy->sy;
		}
		$types=$this->scholarship_model->get_types();
		$data["types"][-1]="All";
		foreach($types as $type){
			$data["types"][$type->scholar_type]= $type->type;
		}
		$colleges=$this->scholarship_model->get_colleges();
		$data["colleges"][-1]="All";
		foreach($colleges as $college){
			$data["colleges"][$college->coll_id]= $college->college;
		}
		$courses=$this->scholarship_model->get_courses();
		$data["courses"][-1]="All";
		foreach($courses as $course){
			$data["courses"][$course->cour_id]= $course->course;
		}
		$towns=$this->scholarship_model->get_towns();
		$data["towns"][-1]="All";
		foreach($towns as $town){
			$data["towns"][$town->town]= $town->town;
		}
		$data['scholars']=array();
		foreach($scholars as $scholar){
			$requirements = $this->scholarship_model->get_requirements($scholar->aid);
			$data['scholars'][]=array("info"=>$scholar,"requirements"=>$requirements);
		}
		//print_r($data);
		
		$this->load->view("admin/scholar/scholar_view",$data);
	}
	
	
	function print_scholar(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$where  = array();
		$data['selected'] = array("college"=>$this->input->get("college"),
							"course"=>$this->input->get("course"),
							"town"=>$this->input->get("town"),
							"sex"=>$this->input->get("sex"),
							"sy"=>$this->input->get("sy"),
							"sem"=>$this->input->get("sem"),
							"type"=>$this->input->get("type"),
							"approved"=>$this->input->get("approved"));
		if($this->input->get("approved")>-1){
			$where['approved'] = $this->input->get("approved");
		}
		if($this->input->get("type")>-1){
			$where['scholar_type'] = $this->input->get("type");
		}
		if($this->input->get("sy")>-1){
			$where['sy'] = $this->input->get("sy");
		}
		if($this->input->get("sem")>-1){
			$where['semester'] = $this->input->get("sem");
		}
		if($this->input->get("college")>-1){
			$where['coll_id'] = $this->input->get("college");
		}
		if($this->input->get("course")>-1){
			$where['cour_id'] = $this->input->get("course");
		}
		if($this->input->get("town")>-1){
			$where['town'] = $this->input->get("town");
		}
		if($this->input->get("sex")>-1){
			$where['gender'] = $this->input->get("sex");
		}
		$scholars=$this->scholarship_model->get_scholars($where);
		$sems=$this->scholarship_model->get_sems();
		$data["sems"][-1]="All";
		foreach($sems as $sem){
			$word="";
			switch($sem->semester){
				case "1":	
					$word="1st";
					break;
				case "2":	
					$word="2nd";
					break;
				case "3":	
					$word="Summer";
					break;
			}
			$data["sems"][$sem->semester]= $word;
		}
		$sys=$this->scholarship_model->get_sys();
		$data["sys"][-1]="All";
		foreach($sys as $sy){
			$data["sys"][$sy->sy]= $sy->sy;
		}
		$types=$this->scholarship_model->get_types();
		$data["types"][-1]="All";
		foreach($types as $type){
			$data["types"][$type->scholar_type]= $type->type;
		}
		$colleges=$this->scholarship_model->get_colleges();
		$data["colleges"][-1]="All";
		foreach($colleges as $college){
			$data["colleges"][$college->coll_id]= $college->college;
		}
		$courses=$this->scholarship_model->get_courses();
		$data["courses"][-1]="All";
		foreach($courses as $course){
			$data["courses"][$course->cour_id]= $course->course;
		}
		$towns=$this->scholarship_model->get_towns();
		$data["towns"][-1]="All";
		foreach($towns as $town){
			$data["towns"][$town->town]= $town->town;
		}
		$data['scholars']=array();
		foreach($scholars as $scholar){
			$requirements = $this->scholarship_model->get_requirements($scholar->aid);
			$data['scholars'][]=array("info"=>$scholar,"requirements"=>$requirements);
		}
		//print_r($data);
		
		$this->load->view("admin/scholar/scholar_print",$data);
	}

	function print_scholar_college(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$where  = array();	
		$data['scholars']=array();	
		$where['sy'] = $this->input->get("sy")>0?$this->input->get("sy"):'2015-2016';
		$where['semester'] = $this->input->get("sem")>0?$this->input->get("sem"):0;
		
		if($this->input->get("college")>0){
			$where['coll_id'] = $this->input->get("college");
			$data['scholars']=$this->scholarship_model->get_scholars_by_college($where);
		}		
		
		$this->load->view("admin/scholar/scholar_print_college",$data);
	}
	
	function print_scholar_course(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$where  = array();	
		$data['scholars']=array();	
		$where['sy'] = $this->input->get("sy")>0?$this->input->get("sy"):'2015-2016';
		$where['semester'] = $this->input->get("sem")>0?$this->input->get("sem"):0;
		
		if($this->input->get("course")>0){
			$where['cour_id'] = $this->input->get("course");
			$data['scholars']=$this->scholarship_model->get_scholars_by_course($where);
		}		
		
		$this->load->view("admin/scholar/scholar_print_course",$data);
	}
	
	function print_scholar_type(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$where  = array();	
		$data['scholars']=array();	
		$where['sy'] = $this->input->get("sy")>0?$this->input->get("sy"):'2015-2016';
		$where['semester'] = $this->input->get("sem")>0?$this->input->get("sem"):0;
		
		if($this->input->get("type")>0){
			$where['scholar_type'] = $this->input->get("type");
			$data['scholars']=$this->scholarship_model->get_scholars_by_type($where);
		}	
		
		$this->load->view("admin/scholar/scholar_print_type",$data);
	}

	function choose_cat_to_print(){
		$sems=$this->scholarship_model->get_sems();
		$data["sems"][-1]="Choose";
		foreach($sems as $sem){
			$word="";
			switch($sem->semester){
				case "1":	
					$word="1st";
					break;
				case "2":	
					$word="2nd";
					break;
				case "3":	
					$word="Summer";
					break;
			}
			$data["sems"][$sem->semester]= $word;
		}
		$sys=$this->scholarship_model->get_sys();
		$data["sys"][-1]="Choose";
		foreach($sys as $sy){
			$data["sys"][$sy->sy]= $sy->sy;
		}
		$types=$this->scholarship_model->get_types();
		$data["types"][-1]="Choose";
		foreach($types as $type){
			$data["types"][$type->scholar_type]= $type->type;
		}
		$colleges=$this->scholarship_model->get_colleges();
		$data["colleges"][-1]="Choose";
		foreach($colleges as $college){
			$data["colleges"][$college->coll_id]= $college->college;
		}
		$courses=$this->scholarship_model->get_courses();
		$data["courses"][-1]="Choose";
		foreach($courses as $course){
			$data["courses"][$course->cour_id]= $course->course;
		}
		$this->load->view("admin/scholar/choose_cat_to_print",$data);
	}
	
	function encode_grade(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$data['scholar_id']=$this->uri->segment(3);
		$data['sem']=$this->uri->segment(4);
		$data['sy']=$this->uri->segment(5);
		$this->load->model('adviser_model');
		$data['adviser']=$this->adviser_model->get($this->uri->segment(3));
		$this->load->view("admin/scholar/encode_grade_view",$data);
		
	}
	
	function compute_grade(){
		
		if(!$this->input->post("stud_id")){
			$this->load->view("error_404");
			return;
		} 
		
		$subjects=$_POST['subj_code'];
		$this->load->model("scholar_grade_model");
		$total_units=0;
		$sum_of_grade=0;
		for($i=0;$i<sizeof($subjects);$i++){
			$data=array("sid"=>$this->input->post("stud_id"),
						"sub_code"=>ucwords($_POST['subj_code'][$i]),
						"sub_desc"=>ucwords($_POST['subject'][$i]),
						"unit"=>$_POST['units'][$i],
						"mg"=>$_POST['midterm'][$i],
						"fg"=>$_POST['final'][$i],
						"school_year"=>$this->input->post("sy"),
						"sem"=>$this->input->post("sem"));
			$this->scholar_grade_model->insert($data);
			$total_units+=$_POST['units'][$i];
			$sum_of_grade+=($_POST['units'][$i]*$_POST['final'][$i]);
			//echo "<tr><td>".$_POST['subj_code'][$i]."</td><td>".$_POST['subject'][$i]."</td><td>".$_POST['units'][$i]."</td><td>".$_POST['midterm'][$i]."</td><td>".$_POST['final'][$i]."</td></tr>";
		}
		
		$ave=$sum_of_grade/$total_units;
		$this->load->model("scholarship_model");		
		$data['student']=$this->scholar_model->get_by_scholarship_id($this->input->post("stud_id"));
		$this->scholarship_model->update_average($this->input->post("stud_id"),array("average"=>$ave));
		$data['grades'] =$this->scholar_grade_model->get($this->input->post("stud_id"),$this->input->post("sy"),$this->input->post("sem"));
		$this->load->model("adviser_model");
		$this->adviser_model->insert(array("scholarship_id"=>$this->input->post("stud_id"),"adviser"=>$this->input->post("adviser"),"dean"=>$this->input->post("dean")));
		redirect('scholar/print_grade/'.$this->input->post("stud_id").'/'.md5($this->uri->segment(3).$this->session->userdata("admin_secret")));
		 
		 return;
	}
	
	function print_grade(){		
		if((!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r")||(strcmp(md5($this->uri->segment(3).$this->session->userdata("admin_secret")),$this->uri->segment(4))>0)) {
			$this->load->view("error_404");
			return;
		}
		$sid = $this->uri->segment(3);
		$this->load->model("scholar_grade_model");
		$this->load->model("adviser_model");
		$data['grades'] =$this->scholar_grade_model->get($sid,'2013-2014',1);
		$data['signs']=$this->adviser_model->get($sid);
		$data['student']=$this->scholar_model->get_by_scholarship_id($sid);
		$scholarship_type=$this->scholarship_model->get_by_scholarship($sid);
		$data['scholarship_id']=$sid;
		$data['min_grade']=$scholarship_type[0]->minimum_grade;
		$data['average']=$scholarship_type[0]->min_average;
		$data['scholar_type']=$scholarship_type[0]->type;
		$data['scholar_ave']=$scholarship_type[0]->average;
		$this->load->view("print_grade_view",$data);
	}
	
	function print_cert_grade(){
		$aid = $this->uri->segment(3);
		$data['scholar']=$this->scholar_model->get_by_aid($aid);
		$this->load->model("scholar_grade_model");
		$data['scholarship']=$this->scholarship_model->get_by_scholarship($aid);
		$data['grade']=$this->scholar_grade_model->get_by_aid($aid);
		$this->load->view("admin/scholar/print_cert_grade_view",$data);
	}
	
	function create_pdf(){
		$this->load->library("fpdf");
		$this->fpdf->pdf = new Fpdf();
		$this->fpdf->AddPage('L');
		$this->fpdf->fontpath= realpath(APPPATH."../fonts")."/";
		$this->fpdf->SetFont('Arial', 'B', 12);
		$m = 'something';
		$this->fpdf->MultiCell(250, 4, $m, 0, 'C');
		//$this->fpdf->setText($m);
		$this->fpdf->Output();
	}
	function confirm(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$aid=$this->uri->segment(3);
		$success=$this->scholarship_model->confirm($aid);		
		$this->session->set_flashdata("message","Scholarship confirmed.");
		redirect("scholar/view_scholar#message");
	}
	
	function approv_all(){
		if(!$this->encrypt->decode($this->session->userdata("admin_secret"))=="ic4ntThink0fAno+h3r") {
			$this->load->view("error_404");
			return;
		}
		$data=array();
		foreach($_POST['aid'] as $aid){
			$data[]=array("aid"=>$aid,"approved"=>"1");
		}
		$success=$this->scholarship_model->confirm_all($data);		
		$this->session->set_flashdata("message","Selected scholarships confirmed.");
		redirect("scholar/view_scholar#message");
		
	}
	function get_grade(){		
		$this->load->model("scholar_grade_model");
		
		$data['grades']=$this->scholar_grade_model->get($this->input->post("stud_id"),$this->input->post("sy"),$this->input->post("sem"));
		$json=json_encode($data['grades']);
		echo $json;
	}
	//site key = 6LdAif4SAAAAAMgubH5XWj8DZSRAIr1cuUws-BnQ
	//secret key = 6LdAif4SAAAAAGuv5AUc6tkfDRhl4Gf9TkBiKxjL
	
	/*public function send_mail($to,$fname,$lname,$id){
		$this->load->library('email');
		 $this->email->to($to);
	    $this->email->from('osaunp@gmail.com',"UNP-OSA");
	    $this->email->subject("Verify Your Scholarship Account");
	    $this->email->message("<p>Hi ".$fname . ",<p>"
								."<p> Please click this ".anchor("scholar/verify"."/".md5($to."5x*y3")."/".$id,"link")." to verify your scholarship account application.</p>".
								"<p>If the link above will not work. Please go to this address ".site_url("scholar/verify")."/".md5($to."5x*y3")."/".$id.".".
								"<p>Regards,<p>".
								"<b><i>The UNP Family</i></b>");
    	$success=$this->email->send();
		return $success;
	}
	 * 
	 */
	public function send_mail($to,$fname,$mname,$lname,$id) {
		/*$this->load->library('My_PHPMailer');
        $mail = new PHPMailer();
		//$mail->isMail();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port 	  = 465;   
        $mail->Host       = "smtp.gmail.com";//"smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Username   = "osaunp@gmail.com";  // user email address
        $mail->Password   = "University0sa";            // password in GMail
		 
		 
        $mail->SetFrom('acristopherd@gmail.com', 'University of Northern Philippines');  //Who is sending the email
        //$mail->AddReplyTo($to,$fname." ".$mname." ".$lname);  //email address that receives the response
        $mail->Subject    = "Verify Your Scholarship Account";
		$message		=	"<p>Hi ".$fname . ",<p>"
							."<p> Please click this ".anchor("scholar/verify"."/".md5($to."5x*y3")."/".$id,"link")." to verify your scholarship account application.</p>".
							"<p>If the link above will not work. Please go to this address ".str_replace(".html", "", $subject,site_url("scholar/verify"))."/".md5($to."5x*y3")."/".$id.".".
							"<p>Regards,<p>".
							"<b><i>The UNP Family</i></b>";
        $mail->Body       = $message;
							
        $mail->AltBody    = "Hi ".$fname . ",\n"
							."If the link above will not work. Please go to this address ".str_replace(".html", "", $subject,site_url("scholar/verify"))."/".md5($to."5x*y3")."/".$id.".\n\n".
							"Regards,\n".
							"The UNP Family";
        //$destino = "addressee@example.com"; // Who is addressed the email to
        $mail->AddAddress($to,$fname." ".$mname." ".$lname);

        //$mail->AddAttachment("images/phpmailer.gif");      // some attached files
        //$mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want
		 * 
		 */
		 $subject="Verify Your Scholarship Account";
		 $message		=	"<p>Hi ".$fname . ",<p>"
							."<p> Please click this ".anchor("scholar/verify"."/".md5($to."5x*y3")."/".$id,"link")." to verify your scholarship account application.</p>".
							"<p>If the link above will not work. Please go to this address ".str_replace(".html", "",site_url("scholar/verify"))."/".md5($to."5x*y3")."/".$id.".".
							"<p>Regards,<p>".
							"<b><i>The UNP Family</i></b>";
		 $this->load->library('email');
		 $result = $this->email
                ->from('osaunp@gmail.com')
                ->reply_to('osaunp@gmail.com')    // Optional, an account where a human being reads.
                ->to($to)
                ->subject($subject)
                ->message($message)
                ->send();
        if($result) {
        	$data["message"] = "Message sent correctly!";
           
        } else {
        	$config['mailtype']='html';
        	$this->load->library("phpemail",$config);
        	$result=$this->phpemail
                ->from('osaunp@gmail.com')
                ->reply_to('osaunp@gmail.com')    // Optional, an account where a human being reads.
                ->to($to)
           
                ->subject($subject)
                ->message($message)
                ->send();
                if($result){
                	$data["message"] = "Message sent correctly!";
                }
				else{
					$data["message"] = "Error: " . $result."Debug: ".$this->email->print_debugger();
				}
             
        }
        //$this->load->view('mail_sent',$data);
        return $data["message"];
    }
	 
	 
}
