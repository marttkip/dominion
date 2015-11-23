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

}