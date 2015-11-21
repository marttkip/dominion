<?php

class Arms_model extends CI_Model 
{

	/*
	*	Update user's last login date
	*
	*/
	public function get_arms()
	{
		$this->db->where('blog_category_id = 16');
	 	$this->db->order_by('last_modified','ASC');
		$query = $this->db->get('post');
		
		return $query;
	}
	
	public function get_arms_detail($id)
	{
		$this->db->where('post_id = '.$id);
		$query = $this->db->get('post');
		return $query;
	}
	
	public function get_arms_news_items($category_id)
	{
		$this->db->where('blog_category_id = '.$category_id);
	 	$this->db->order_by('last_modified','DESC');
		$query = $this->db->get('post');
		
		return $query;
	}
	public function get_arms_events_items($category_id)
	{
		$this->db->where('blog_category_id = '.$category_id);
	 	$this->db->order_by('last_modified','DESC');
		$query = $this->db->get('post');
		
		return $query;
	}
	public function count_unread_arms()
	{
		$this->db->where('blog_category_id = 16');
	 	$this->db->order_by('last_modified','DESC');
		$query = $this->db->get('post');	

		return $query->num_rows();	
	}

}