<?php

class News_model extends CI_Model 
{
	/*
	*	Get blog items by category_id
	*
	*/
	public function get_blog_items($blog_category_id)
	{
		$this->db->where('blog_category_id = '.$blog_category_id);
	 	$this->db->order_by('last_modified','ASC');
		$query = $this->db->get('post');
		
		return $query;
	}
	/*
	*	Update user's last login date
	*
	*/
	public function get_news()
	{
		$this->db->where('blog_category_id = 5');
	 	$this->db->order_by('last_modified','ASC');
		$query = $this->db->get('post');
		
		return $query;
	}
	
	public function get_news_detail($id)
	{
		$this->db->where('post_id = '.$id);
		$query = $this->db->get('post');
		return $query;
	}

	public function count_unread_news()
	{
		$this->db->where('blog_category_id = 5');
	 	$this->db->order_by('last_modified','DESC');
		$query = $this->db->get('post');	

		return $query->num_rows();	
	}
	
	/*
	*	Retrieve comments
	* 	@param int $post_id
	*
	*/
	public function get_post_comments($post_id)
	{
		//retrieve all users
		$this->db->from('post_comment, member');
		$this->db->select('post_comment.*, member.member_name');
		$this->db->where('post_comment.member_id = member.member_id AND post_comment_status = 1 AND post_id = '.$post_id);
		$this->db->order_by('comment_created', 'ASC');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Add a new comment
	*	@param int $post_id
	*
	*/
	public function add_comment_user()
	{
		$data = array(
				'post_comment_description'=>$this->input->post('comment'),
				'comment_created'=>date('Y-m-d H:i:s'),
				'member_id'=>$this->input->post('member_id'),
				'post_comment_status'=>1,
				'post_id'=>$this->input->post('post_id')
			);
			
		if($this->db->insert('post_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}