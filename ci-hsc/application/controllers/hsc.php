<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hsc extends CI_Controller {
    //great for initializing default variables
    protected  $data = array();
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuals');

    }



	public function index()
	{
        $this->session->set_userdata("branch_id",7);

		$data['manual_invoice']=$this->usuals->getTotalManualInvoices(0);

        $this->load->view('includes/header',$data);

		$this->load->view('default_content');
		$this->load->view('includes/footer');
	}
}

