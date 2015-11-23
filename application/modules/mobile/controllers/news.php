<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MX_Controller {
	
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
		
		$this->load->model('news_model');
		$this->load->model('email_model');
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function get_news() 
	{
		$query = $this->news_model->get_news();
		
		$v_data['query'] = $query;
		$data['total'] = $query->num_rows();

		$response['message'] = 'success';
		$response['result'] = $this->load->view('news', $v_data, true);

		
		echo json_encode($response);
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function get_blog_items($blog_category_id) 
	{
		$query = $this->news_model->get_blog_items($blog_category_id);
		
		$v_data['query'] = $query;
		$data['total'] = $query->num_rows();

		$response['message'] = 'success';
		$response['result'] = $this->load->view('blog', $v_data, true);

		
		echo json_encode($response);
	}
	
	public function get_news_detail($id)
	{
		$query = $this->news_model->get_news_detail($id);
		$v_data['comments_query'] = $this->news_model->get_post_comments($id);
		
		$v_data['query'] = $query;
		$v_data['id'] = $id;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('news_detail', $v_data, true);

		
		echo json_encode($response);

	}
	public function count_unread_news()
	{
		$data['unread_messages'] = $this->news_model->count_unread_news();
		$data['news'] = $this->get_news();
		
		echo json_encode($data);
	}
    
	/*
	*
	*	Add a new comment
	*
	*/
	public function save_comment() 
	{
		//form validation rules
		$this->form_validation->set_rules('comment', 'Comment', 'required|xss_clean');
		$this->form_validation->set_rules('name', 'Name', 'xss_clean');
		$this->form_validation->set_rules('post_id', 'post_id', 'xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run() == FALSE)
		{
			$response['message'] = 'fail';
			$response['result'] = validation_errors();
		}
		
		else
		{
			if($this->news_model->add_comment_user())
			{
				$response['message'] = 'success';
				$response['result'] = '<li class="comment_row"><div class="comm_avatar"><img src="images/icons/black/user.png" alt="" title="" border="0" /></div><div class="comm_content"><p>'.$this->input->post('comment').' by <a href="#">'.$this->input->post('name').'</a></p></div></li>';
			}
			
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Could not add comment. Please try again';
			}
		}
		echo json_encode($response);
	}
}