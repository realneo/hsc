<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hsc extends CI_Controller {


	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('default_content');
		$this->load->view('includes/footer');
	}
}

