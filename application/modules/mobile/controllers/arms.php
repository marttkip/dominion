<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arms extends MX_Controller {
	
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
		
		$this->load->model('arms_model');
		$this->load->model('email_model');
	}
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function get_arms() 
	{
		$query = $this->arms_model->get_arms();
		
		$v_data['query'] = $query;
		$data['total'] = $query->num_rows();

		$response['message'] = 'success';
		$response['result'] = $this->load->view('arms', $v_data, true);

		
		echo json_encode($response);
	}
	
	public function get_arms_detail($id)
	{
		$query = $this->arms_model->get_arms_detail($id);
		
		$v_data['query'] = $query;
		$v_data['id'] = $id;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('arms_detail', $v_data, true);

		
		echo json_encode($response);

	}
	public function count_unread_arms()
	{
		$data['unread_messages'] = $this->arms_model->count_unread_arms();
		$data['arms'] = $this->get_arms();
		
		echo json_encode($data);
	}
	
	
}