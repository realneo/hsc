<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    //great for initializing default variables
    protected  $data = array();
    function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('user_id')){
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg', 'You have to login first');

            redirect('login');
        }

        $this->load->model('usuals');
        $this->load->model('expenses');
        $this->load->model('invoices');
        $this->load->model('returns');
        $this->load->model('vouchers');


        /*
         * We only need to change the name, but always check the id
         */

        $name=$this->usuals->get_branch_name($this->session->userdata('branch_id'));
        $this->session->set_userdata("branch_name",$name);
    }
        public function index($word='test')
	{

        $word=$this->input->post('password');
        $data['word_orignal'] =$word;
        $data['word_pass'] =tokenize_sha1($word);

        /*
         * Specific Data for one page goes here
         */
        $data['title']="Password Change";
        $data['active']="dashboard";
        $data['active_tab']="";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');
        $this->load->view('password');

        $this->load->view('includes/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */