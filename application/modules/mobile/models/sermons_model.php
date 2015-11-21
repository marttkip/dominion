<?php

class Sermons_model extends CI_Model 
{

	/*
	*	Update user's last login date
	*
	*/
	public function get_sermons()
	{
		$this->db->where('blog_category_id = 9');
	 	$this->db->order_by('last_modified','DESC');
		$query = $this->db->get('post');
		
		return $query;
	}
	
	public function get_latest_sermon()
	{
		$this->db->where('blog_category_id = 9');
	 	$this->db->order_by('last_modified','DESC');
		$query = $this->db->get('post', 1);
		
		return $query;
	}
	
	public function get_sermons_detail($id)
	{
		$this->db->where('post_id = '.$id);
		$query = $this->db->get('post');
		return $query;
	}

	public function count_unread_sermons()
	{
		$this->db->where('blog_category_id = 5');
	 	$this->db->order_by('last_modified','DESC');
		$query = $this->db->get('post');	

		return $query->num_rows();	
	}

}