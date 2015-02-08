<?php 

class captcha extends CI_Controller{
	
	function __construct() {
        parent::__construct();
		date_default_timezone_set("Asia/Manila");
    }
	
   

    function captcha_check()
    {
            // Then see if a captcha exists:
            $exp=time()-600;
            $sql = "SELECT COUNT(*) AS count FROM tblcaptcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
            $binds = array($this->input->post('captcha'), $this->input->ip_address(), $exp);
            $query = $this->db->query($sql, $binds);
            $row = $query->row();

            if ($row->count == 0)
            {
                $this->validation->set_message('_captcha_check', 'Invalid captcha');
                return FALSE;
            }else{
            	//DELETE existing captcha images
		    $files = glob($path.'*'); // get all file names
		    foreach($files as $file){ // iterate files
		      if(is_file($file))
		        unlink($file); // delete file
		        //echo $file.'file deleted';
		    }   
                return TRUE;
            }

    }

	function recaptcha(){
		$this->load->model("captcha_model");
		$this->captcha_model->recaptcha();
	}
}
