<?php

class Comments_model extends CI_Model 
{
	public function add_comment()
	{
		// AND username = "'.$this->input->post('member_no').'"
		$this->db->select('*');
		$this->db->where('member_email = "'.$this->input->post('email').'" AND member_type = 26');
		$query = $this->db->get('member');

		if($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			// do an insert
			$data['post_comment_user'] = $this->input->post('name');
			$data['post_comment_description'] = $this->input->post('comment');
			$data['post_comment_email'] = $this->input->post('email');
			$data['post_id'] = $this->input->post('post_id');
			$data['comment_created'] = date('Y-m-d H:i:s');
			
			if($this->db->insert('post_comment', $data))
			{
				return TRUE;
			} 
			else
			{
				return FALSE;
			}
		}
		
	}
}
?>