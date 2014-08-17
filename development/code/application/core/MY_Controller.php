<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main_Controller extends CI_Controller {
	var $content_dir;
	var $template_dir; 
	var $is_admin;
 
    function __construct()
    {
        parent::__construct();
		
		$this->content_dir = "content/site/";
		$this->template_dir = "templates/site/default/";
		
		if($this->session->userdata('is_admin'))
			$this->is_admin = $this->session->userdata('is_admin');
		else
			$this->is_admin = FALSE;
    }
}