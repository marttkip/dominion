<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bible_school extends MX_Controller {
	
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
		
		$this->load->model('bible_school_model');
		$this->load->model('arms_model');
		$this->load->model('email_model');
	}
	
	public function get_bible_school_detail()
	{
		$query = $this->bible_school_model->get_bible_school_detail();
		
		$v_data['query'] = $query;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('bible_school_detail', $v_data, true);

		
		echo json_encode($response);

	}


	public function get_college_details($id)
	{
		$query = $this->bible_school_model->get_college_detail($id);
		
		$v_data['query'] = $query;
		$v_data['id'] = $id;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('college_detail', $v_data, true);
		echo json_encode($response);

	}
	
	
	
}