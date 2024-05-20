<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ***************************************************************
 *  Script 		: Belajar Codeigniter
 *  Version 	: 3.1.13
 *  Date 		: 20 Mei 2024
 *  Author 		: Pudin Saepudin Ilham Development Ciamis
 *  Email 		: najzmitea@yahoo.com
 *  Description : Seorang Petani yang suka dengan teknologi.
 *  Blog 		: https://www.pudin.my.id / https://www.pdn.my.id / https://anibarstudio.blogspot.com.
 * 	Github 		: https://github.com/pudintea.
 
 * 				: $this->load->library(['Recaptcha_google']);
 * 				: $this->recaptcha_google->verifyResponse(secret_key, response_recaptcha);
 * ***************************************************************
 */

class Recaptcha_google{

	public function verifyResponse($secret_key ='', $recaptcha=''){
		
		$remoteIp = $this->getIPAddress();

		// Discard empty solution submissions
		if (empty($recaptcha)) {
			return array(
				'success' => false,
				'error-codes' => 'missing-input',
			);
		}
		
		if (empty($secret_key)) {
			return array(
				'success' => false,
				'error-codes' => 'missing-input',
			);
		}

		$getResponse = $this->getHTTP(
			array(
				'secret' => $secret_key,
				'remoteip' => $remoteIp,
				'response' => $recaptcha,
			)
		);

		// get reCAPTCHA server response
		$responses = json_decode($getResponse, true);

		if (isset($responses['success']) and $responses['success'] == true) {
			$status = true;
		} else {
			$status = false;
			$error = (isset($responses['error-codes'])) ? $responses['error-codes']
				: 'invalid-input-response';
		}

		return array(
			'success' => $status,
			'error-codes' => (isset($error)) ? $error : null,
		);
	}


	private function getIPAddress(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
		{
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} 
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
		{
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} 
		else 
		{
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
	}

	private function getHTTP($data){
		
		$url = 'https://www.google.com/recaptcha/api/siteverify?'.http_build_query($data);
		$response = file_get_contents($url);

		return $response;
	}
}