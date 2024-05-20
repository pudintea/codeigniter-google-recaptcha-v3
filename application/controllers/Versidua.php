<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Versidua extends CI_Controller {
    function __construct()
	{
		$this->data = [];
		parent::__construct();
		    date_default_timezone_set('Asia/Jakarta');
		    $this->load->helper(['form']);
            $this->load->library(['form_validation']);
	}
	
	public function index()
	{
	    $this->form_validation->set_rules('username', 'Username', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');
	    $this->form_validation->set_rules('g-recaptcha-response', 'Google Response', 'required');
	    if ($this->form_validation->run() == FALSE)
        {
			$this->data['recaptcha_site_key'] = '6LdSNeIpAAAAAIOK60BfTKIhJ6JIXIuAzza4iAPq'; // Dari Google
            $this->load->view('versidua', $this->data);
        }
        else
        {
            $google_recaptcha   = $this->input->post('g-recaptcha-response',TRUE);
            $username           = $this->input->post('username',TRUE);
            $password           = $this->input->post('password',TRUE);
            
            $recaptcha_secret_key = '6LdSNeIpAAAAAP6eMkWWwq4J5pO54qFnM8KDdth-'; // Dari Google
            $url    = "https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret_key."&response=".$google_recaptcha;
            $curl   = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
            $output = curl_exec($curl);
            curl_close($curl);
            $status = json_decode($output, true);
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
                echo "Cchallenge : ".$status['challenge_ts'];
                echo "<br/>";
                echo "Hostname : ".$status['hostname'];
                echo "<br/>";
                echo '<a href='.base_url('versidua').'>< Kembali</a>';
                 echo "<br/>";
                
            }else{
                echo "Recaptcha Verification is Faild!";
            }
        }
	}
}

