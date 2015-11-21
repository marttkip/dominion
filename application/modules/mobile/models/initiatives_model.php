<?php
class Initiatives_model extends CI_Model 
{

	/*
	*	Update user's last login date
	*
	*/
	public function get_initiatives($category_id)
	{
		$this->db->where('post_status = 1 AND blog_category_id = '.$category_id);
	 	$this->db->order_by('last_modified','DESC');
		$query = $this->db->get('post');
		
		return $query;
	}
	
	public function get_initiative_detail($id)
	{
		$this->db->where('post_id = '.$id);
		$query = $this->db->get('post');
		return $query;
	}

	public function count_initiative_news()
	{
		$this->db->where('blog_category_id = '.$category_id);
	 	$this->db->order_by('last_modified','DESC');
		$query = $this->db->get('post');	

		return $query->num_rows();	
	}


}
?>