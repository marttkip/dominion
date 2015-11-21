<?php

class Events_model extends CI_Model 
{

	/*
	*	Update user's last login date
	*
	*/
	public function get_events()
	{
		$this->db->where('event_status = 1');
		$this->db->order_by('created','DESC');
		$query = $this->db->get('event');
		
		return $query;
	}
	public function get_event_detail($id)
	{
		$this->db->where('event_id = '.$id);
		$this->db->order_by('created','DESC');
		$query = $this->db->get('event');
		return $query;

	}

}