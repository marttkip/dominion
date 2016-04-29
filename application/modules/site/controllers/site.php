<?php 
/*
	This module loads the head, header, footer &/or Social media sections.
*/
class Site extends CI_Controller 
{	
	var $slideshow_location;
	var $service_location;
	var $gallery_location;
	
	function __construct() 
	{
		parent:: __construct();
		
		$this->load->model('site_model');
		$this->load->model('admin/blog_model');
		$this->load->model('admin/gallery_model');
		$this->load->model('admin/users_model');
		$this->load->model('site/departments_model');
		$this->load->model('admin/event_model');
		
		$this->slideshow_location = base_url().'assets/slideshow/';
		$this->service_location = base_url().'assets/service/';
		$this->gallery_location = base_url().'assets/gallery/';
		$this->event_location = base_url().'assets/event/';
  	}
	
	public function index()
	{
		redirect('home');
	}
	
	function home_page()
	{
		//Retrieve active slides
		$data['company_details'] = $this->site_model->get_contacts();
		$data['slides'] = $this->site_model->get_slides();
		$data['latest_posts'] = $this->blog_model->get_recent_posts(3);
		$data['latest_post'] = $this->blog_model->get_recent_posts(1);
		$data['departments'] = $this->site_model->get_departments();
		$data['gallery_departments'] = $this->site_model->get_gallery_departments();
		$data['gallery'] = $this->site_model->get_gallery(5);
		$data['academic_courses'] = $this->site_model->get_active_departments('Academic Courses');
		$data['events'] = $this->event_model->get_active_events(10);
		$data['initiatives'] = $this->event_model->get_initiatives(3);
		$data['latest_sermons'] = $this->event_model->get_latest_sermons();
		$data['event_location'] = $this->event_location;
		
		$data['slideshow_location'] = $this->slideshow_location;
		$data['service_location'] = $this->service_location;
		$data['gallery_location'] = $this->gallery_location;
		
		$v_data['title'] = 'Home';

		$v_data['content'] = $this->load->view("home", $data, TRUE);
		
		$this->load->view("includes/templates/general", $v_data);
	}
	
	public function about()
	{
		$data['title'] = 'About us';
		$v_data['title'] = 'About us';
		$data['company_details'] = $this->site_model->get_contacts();
		$v_data['content'] = $this->load->view('about', $data, true);
		
		$this->load->view("includes/templates/general", $v_data);
	}

	public function about_item($web_name)
	{
		$post_title = $this->site_model->decode_web_name($web_name);
		// var_dump($post_title);
		$service_id = $this->site_model->get_service_id($post_title);
// var_dump($service_id);
		$query = $this->site_model->get_service_details($service_id);
		
		
		$v_data['query'] = $query;
		$v_data['page_title'] = 'About Us';
		$data['content'] = $this->load->view('about_us/about_item', $v_data, true);
		
		$data['title'] = 'About Us';
		
		$this->load->view("includes/templates/general", $data);
	}
	public function academic_courses_item($web_name)
	{
		$post_title = $this->site_model->decode_web_name($web_name);
		// var_dump($post_title);
		$service_id = $this->site_model->get_service_id($post_title);
// var_dump($service_id);
		$query = $this->site_model->get_service_details($service_id);
		
		
		$v_data['query'] = $query;
		$v_data['page_title'] = 'Academic Courses';
		$data['content'] = $this->load->view('about_us/about_item', $v_data, true);
		
		$data['title'] = 'Academic Courses';
		
		$this->load->view("includes/templates/general", $data);
	}
	public function student_affairs_item($web_name)
	{
		$post_title = $this->site_model->decode_web_name($web_name);
		// var_dump($post_title);
		$service_id = $this->site_model->get_service_id($post_title);
// var_dump($service_id);
		$query = $this->site_model->get_service_details($service_id);
		
		
		$v_data['query'] = $query;
		$v_data['page_title'] = 'Academic Courses';
		$data['content'] = $this->load->view('about_us/about_item', $v_data, true);
		
		$data['title'] = 'Academic Courses';
		
		$this->load->view("includes/templates/general", $data);
	}
	
	public function services($department_web_name = NULL)
	{
  		$table = "service, department";
		$where = "service.service_status = 1 AND service.department_id = department.department_id";
		
		if($department_web_name != NULL)
		{
			$department_name = $this->site_model->decode_web_name($department_web_name);
			$where .= ' AND department.department_name = \''.$department_name.'\'';
			$data['services'] = $this->site_model->get_services($table, $where, NULL);
		}
		
		else
		{
			$data['services'] = $this->site_model->get_services($table, $where, 12);
		}
		$data['service_location'] = $this->service_location;
		
		$data['title'] = 'Services';
		$v_data['title'] = 'Services';
		$v_data['class'] = '';
		$v_data['content'] = $this->load->view("services", $data, TRUE);
		
		$this->load->view("includes/templates/general", $v_data);
	}
	
	public function view_service($web_name)
	{
		$service_name = $this->site_model->decode_web_name($web_name);
		
		if($service_name)
		{
			$query = $this->site_model->get_service($service_name);
	
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$service_name = $row->service_name;
				}
				$data['title'] = $service_name;
				$v_data['title'] = $service_name;
				$v_data['row'] = $query->row();
				$data['content'] = $this->load->view('single_service', $v_data, true);
			}
			
			else
			{
				$data['title'] = 'Services';
				$v_data['title'] = 'Services';
				$data['content'] = 'Service not found';
			}
		}
		
		else
		{
			$data['title'] = 'Services';
			$v_data['title'] = 'Services';
			$data['content'] = 'Service not found';
		}
		
		$this->load->view("includes/templates/general", $data);
	}
	
	public function contact()
	{
		$data['contacts'] = $this->site_model->get_contacts();
		
		$v_data['title'] = 'Contact us';
		$v_data['class'] = '';
		$v_data['content'] = $this->load->view("contacts", $data, TRUE);
		
		$this->load->view("includes/templates/general", $v_data);
	}
    
	public function gallery() 
	{
		
		$v_data['gallery_departments'] = $this->site_model->get_gallery_departments();
		$v_data['title'] ='Gallery';
		$v_data['gallery_location'] =	$this->gallery_location;

		$data['content'] = $this->load->view('gallery', $v_data, true);
		
		$data['title'] = 'Gallery';
		$this->load->view("includes/templates/general", $data);
	}
	
	public function departments() 
	{
		$where = 'department_status = 1';
		$segment = 2;
		$base_url = base_url().'departments';
		
		$table = 'department';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<div class="wp-pagenavi">';
		$config['full_tag_close'] = '</div>';
		
		$config['next_link'] = 'Next';
		
		$config['prev_link'] = 'Prev';
		
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$query = $this->departments_model->get_all_departments($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['title'] = 'Departments';
			$data['content'] = $this->load->view('departments/department_list', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<p>There are no departments posted yet</p>';
		}
		$data['title'] = 'Departments';
		$this->load->view("includes/templates/general", $data);
	}
	public function events()
	{
		$data['events'] = $this->event_model->get_active_events();
		$data['event_location'] = $this->event_location;
		
		$v_data['title'] = 'Events';
		$v_data['class'] = '';
		$v_data['content'] = $this->load->view("events", $data, TRUE);
		
		$this->load->view("includes/templates/general", $v_data);
	}
	
	public function view_event($web_name)
	{
		$event_name = $this->site_model->decode_web_name($web_name);
		$event_id = $this->event_model->get_event_id($event_name);
		
		if($event_id)
		{
			$query = $this->event_model->get_event($event_id);
			
			if ($query->num_rows() > 0)
			{
				$v_data['row'] = $query->row();
				$data['content'] = $this->load->view('single_event', $v_data, true);
			$data['title'] = 'Events';
			}
			
			else
			{
				$data['content'] = 'Event not found';
				$data['title'] = 'No active events are available';
			}
		}
			
		else
		{
			$data['content'] = 'Event not found';
			$data['title'] = 'No active events are available';
		}
		
		//$this->load->view('blog/templates/new_post', $data);
		
		$this->load->view("site/includes/templates/general", $data);
	}
}