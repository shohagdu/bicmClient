<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	public function __construct()
	{
	parent::__construct();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache");
		$this->load->library('user_agent');	
		$this->load->model('library_home', 'lib');
	}
	
	public function index()
	{
	}

	public function mailme()
	{
	$this->load->view('mailme');
	}
	
}
?>