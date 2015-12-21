<?php

class Bible_school_model extends CI_Model 
{

	/*
	*	Update user's last login date
	*
	*/
	public function get_bible_school_detail()
	{
		$this->db->where('blog_category_id = 23');
	 	$this->db->order_by('last_modified','DESC');
		$query = $this->db->get('post');
		
		return $query;
	}
	public function get_college_detail($id)
	{
		$this->db->where('post_id = '.$id);
		$query = $this->db->get('post');
		return $query;
	}

}