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
	*	Get new sermons
	*
	*/
	public function get_new_sermons($last_post) 
	{
		$query = $this->sermons_model->get_new_sermons($last_post);
		$posts = '';
		$post_title = '';
		$message = 'no new';
		
		if($query->num_rows() > 0)
		{
			$count = 0;
			$message = 'new';
			$posts .= "INSERT INTO post (post_id, post_title, post_content, created, post_status, post_views, post_image, created_by, modified_by, last_modified, post_thumb, post_comments, blog_category_id, tiny_url, post_video, post_audio, created_status, read_status) VALUES";
			foreach($query->result() as $row)
			{
				$count++;
				$post_id = $row->post_id;
				$post_title = $row->post_title;
				$post_content = $row->post_content;
				$post_image = $row->post_image;
				$post_audio = $row->post_audio;
				$post_video = $row->post_video;
				$post_status = $row->post_status;
				$post_views = $row->post_views;
				$created = $row->created;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				$last_modified = $row->last_modified;
				$post_thumb = $row->post_thumb;
				$post_comments = $row->post_comments;
				$blog_category_id = $row->blog_category_id;
				$tiny_url = $row->tiny_url;
				$post_video = $row->post_video;
				$post_audio = $row->post_audio;
				$created_status = $row->created_status;
				$read_status = $row->read_status;
				
				if($count == $query->num_rows())
				{
					$posts .= "(".$post_id.", '".$post_title."', '".$post_content."', '".$created."', ".$post_status.", ".$post_views.", '".$post_image."', ".$created_by.", ".$modified_by.", '".$last_modified."', '".$post_thumb."', ".$post_comments.", ".$blog_category_id.", '".$tiny_url."', '".$post_video."', '".$post_audio."', ".$created_status.", ".$read_status.")";
				}
				
				else
				{
					$posts .= "(".$post_id.", '".$post_title."', '".$post_content."', '".$created."', ".$post_status.", ".$post_views.", '".$post_image."', ".$created_by.", ".$modified_by.", '".$last_modified."', '".$post_thumb."', ".$post_comments.", ".$blog_category_id.", '".$tiny_url."', '".$post_video."', '".$post_audio."', ".$created_status.", ".$read_status."), ";
				}
			}
		}

		$response['message'] = $message;
		$response['post_title'] = $post_title;
		$response['result'] = $posts;

		
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