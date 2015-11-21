<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sermons extends MX_Controller {
	
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
		
		$this->load->model('sermons_model');
		$this->load->model('email_model');
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function get_sermons() 
	{
		$query = $this->sermons_model->get_sermons();
		
		$v_data['query'] = $query;
		$data['total'] = $query->num_rows();

		$response['message'] = 'success';
		$response['result'] = $this->load->view('sermons', $v_data, true);

		
		echo json_encode($response);
	}
    
	/*
	*
	*	Latest sermon
	*
	*/
	public function get_latest_sermon() 
	{
		$query = $this->sermons_model->get_sermons();
		
		$v_data['query'] = $query;
		$data['total'] = $query->num_rows();

		$response['message'] = 'success';
		$response['result'] = $this->load->view('latest_sermons', $v_data, true);

		
		echo json_encode($response);
	}
	
	public function get_sermons_detail($id)
	{
		$query = $this->sermons_model->get_sermons_detail($id);
		
		$v_data['query'] = $query;
		$v_data['id'] = $id;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('sermons_detail', $v_data, true);

		
		echo json_encode($response);

	}
	public function count_unread_sermons()
	{
		$data['unread_messages'] = $this->sermons_model->count_unread_sermons();
		$data['sermons'] = $this->get_sermons();
		
		echo json_encode($data);
	}
	
	
}