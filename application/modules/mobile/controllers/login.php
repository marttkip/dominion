<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		
		// Allow from any origin
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
	
		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	
			exit(0);
		}
		
		$this->load->model('login_model');
		$this->load->model('email_model');
		
		$this->load->library('Mandrill', $this->config->item('mandrill_key'));
	}
	public function register_professional()
	{
		$this->form_validation->set_error_delimiters('', '');
		
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gender_id', 'Gender', 'trim|xss_clean');
		$this->form_validation->set_rules('dob', 'DOB', 'trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('college', 'College', 'trim|xss_clean');
		$this->form_validation->set_rules('reg_number', 'Registration number', 'trim|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'trim|xss_clean');
		$this->form_validation->set_rules('post_code', 'Post code', 'trim|xss_clean');
		$this->form_validation->set_rules('country', 'Country', 'trim|xss_clean');
		$this->form_validation->set_rules('user_type', 'Type', 'trim|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			$status = $this->login_model->register_young_profession_details();
			if($status == TRUE)
			{
				
					$response['message'] = 'success';
					$response['result'] = $this->input->post('email');
			}
			
			else
			{
					$response['message'] = 'fail';
					$response['result'] = 'Unable to create account. Please try again';
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				$response['message'] = 'fail';
			 	$response['result'] = $validation_errors;
			}
			
			//populate form data on initial load of page
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Ensure that you have entered all the values in the form provided';
			}
		}
		echo json_encode($response);
	}
	public function register_influencer()
	{
		$this->form_validation->set_error_delimiters('', '');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ministry', 'Ministry', 'trim|xss_clean');
		$this->form_validation->set_rules('leadership_position', 'Leadership Position', 'trim|xss_clean');
		$this->form_validation->set_rules('professional_body', 'Professional Body', 'trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'trim|xss_clean');
		$this->form_validation->set_rules('country', 'Country', 'trim|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			$status = $this->login_model->register_influencer_details();
			if($status == TRUE)
			{
				$response['message'] = 'success';
				$response['result'] = $this->input->post('email');
			}
			
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Unable to create account. Please try again';
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				$response['message'] = 'fail';
			 	$response['result'] = $validation_errors;
			}
			
			//populate form data on initial load of page
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Ensure that you have entered all the values in the form provided';
			}
		}
		echo json_encode($response);
	}
	public function register_investor()
	{
		$this->form_validation->set_error_delimiters('', '');
		
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('leadership_position', 'Profession', 'trim|xss_clean');
		$this->form_validation->set_rules('professional_body', 'Ministry', 'trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'trim|xss_clean');
		$this->form_validation->set_rules('country', 'Country', 'trim|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			$status = $this->login_model->register_investor_details();
			if($status == TRUE)
			{
				
				$response['message'] = 'success';
				$response['result'] = $this->input->post('email');
			}
			
			else
			{
					$response['message'] = 'fail';
					$response['result'] = 'Unable to create account. Please try again';
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				$response['message'] = 'fail';
			 	$response['result'] = $validation_errors;
			}
			
			//populate form data on initial load of page
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Ensure that you have entered all the values in the form provided';
			}
		}
		echo json_encode($response);
	}
}
?>