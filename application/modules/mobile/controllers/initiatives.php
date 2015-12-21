<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Initiatives extends MX_Controller {
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
		
		$this->load->model('initiatives_model');
		$this->load->model('email_model');
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function get_initiatives() 
	{
		$query = $this->initiatives_model->get_initiatives(12);
		
		$v_data['query'] = $query;

		$response['message'] = 'success';
		$response['result'] = $this->load->view('initiative', $v_data, true);

		
		echo json_encode($response);
	}

	public function get_initiative_page($id)
	{
		if($id == 26)
		{
			// economic

			$passed_items = 13;
		}
		else if($id == 27)
		{
			// social
			$passed_items = 14;
		}
		else
		{
			// spiritual
			$passed_items = 15;			
		}
		
		$query = $this->initiatives_model->get_initiatives($passed_items);
		
		$v_data['query'] = $query;

		$v_data['parent_id'] = $id;
		$v_data['initiative_page_query'] = $this->initiatives_model->get_initiative_detail($id);

		$response['message'] = 'success';
		$response['result'] = $this->load->view('initiative_page', $v_data, true);

		
		echo json_encode($response);

	}
	
	public function get_initiatives_old()
	{
		$query = $this->initiatives_model->get_initiatives(13);
		$corporates = $this->initiatives_model->get_initiatives(14);
		$learning = $this->initiatives_model->get_initiatives(15);
		$individual = $this->initiatives_model->get_initiatives(10);
		
		$v_data['query'] = $query;
		$v_data['corporates'] = $corporates;
		$v_data['learning'] = $learning;
		$v_data['individual'] = $individual;
		$data['total'] = $query->num_rows();

		$response['message'] = 'success';
		$response['result'] = $this->load->view('initiative', $v_data, true);

		
		echo json_encode($response);
	}

	public function get_initiative_detail($id,$parent_id)
	{
		$query = $this->initiatives_model->get_initiative_detail($id);
		
		
		
		$v_data['query'] = $query;
		$v_data['id'] = $id;
		$v_data['parent_id'] = $parent_id;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('initiative_detail', $v_data, true);

		
		echo json_encode($response);

	}
	public function count_unread_initiatives()
	{
		$data['unread_messages'] = $this->initiatives_model->count_unread_initiatives();
		$data['initiatives'] = $this->get_initiatives();
		
		echo json_encode($data);
	}
}
?>