
<?php

class captcha_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function check_captcha($captcha,$ip){
		 $expiration = time()-7200; // Two hour limit
		 $this->db->query("DELETE FROM tblcaptcha WHERE captcha_time < ".$expiration);     
			
			  // Then see if a captcha exists:
			  $sql = "SELECT COUNT(*) AS count FROM tblcaptcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
			  $binds = array($captcha, $ip, $expiration);
			  $query = $this->db->query($sql, $binds);
		 $row = $query->row();
		 return $row->count;
	}	
	
	function recaptcha(){
		$this->load->helper('captcha');
		
		$word1="";
		$word2="";
		$vals = array(
		'img_path'	 => './captcha/',
		'img_url'	 => base_url().'captcha/',
		'word'=>$this->get_word()." ". mt_rand(1000, 9999),
		 'font_path' => './css/font/comic.ttf',
	    'img_width'	 => '250',
	    'img_height' => 50,
	    'expiration' => 7200
		);
		$cap = create_captcha($vals);			
		$data = array(
		'captcha_time'	=> $cap['time'],
		'ip_address'	=> $this->input->ip_address(),
		'word'	 => $cap['word']
		);

		$query = $this->db->insert('tblcaptcha', $data);
		
		$doc = new DOMDocument();
		libxml_use_internal_errors(true);
		$doc->loadHTML($cap['image']); // loads your html
		$xpath = new DOMXPath($doc);
		$nodelist = $xpath->query("//img"); // find your image
		$node = $nodelist->item(0); // gets the 1st image
		$value = $node->attributes->getNamedItem('src')->nodeValue;
		echo "$value";
		//echo '<input type="text" name="captcha" value="" />'; 
	}
	
	function get_captcha(){
		$this->load->helper('captcha');
		
		$word1="";
		$word2="";
		$vals = array(
		'img_path'	 => './captcha/',
		'img_url'	 => base_url().'captcha/',
		'word'=>$this->get_word()." ". mt_rand(1000, 9999),
		 'font_path' => './css/font/comic.ttf',
	    'img_width'	 => '250',
	    'img_height' => 50,
	    'expiration' => 7200
		);
		$cap = create_captcha($vals);			
		$data = array(
		'captcha_time'	=> $cap['time'],
		'ip_address'	=> $this->input->ip_address(),
		'word'	 => $cap['word']
		);

		$query = $this->db->insert_string('tblcaptcha', $data);
		$this->db->query($query);

		
		return $cap['image'];
	}
	
	function get_word(){
		$this->load->helper('file');
		$file = read_file(realpath(APPPATH.'../other_files/ilocano.txt'));
		$words=explode("\n", $file);
		$word =$words[mt_rand(0,1308)];
		$word=trim(ucfirst($word));
		return $word;
	}
}
?>