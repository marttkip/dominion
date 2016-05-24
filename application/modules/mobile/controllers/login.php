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
	public function login_forum_member()
	{
		$this->form_validation->set_rules('email_address', 'Email', 'trim|required|xss_clean');
		// $this->form_validation->set_rules('member_no', 'Member No.', 'trim|xss_clean');

		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			$status = $this->login_model->login_to_forum();
			if($status == FALSE)
			{
				$response['message'] = 'fail';
				$response['result'] = 'Unable to create account. Please try again'.$status;
					
			}
			
			else
			{
				//create user's login session
				$newdata = array(
	                   'member_login_status'    => TRUE,
	                   'member_email'     		=> $status[0]->member_email,
	                   'member_no'     	=> $status[0]->member_no,
	                   'member_name'  			=> $status[0]->member_name,
	                   'date_of_birth'  			=> $status[0]->date_of_birth,
	                   'member_id'  			=> $status[0]->member_id
                );
                $this->session->set_userdata($newdata);
                $age = 13;

                if($age >= 10 AND $age <= 15)
                {
                	$response['level'] = 3;	
                }
                else if ($age >= 16 AND $age <= 17)
                {
                	$response['level'] = 3;	
                }
                 else if ($age >= 18 AND $age <= 25)
                {
                	$response['level'] = 3;	
                }
                else 
                {
                	$response['level'] = 3;	
                }
				$response['message'] = 'success';
				$response['result'] = $newdata;	
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
			 	$response['level'] = 0;	
			}
			
			//populate form data on initial load of page
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Ensure that you have entered all the values in the form provided';
				$response['level'] = 0;	
			}
		}
		echo json_encode($response);

	}
	public function get_client_profile()
	{
		$v_data['profile_query'] = $this->login_model->get_profile_details();
		

		$response['message'] = 'success';
		$response['result'] = $this->load->view('member_profile', $v_data, true);

		echo json_encode($response);
	}
	public function register_professional()
	{
		$this->form_validation->set_error_delimiters('', '');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ministry', 'Ministry', 'trim|xss_clean');
		$this->form_validation->set_rules('leadership_position', 'Leadership Position', 'trim|xss_clean');
		$this->form_validation->set_rules('college', 'College', 'trim|xss_clean');
		$this->form_validation->set_rules('professional_body', 'Professional Body', 'trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'trim|xss_clean');
		$this->form_validation->set_rules('country', 'Country', 'trim|xss_clean');
		
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