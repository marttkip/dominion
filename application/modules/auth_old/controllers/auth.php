<?php
class Auth extends MX_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('auth_model');
		$this->load->model('site/site_model');
	}
	
	public function index()
	{
		if(!$this->auth_model->check_login())
		{
			redirect('login');
		}
		
		else
		{
			redirect('dashboard');
		}
	}
    
	/*
	*
	*	Login a user
	*
	*/
	public function login_user() 
	{
		$data['user_password_error'] = '';
		$data['email_error'] = '';
		
		//form validation rules
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('user_email', 'Email', 'required|xss_clean|valid_email|exists[users.email]');
		$this->form_validation->set_rules('user_password', 'Password', 'required|xss_clean');
		
		//$mail = $_POST['user_email'];
		//var_dump($mail);die();
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->auth_model->validate_user())
			{
				redirect('dashboard');
			}
			
			else
			{
				$this->session->set_userdata('login_error', 'The email or password provided is incorrect. Please try again');
				$data['user_email'] = set_value('user_email');
				$data['user_password'] = set_value('user_password');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			//echo $validation_errors; die();
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$data['user_password_error'] = form_error('user_password');
				$data['email_error'] = form_error('user_email');
				
				//repopulate fields
				$data['user_password'] = set_value('user_password');
				$data['user_email'] = set_value('user_email');
			}
			
			//populate form data on initial load of page
			else
			{
				$data['user_password'] = "";
				$data['user_email'] = "";
			}
		}
		$data['title'] = $this->site_model->display_page_title();
		
		$this->load->view('templates/login', $data);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
?>