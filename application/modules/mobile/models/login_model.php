<?php

class Login_model extends CI_Model 
{
	/*
	*	Check if member has logged in
	*
	*/
	public function check_member_login()
	{
		if($this->session->userdata('member_login_status'))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	

	public function register_young_profession_details()
	{
		// AND username = "'.$this->input->post('member_no').'"
		$this->db->select('*');
		$this->db->where('member_email = "'.$this->input->post('email').'"');
		$query = $this->db->get('member');

		if($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			// do an insert

			$data['member_email'] = $this->input->post('email');
			$data['member_name'] = $this->input->post('name');
			$data['member_profession'] = $this->input->post('leadership_profession');
			$data['member_college'] = $this->input->post('college');
			$data['member_professional_body'] = $this->input->post('professional_body');
			$data['member_country'] = $this->input->post('county');
			$data['member_address'] = $this->input->post('address');
			$data['member_city'] = $this->input->post('city');
			$data['member_country'] = $this->input->post('country');
			$data['member_type'] = 2;
			if($this->db->insert('member', $data))
			{
				return TRUE;
			} 
			else
			{
				return FALSE;
			}
		}
		
	}
	public function register_influencer_details()
	{
		// AND username = "'.$this->input->post('member_no').'"
		$this->db->select('*');
		$this->db->where('member_email = "'.$this->input->post('email').'"');
		$query = $this->db->get('member');

		if($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			// do an insert

			$data['member_email'] = $this->input->post('email');
			$data['member_name'] = $this->input->post('name');
			$data['member_profession'] = $this->input->post('leadership_profession');
			$data['member_college'] = $this->input->post('college');
			$data['member_professional_body'] = $this->input->post('professional_body');
			$data['member_country'] = $this->input->post('county');
			$data['member_address'] = $this->input->post('address');
			$data['member_city'] = $this->input->post('city');
			$data['member_country'] = $this->input->post('country');
			$data['member_type'] = 1;
			if($this->db->insert('member', $data))
			{
				return TRUE;
			} 
			else
			{
				return FALSE;
			}
		}
		
	}
	public function register_investor_details()
	{
		// AND username = "'.$this->input->post('member_no').'"
		$this->db->select('*');
		$this->db->where('member_email = "'.$this->input->post('email').'"');
		$query = $this->db->get('member');

		if($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			// do an insert

			$data['member_email'] = $this->input->post('email');
			$data['member_name'] = $this->input->post('name');
			$data['member_profession'] = $this->input->post('leadership_profession');
			$data['member_college'] = $this->input->post('college');
			$data['member_professional_body'] = $this->input->post('professional_body');
			$data['member_country'] = $this->input->post('county');
			$data['member_address'] = $this->input->post('address');
			$data['member_city'] = $this->input->post('city');
			$data['member_country'] = $this->input->post('country');
			$data['member_type'] = 3;
			if($this->db->insert('member', $data))
			{
				return TRUE;
			} 
			else
			{
				return FALSE;
			}
		}
		
	}
	public function generateRandomString($email,$length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString.md5($email);
	}
}
?>