<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_library extends CI_Controller {
    function __construct()
	{
		$this->data = [];
		parent::__construct();
		    date_default_timezone_set('Asia/Jakarta');
		    $this->load->helper(['form']);
            $this->load->library(['form_validation','Recaptcha_google']);
	}
	
	public function index()
	{
	    $this->form_validation->set_rules('username', 'Username', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');
	    $this->form_validation->set_rules('google_recaptcha', 'Google Recaptcha', 'required');
	    if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('test_library');
        }
        else
        {
            $google_recaptcha   = $this->input->post('google_recaptcha',TRUE);
            $username           = $this->input->post('username',TRUE);
            $password           = $this->input->post('password',TRUE);
            
            $secret     = $this->config->item('recaptcha_secret_key');
            $status     = $this->recaptcha_google->verifyResponse($secret, $google_recaptcha);
            //$status = json_decode($output, true);
            if($status['success'] == true){
                echo "Berhasil Login";
                echo "<br/>";
                echo "Username :". $username;
                echo "<br/>";
                echo "Password :". $password;
                echo "<br/>";
                echo "<br/>";
                echo "<br/>";
                echo "<br/>";
                echo "Status : ".$status['success'];
                echo "<br/>";
                echo '<a href='.base_url('test_library').'>< Kembali</a>';
                 echo "<br/>";
                
            }else{
                echo "Recaptcha Verification is Faild!";
            }
        }
	}
}

