<?php session_start();  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Products extends admin 
{
	var $products_path;
	var $products_location;
	var $gallery_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('products_model');
		$this->load->model('categories_model');
		$this->load->model('admin/file_model');
		
		//path to image directory
		$this->products_path = realpath(APPPATH . '../assets/images/products/images');
		$this->products_location = base_url().'assets/images/products/images/';
		$this->gallery_path = realpath(APPPATH . '../assets/images/products/gallery');
	}
    
	/*
	*
	*	Default action is to show all the products
	*
	*/
	public function index() 
	{
		$where = 'product.category_id = category.category_id';
		$table = 'product, category';

		$product_search = $this->session->userdata('product_search');
		
		if(!empty($product_search))
		{
			$where .= $product_search;
		}
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'products/products';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->products_model->get_all_products($table, $where, $config["per_page"], $page);
		
		$data['title'] = $v_data['title'] = 'All Products';
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$v_data['all_categories'] = $this->categories_model->all_categories();

		$data['content'] = $this->load->view('products/all_products', $v_data, true);
		
		$this->load->view('templates/general_page', $data);
	}
	
	public function add_product_images($product_id = NULL)
	{
		//upload product's gallery images
		$resize['width'] = 600;
		$resize['height'] = 800;
		
		if(is_uploaded_file($_FILES['product_image']['tmp_name']))
		{
			$this->load->library('image_lib');
			
			$products_path = $this->products_path;
			/*
				-----------------------------------------------------------------------------------------
				Upload image
				-----------------------------------------------------------------------------------------
			*/
			$response = $this->file_model->upload_file($products_path, 'product_image', $resize);
			if($response['check'])
			{
				$file_name = $response['file_name'];
				$thumb_name = $response['thumb_name'];
			}
		
			else
			{
				$this->session->set_userdata('error_message', $response['error']);
				$break = TRUE;
			}
			
			if(!isset($break))
			{
				if($product_id > 0)
				{
					//Libraries
					$this->load->library('upload');
				
					if($this->products_model->add_images($product_id, $file_name, $thumb_name))
					{
						$this->session->set_userdata('success_message', 'Product image updated successfully');
					}
					
					else
					{
						$this->session->set_userdata('error_message', 'Unable to save main product image');
					}
					
					//gallery images
					$response = $this->file_model->upload_gallery($product_id, $this->gallery_path, $resize);
					
					if($response)
					{
						$this->session->set_userdata('success_message', 'Product images updated successfully');
					}
					
					else
					{
						if(isset($response['upload']))
						{
							$this->session->set_userdata('error_message', $error['upload'][0]);
						}
						else if(isset($response['resize']))
						{
							$this->session->set_userdata('error_message', $error['resize'][0]);
						}
					}

				}
				
				else
				{
					$this->session->set_userdata('error_message', 'Please add a product before adding it\'s images');
				}
			}
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Please select an image first');
		}
		redirect('vendor/add-product/'.$product_id);	
	}
	
	public function add_product_details($product_id)
	{
		//form validation rules
		$this->form_validation->set_rules('product_name', 'Product Name', 'required|xss_clean');
		$this->form_validation->set_rules('product_status', 'Product Status', 'xss_clean');
		$this->form_validation->set_rules('product_buying_price', 'Product Buying Price', 'numeric|xss_clean');
		$this->form_validation->set_rules('product_selling_price', 'Product Selling Price', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('product_description', 'Product Description', 'required|xss_clean');
		$this->form_validation->set_rules('product_balance', 'Product Balance', 'greater_than[0]|required|xss_clean');
		$this->form_validation->set_rules('category_id', 'Product Category', 'required|xss_clean');
		$this->form_validation->set_rules('minimum_order_quantity', 'Minimum Order Quantity', 'numeric|xss_clean');
		$this->form_validation->set_rules('maximum_purchase_quantity', 'Maximum Purchase Quantity', 'numeric|xss_clean');
		$this->form_validation->set_message('exists', 'You have entered a post code that does not exist');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$product_id = $this->products_model->add_product($product_id);
			$this->session->set_userdata('success_message', 'Product updated successfully');
			redirect('products/add-product/'.$product_id);
		}
		
		else
		{
			$this->add_product();
		}
	}
   
	/*
	*
	*	Add a new product
	*
	*/
	public function add_product($product_id = NULL) 
	{
		//open the add new product
		$data['title'] = $v_data['title'] = 'Add product';
		$v_data['product_id'] = $product_id;
		$v_data['all_categories'] = $this->categories_model->all_categories();
		$v_data['all_discount_types'] = $this->products_model->get_discount_types();
		$data['content'] = $this->load->view('products/add_product', $v_data, true);
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Edit an existing product
	*	@param int $product_id
	*
	*/
	public function edit_product($product_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('product_locations[]', 'Surburb', 'xss_clean|exists[surburb.post_code]');
		$this->form_validation->set_rules('product_name', 'Product Name', 'required|xss_clean');
		$this->form_validation->set_rules('product_status', 'Product Status', 'xss_clean');
		$this->form_validation->set_rules('product_buying_price', 'Product Buying Price', 'numeric|xss_clean');
		$this->form_validation->set_rules('product_selling_price', 'Product Selling Price', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('product_description', 'Product Description', 'required|xss_clean');
		$this->form_validation->set_rules('product_balance', 'Product Balance', 'greater_than[0]|required|xss_clean');
		$this->form_validation->set_rules('brand_id', 'Product Brand', 'xss_clean');
		$this->form_validation->set_rules('category_id', 'Product Category', 'required|xss_clean');
		$this->form_validation->set_rules('minimum_order_quantity', 'Minimum Order Quantity', 'numeric|xss_clean');
		$this->form_validation->set_rules('maximum_purchase_quantity', 'Maximum Purchase Quantity', 'numeric|xss_clean');
		$this->form_validation->set_message('exists', 'You have entered a post code that does not exist');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if(is_uploaded_file($_FILES['product_image']['tmp_name']))
			{
				$this->load->library('image_lib');
				
				$products_path = $this->products_path;
				//var_dump($products_path."\\".$this->input->post('current_image'));die();
				
				$image = $this->input->post('current_image');
				
				if(!empty($image))
				{
					//delete original image
					$this->file_model->delete_file($products_path."\\".$this->input->post('current_image'), $products_path);
					
					//delete original thumbnail
					$this->file_model->delete_file($products_path."\\".$this->input->post('current_thumb'), $products_path);
				}
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$resize['width'] = 600;
				$resize['height'] = 800;
				
				$response = $this->file_model->upload_file($products_path, 'product_image', $resize);
				
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					$data['title'] = 'Edit product';
					$query = $this->products_model->get_product($product_id);
					if ($query->num_rows() > 0)
					{
						/*$v_data['all_categories'] = $this->categories_model->all_categories();
						$v_data['all_brands'] = $this->brands_model->all_active_brands();
						$data['content'] = $this->load->view('products/edit_product', $v_data, true);*/
					}
					
					else
					{
						$data['content'] = 'product does not exist';
					}
					
					/*$this->load->view('templates/general_page', $data);
					break;*/
					$break = TRUE;
				}
			}
			
			else{
				$file_name = $this->input->post('current_image');
				$thumb_name = $this->input->post('current_thumb');
			}
			
			
			if(!isset($break))
			{
				//update product
				if($this->products_model->update_product($file_name, $thumb_name, $product_id))
				{
					$resize['width'] = 600;
					$resize['height'] = 800;
					$features_response = $this->products_model->save_features($product_id);
					
					if($features_response)
					{
						$response = $this->file_model->upload_gallery($product_id, $this->gallery_path, $resize);
						
						if($response)
						{
							$this->session->set_userdata('success_message', 'Product updated successfully');
							redirect('vendor/all-products');
						}
						
						else
						{
							$this->session->set_userdata('error_message', 'Could not update gallery. Please try again');
							redirect('vendor/all-products');
						}
					}
						
					else
					{
						$this->session->set_userdata('error_message', 'Could not update features. Please try again');
						redirect('vendor/all-products');
					}
				}
				
				else
				{
					$this->session->set_userdata('error_message', 'Could not update product. Please try again');
					redirect('vendor/all-products');
				}
			}
		}
		
		//open the add new product
		$data['title'] = 'Edit product';
		
		//select the product from the database
		$query = $this->products_model->get_product($product_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['all_categories'] = $this->categories_model->all_categories();
			$v_data['all_brands'] = $this->brands_model->all_active_brands();
			$v_data['features'] = $this->products_model->get_features($product_id);
			$v_data['all_discount_types'] = $this->products_model->get_discount_types();
			$v_data['all_features'] = $this->features_model->all_features();
			$v_data['surburbs_query'] = $this->vendor_model->get_all_surburbs();
			$v_data['gallery_images'] = $this->products_model->get_gallery_images($product_id);
			$v_data['product_locations'] = $this->products_model->get_product_locations($product_id);
			$v_data['product'] = $query->result();
			$data['content'] = $this->load->view('products/edit_product', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'product does not exist';
		}
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Duplicate an existing product
	*	@param int $product_id
	*
	*/
	public function duplicate_product($product_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('product_name', 'Product Name', 'required|xss_clean');
		$this->form_validation->set_rules('product_status', 'Product Status', 'xss_clean');
		$this->form_validation->set_rules('product_buying_price', 'Product Buying Price', 'numeric|xss_clean');
		$this->form_validation->set_rules('product_selling_price', 'Product Selling Price', 'numeric|required|xss_clean');
		$this->form_validation->set_rules('product_description', 'Product Description', 'required|xss_clean');
		$this->form_validation->set_rules('product_balance', 'Product Balance', 'greater_than[0]|required|xss_clean');
		$this->form_validation->set_rules('brand_id', 'Product Brand', 'xss_clean');
		$this->form_validation->set_rules('category_id', 'Product Category', 'required|xss_clean');
		$this->form_validation->set_rules('minimum_order_quantity', 'Minimum Order Quantity', 'numeric|xss_clean');
		$this->form_validation->set_rules('maximum_purchase_quantity', 'Maximum Purchase Quantity', 'numeric|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if(is_uploaded_file($_FILES['product_image']['tmp_name']))
			{
				$this->load->library('image_lib');
				
				$products_path = $this->products_path;
				
				//delete original image
				$this->file_model->delete_file($products_path."\images\\".$this->input->post('current_image'), $products_path);
				
				//delete original thumbnail
				$this->file_model->delete_file($products_path."\images\\".$this->input->post('current_thumb'), $products_path);
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$resize['width'] = 600;
				$resize['height'] = 800;
				
				$response = $this->file_model->upload_file($products_path, 'product_image', $resize);
				
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					$data['title'] = 'Duplicate product';
					$query = $this->products_model->get_product($product_id);
					if ($query->num_rows() > 0)
					{
						/*$v_data['all_categories'] = $this->categories_model->all_categories();
						$v_data['all_brands'] = $this->brands_model->all_active_brands();
						$data['content'] = $this->load->view('products/edit_product', $v_data, true);*/
					}
					
					else
					{
						$data['content'] = 'product does not exist';
					}
					
					/*$this->load->view('templates/general_page', $data);
					break;*/
					$break = TRUE;
				}
			}
			
			else{
				$file_name = $this->input->post('current_image');
				$thumb_name = $this->input->post('current_thumb');
			}
			
			
			if(!isset($break))
			{
				//duplicate product
				$old_product_id = $product_id;
				$product_id = $this->products_model->add_product($file_name, $thumb_name);
				if($product_id > 0)
				{
					//duplicate features
					$this->products_model->duplicate_features($old_product_id, $product_id);
					//duplicate gallery images
					$this->products_model->duplicate_gallery_images($old_product_id, $product_id);
					//duplicate locations
					$this->products_model->duplicate_locations($old_product_id, $product_id);
					
					$resize['width'] = 600;
					$resize['height'] = 800;
					$features_response = $this->products_model->save_features($product_id);
					
					if($features_response)
					{
						$response = $this->file_model->upload_gallery($product_id, $this->gallery_path, $resize);
						
						if($response)
						{
							$this->session->set_userdata('success_message', 'Product duplicated successfully');
							redirect('vendor/all-products');
						}
						
						else
						{
							$this->session->set_userdata('error_message', 'Could not duplicated gallery. Please try again');
							redirect('vendor/all-products');
						}
					}
						
					else
					{
						$this->session->set_userdata('error_message', 'Could not duplicated features. Please try again');
						redirect('vendor/all-products');
					}
				}
				
				else
				{
					$this->session->set_userdata('error_message', 'Could not duplicated product. Please try again');
					redirect('vendor/all-products');
				}
			}
		}
		
		//open the add new product
		$data['title'] = 'Duplicate product';
		
		//select the product from the database
		$query = $this->products_model->get_product($product_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['all_categories'] = $this->categories_model->all_categories();
			$v_data['all_brands'] = $this->brands_model->all_active_brands();
			$v_data['features'] = $this->products_model->get_features($product_id);
			$v_data['gallery_images'] = $this->products_model->get_gallery_images($product_id);
			$v_data['all_discount_types'] = $this->products_model->get_discount_types();
			$v_data['all_features'] = $this->features_model->all_features();
			$v_data['surburbs_query'] = $this->vendor_model->get_all_surburbs();
			$v_data['product_locations'] = $this->products_model->get_product_locations($product_id);
			$v_data['product'] = $query->result();
			$data['content'] = $this->load->view('products/duplicate_product', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'product does not exist';
		}
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing product
	*	@param int $product_id
	*
	*/
	public function delete_product($product_id)
	{
		//delete product image
		$query = $this->products_model->get_product($product_id);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			$image = $result[0]->product_image_name;
			
			//delete image
			$this->file_model->delete_file($this->products_path."\\".$image, $this->products_path);
			//delete thumbnail
			$this->file_model->delete_file($this->products_path."\\thumbnail_".$image, $this->products_path);
		}
		
		//delete gallery images
		$query = $this->products_model->get_gallery_images($product_id);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			foreach($result as $res)
			{
				$image = $res->product_image_name;
				$thumb = $res->product_image_thumb;
				
				//delete image
				$this->file_model->delete_file($this->gallery_path."\\".$image, $this->gallery_path);
				//delete thumbnail
				$this->file_model->delete_file($this->gallery_path."\\".$thumb, $this->gallery_path);
			}
			
			$this->products_model->delete_gallery_images($product_id);
		}
		
		//delete features
		$query = $this->products_model->get_features($product_id);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			foreach($result as $res)
			{
				$image = $res->image;
				$thumb = $res->thumb;
				
				//delete image
				$this->file_model->delete_file($this->features_path."\\".$image, $this->features_path);
				//delete thumbnail
				$this->file_model->delete_file($this->features_path."\\".$thumb, $this->features_path);
			}
			
			$this->products_model->delete_features($product_id);
		}
		
		$this->products_model->delete_product($product_id);
		$this->session->set_userdata('success_message', 'Product has been deleted');
		redirect('vendor/all-products');
	}
    
	/*
	*
	*	Delete an existing product feature
	*	@param int $feature_id
	*
	*/
	public function delete_product_feature($product_id, $product_feature_id, $image = 'None', $thumb = 'None')
	{
		if ($image != 'None')
		{
			//delete image
			$this->file_model->delete_file($this->features_path."\\".$image, $this->features_path);
			//delete thumbnail
			$this->file_model->delete_file($this->features_path."\\".$thumb, $this->features_path);
		}
		
		if($this->products_model->delete_product_features($product_feature_id))
		{
			$this->session->set_userdata('success_message', 'The feature has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to delete the feature. Please try again.');
		}
		redirect('vendor/add-product/'.$product_id);
	}
    
	/*
	*
	*	Activate an existing product
	*	@param int $product_id
	*
	*/
	public function activate_product($product_id)
	{
		$this->products_model->activate_product($product_id);
		$this->session->set_userdata('success_message', 'Product activated successfully');
		redirect('vendor/all-products');
	}
    
	/*
	*
	*	Deactivate an existing product
	*	@param int $product_id
	*
	*/
	public function deactivate_product($product_id)
	{
		$this->products_model->deactivate_product($product_id);
		$this->session->set_userdata('success_message', 'Product disabled successfully');
		redirect('vendor/all-products');
	}
	
	public function upload_images() 
	{
		$this->load->view('upload');
	}
	
	// Upload & Resize in action
    public function do_upload()
    {
		$this->load->library('upload');
		$this->load->library('image_lib');
		
		$resize['width'] = 600;
		$resize['height'] = 800;
		
		$response = $this->file_model->upload_gallery(1, $this->gallery_path, $resize);
        
		if($response)
		{
		   $this->load->view('upload');
		}
		
		else
		{
		   var_dump($response);
		}
    }
	
	/**
	 * Get all the features of a category
	 * Called when adding a new product
	 *
	 * @param int category_id
	 *
	 * @return object
	 *
	 */
	function get_category_features($category_id)
	{
		$data['features'] = $this->features_model->all_features_by_category($category_id);
		
		echo $this->load->view('products/features', $data, TRUE);
	}
    
	/*
	*
	*	Update an existing product feature
	*	@param int $feature_id
	*
	*/
	public function update_feature($product_id, $product_feature_id, $image = 'None', $thumb = 'None')
	{
		$feature_name = $this->input->post('feature_value'.$product_feature_id);
		$feature_quantity = $this->input->post('quantity'.$product_feature_id);
		$feature_price = $this->input->post('price'.$product_feature_id);
		
		//upload product's gallery images
		$resize['width'] = 600;
		$resize['height'] = 800;
		
		if(is_uploaded_file($_FILES['feature_image'.$product_feature_id]['tmp_name']))
		{
			$this->load->library('image_lib');
			
			$features_path = $this->features_path;
			/*
				-----------------------------------------------------------------------------------------
				Upload image
				-----------------------------------------------------------------------------------------
			*/
			$response = $this->file_model->upload_single_dir_file($features_path, 'feature_image'.$product_feature_id, $resize);
			if($response['check'])
			{
				$file_name = $response['file_name'];
				$thumb_name = $response['thumb_name'];
			}
		
			else
			{
				$this->session->set_userdata('error_message', $response['error']);
				redirect('vendor/add-product/'.$product_id);
			}
		}
		
		else
		{
			$file_name = $image;
			$thumb_name = $thumb;
		}
				
		if($this->products_model->update_features($product_feature_id, $product_id, $feature_name, $feature_quantity, $feature_price, $file_name, $thumb_name))
		{
			$this->session->set_userdata('success_message', 'The feature has been updated successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to update the feature at this time. Please try again.');
		}
		
		redirect('vendor/add-product/'.$product_id);
	}
	
	function add_new_feature($category_feature_id, $product_id)
	{
		$feature_name = $this->input->post('sub_feature_name'.$category_feature_id);
		$feature_quantity = $this->input->post('sub_feature_qty'.$category_feature_id);
		$feature_price = $this->input->post('sub_feature_price'.$category_feature_id);
		
		//upload product's gallery images
		$resize['width'] = 600;
		$resize['height'] = 800;
		
		if(is_uploaded_file($_FILES['feature_image'.$category_feature_id]['tmp_name']))
		{
			$this->load->library('image_lib');
			
			$features_path = $this->features_path;
			/*
				-----------------------------------------------------------------------------------------
				Upload image
				-----------------------------------------------------------------------------------------
			*/
			$response = $this->file_model->upload_single_dir_file($features_path, 'feature_image'.$category_feature_id, $resize);
			if($response['check'])
			{
				$file_name = $response['file_name'];
				$thumb_name = $response['thumb_name'];
			}
		
			else
			{
				$this->session->set_userdata('error_message', $response['error']);
				redirect('vendor/add-product/'.$product_id);
			}
		}
		
		else
		{
			$file_name = 'None';
			$thumb_name = 'None';
		}
				
		if($this->products_model->add_new_features($category_feature_id, $product_id, $feature_name, $feature_quantity, $feature_price, $file_name, $thumb_name))
		{
			$this->session->set_userdata('success_message', 'The feature has been added successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to add the feature at this time. Please try again.');
		}
		
		redirect('vendor/add-product/'.$product_id);
	}
	
	function delete_new_feature($category_feature_id, $row)
	{
		$_SESSION['name'.$category_feature_id][$row] = NULL;
		$_SESSION['quantity'.$category_feature_id][$row] = NULL;
		$_SESSION['price'.$category_feature_id][$row] = NULL;
		
		//delete images
		if($_SESSION['image'.$category_feature_id][$row] != 'None')
		{
			$this->file_model->delete_file($this->features_path."\\".$_SESSION['image'.$category_feature_id][$row], $this->features_path);
			$this->file_model->delete_file($this->features_path."\\".$_SESSION['thumb'.$category_feature_id][$row], $this->features_path);
		}
		$_SESSION['image'.$category_feature_id][$row] = NULL;
		$_SESSION['thumb'.$category_feature_id][$row] = NULL;
		
		$feature_values = $this->products_model->fetch_new_category_features($category_feature_id);
		$options = '';
		
		if(isset($feature_values))
		{
			$options .= '
				<table class="table table-condensed table-responsive table-hover table-striped">
					<tr>
						<th></th>
						<th>Sub Feature</th>
						<th>Quantity</th>
						<th>Additional Price</th>
						<th>Image</th>
					</tr>
			'.$feature_values.'</table>
			';
		}
		
		else
		{
			$options .= '<p>You have not added any features</p>';
		}
		echo $options;
	}
	
	public function delete_gallery_image($product_image_id, $product_id, $image_name, $thumb_name)
	{
		if($this->products_model->delete_gallery_image($product_image_id, $image_name, $thumb_name, $this->gallery_path))
		{
			$this->session->set_userdata('success_message', 'Image deleted successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to delete image please try again');
		}
		redirect('vendor/add-product/'.$product_id);
	}
	
	function view_features()
	{
		//session_unset();
		$res = $this->products_model->fetch_new_category_features(1);
		var_dump($_SESSION['image1']);
	}
	
	function export_products()
	{
		//export products in excel 
		 $this->products_model->export_products();
	}
	
	function import_template()
	{
		//export products template in excel 
		 $this->products_model->import_template();
	}
	
	function import_categories()
	{
		//export product categories in excel 
		$this->products_model->import_categories();
	}
	
	function import_products()
	{
		//open the add new product
		$v_data['title'] = 'Import Products';
		$data['title'] = 'Import Products';
		$data['content'] = $this->load->view('products/import_product', $v_data, true);
		$this->load->view('templates/general_page', $data);
	}
	
	function do_products_import()
	{
		if(isset($_FILES['import_csv']))
		{
			if(is_uploaded_file($_FILES['import_csv']['tmp_name']))
			{
				//import products from excel 
				$response = $this->products_model->import_csv_products($this->csv_path);
				
				if($response == FALSE)
				{
				}
				
				else
				{
					if($response['check'])
					{
						$v_data['import_response'] = $response['response'];
					}
					
					else
					{
						$v_data['import_response_error'] = $response['response'];
					}
				}
			}
			
			else
			{
				$v_data['import_response_error'] = 'Please select a file to import.';
			}
		}
		
		else
		{
			$v_data['import_response_error'] = 'Please select a file to import.';
		}
		
		//open the add new product
		$v_data['title'] = 'Import Products';
		$data['title'] = 'Import Products';
		$data['content'] = $this->load->view('products/import_product', $v_data, true);
		$this->load->view('templates/general_page', $data);
	}
	
	public function check_export()
	{
		$this->load->dbutil();
				
		$query = $this->db->query("SELECT product.clicks, product.minimum_order_quantity, product.maximum_purchase_quantity, product.sale_price, product.featured, product.product_id, product.product_name, product.product_buying_price, product.product_selling_price, product.product_status, product.product_description, product.product_code, product.product_balance, product.brand_id, product.category_id, product.created, product.created_by, product.last_modified, product.modified_by, product.product_thumb_name, product.product_image_name, category.category_name, brand.brand_name FROM product, category, brand WHERE product.category_id = category.category_id AND product.brand_id = brand.brand_id AND product.created_by = ".$this->session->userdata('vendor_id'));
		
		echo $this->dbutil->csv_from_result($query);
	}
	public function search_products()
	{
		$product_name = $this->input->post('product_name');
		$product_code = $this->input->post('product_code');
		$category_id = $this->input->post('category_id');
		$brand_id = $this->input->post('brand_id');


		if(!empty($product_name))
		{
			$product_name = ' AND product.product_name LIKE \'%'.mysql_real_escape_string($product_name).'%\' ';
		}
		
		if(!empty($product_code))
		{
			$product_code = ' AND product.product_code LIKE \'%'.mysql_real_escape_string($product_code).'%\' ';
		}

		if(!empty($brand_id))
		{
			$brand_id = ' AND product.brand_id = '.$brand_id.'';
		}
		else
		{
			$brand_id = '';
		}
		if(!empty($category_id))
		{
			$category_id = ' AND product.category_id = '.$category_id.'';
		}
		else
		{
			$category_id = '';
		}
		$search = $product_name.$product_code.$brand_id.$category_id;
		$this->session->set_userdata('product_search', $search);
		
		$this->index();
	}
	public function close_product_search($page = NULL)
	{
		$this->session->unset_userdata('product_search');
		redirect('vendor/all-products');
	}



	/*
	*
	*	Default action is to show all the product bundle
	*
	*/
	public function all_product_bundles() 
	{
		$where = 'product_bundle.created_by = '.$this->session->userdata('vendor_id');
		$table = 'product_bundle';

		$product_bundle_search = $this->session->userdata('product_bundle_search');
		
		if(!empty($product_bundle_search))
		{
			$where .= $product_bundle_search;
		}
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'vendor/all-product-bundle';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->products_model->get_all_product_bundle($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('products/all_product_bundle', $v_data, true);
		}
		
		else
		{
			$search = $this->session->userdata('product_bundle_search');
			$search_result = '';
			if(!empty($search))
			{
				$search_result = '<a href="'.site_url().'vendor/close-product-bundle-search" class="btn btn-success">Close Search</a>';
			}

			$data['content'] = '
								<div class="row" style="margin-bottom:8px;">
									<div class="pull-left">
									'.$search_result.'
									</div>
				            		<div class="pull-right">
											<a href="'.site_url().'vendor/add-product-bundle" class="btn btn-success ">Add Product bundle</a>
									
									</div>
								</div>';
		}
		$data['title'] = 'All Product Bundles';
		
		$this->load->view('templates/general_page', $data);
	}

	/*
	*
	*	Add a new product
	*
	*/
	public function add_product_bundle() 
	{
		//form validation rules
		$this->form_validation->set_rules('product_bundle_name', 'Product Bundle Name', 'required|xss_clean');
		$this->form_validation->set_rules('product_bundle_status', 'Product Bundle Status', 'xss_clean');
		$this->form_validation->set_rules('product_bundle_price', 'Product Bundle Price', 'xss_clean');
		$this->form_validation->set_rules('product_bundle_description', 'Product Bundle Description', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//upload product's gallery images
			$resize['width'] = 600;
			$resize['height'] = 800;
			
			if(is_uploaded_file($_FILES['product_bundle_image']['tmp_name']))
			{
				$this->load->library('image_lib');
				
				$product_bundle_path = $this->product_bundle_path;
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($product_bundle_path, 'product_bundle_image', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					/*$data['title'] = 'Add New User';
					$v_data['all_categories'] = $this->categories_model->all_categories();
					$v_data['all_brands'] = $this->brands_model->all_active_brands();
					$v_data['features'] = $this->features_model->all_features_by_category(0);
					$data['content'] = $this->load->view('products/add_product', $v_data, true);
					$this->load->view('templates/general_page', $data);*/
					//break;
					$break = TRUE;
				}
			}
			
			else{
				$file_name = '';
				$thumb_name = '';
			}
			
			if(!isset($break))
			{
			
				$product_bundle_id = $this->products_model->add_product_bundle($file_name, $thumb_name);
				
				if($product_bundle_id > 0)
				{
					//Libraries
					$this->load->library('upload');
					
					
					$response = $this->file_model->upload_gallery($product_bundle_id, $this->gallery_bundle_path, $resize);
					
					if($response)
					{
						$this->session->set_userdata('success_message', 'Product bundle added successfully');
						redirect('vendor/all-product-bundle');
					}
					
					else
					{
						if(isset($response['upload']))
						{
							$this->session->set_userdata('error_message', $error['upload'][0]);
						}
						else if(isset($response['resize']))
						{
							$this->session->set_userdata('error_message', $error['resize'][0]);
						}
						redirect('vendor/all-product-bundle');
					}
					
				}
				
				else
				{
					$this->session->set_userdata('error_message', 'Could not add product. Please try again');
				}
			}
		}
		
		//open the add new product
		$data['title'] = 'Add New product bundle';
		$data['content'] = $this->load->view('products/add_product_bundle', '' , true);
		$this->load->view('templates/general_page', $data);
	}

	public function add_product_bundle_items($bundle_id)
	{
		$where = 'product_bundle.product_bundle_id = product_bundle_item.product_bundle_id AND product_bundle.product_bundle_id = '.$bundle_id.' AND product_bundle.created_by = '.$this->session->userdata('vendor_id').' AND product.product_id = product_bundle_item.product_id AND product.category_id = category.category_id AND product.brand_id = brand.brand_id AND product.created_by = '.$this->session->userdata('vendor_id');
		$table = 'product_bundle_item, product_bundle,brand, category, product';

		$product_bundle_search = $this->session->userdata('product_bundle_search');
		
		if(!empty($product_bundle_search))
		{
			$where .= $product_bundle_search;
		}
		$segment = 4;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'vendor/all-product-bundle/'.$bundle_id;
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->products_model->get_all_product_bundle_items($table, $where, $config["per_page"], $page);
		
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$v_data['all_categories'] = $this->categories_model->all_categories();
		$v_data['all_brands'] = $this->brands_model->all_active_brands();
		$v_data['features'] = $this->features_model->all_features_by_category(0);
		$v_data['bundle_query'] = $this->products_model->get_product_bundle_details($bundle_id);
		$v_data['bundle_id'] = $bundle_id;
		$data['content'] = $this->load->view('products/all_product_bundle_items', $v_data, true);
		
		
		
		$data['title'] = 'Product Bundles Items';
		
		$this->load->view('templates/general_page', $data);
	}

	public function search_product_to_bundles($bundle_id)
	{
		$product_name = $this->input->post('product_name');
		$product_code = $this->input->post('product_code');
		$category_id = $this->input->post('category_id');
		$brand_id = $this->input->post('brand_id');


		if(!empty($product_name))
		{
			$product_name = ' AND product.product_name LIKE \'%'.mysql_real_escape_string($product_name).'%\' ';
		}
		
		if(!empty($product_code))
		{
			$product_code = ' AND product.product_code LIKE \'%'.mysql_real_escape_string($product_code).'%\' ';
		}

		if(!empty($brand_id))
		{
			$brand_id = ' AND product.brand_id = '.$brand_id.'';
		}
		else
		{
			$brand_id = '';
		}
		if(!empty($category_id))
		{
			$category_id = ' AND product.category_id = '.$category_id.'';
		}
		else
		{
			$category_id = '';
		}
		$search = $product_name.$product_code.$brand_id.$category_id;
		$this->session->set_userdata('product_to_bundle_search', $search);
		
		$this->add_product_bundle_items($bundle_id);
	}
	public function close_product_to_bundle_search($bundle_id)
	{
		$this->session->unset_userdata('product_to_bundle_search');
		redirect('vendor/add-product-bundle-items/'.$bundle_id);
	}
	public function add_product_to_bundle($product_id,$bundle_id)
	{
		if(empty($product_id) || empty($bundle_id))
		{
			$this->session->set_userdata('error_message', 'Could not add product to bundle. Please try again');
		}
		else
		{
			$checker = $this->products_model->check_product_if_exists_in_bundle($product_id,$bundle_id);
			if($checker == TRUE)
			{
				$this->session->set_userdata('error_message', 'This product exist in this bundle');
			}
			else
			{
				$this->products_model->add_product_to_bundle($product_id,$bundle_id);
				redirect('vendor/add-product-bundle-items/'.$bundle_id);	
			}
			
		}
	}
	/*
	*
	*	Activate an existing product
	*	@param int $product_id
	*
	*/
	public function activate_product_from_bundle($product_bundle_item_id,$bundle_id)
	{
		$this->products_model->activate_product_from_bundle($product_bundle_item_id);
		$this->session->set_userdata('success_message', 'Product activated in bundle successfully');
		redirect('vendor/add-product-bundle-items/'.$bundle_id);	
	}
    
	/*
	*
	*	Deactivate an existing product
	*	@param int $product_id
	*
	*/
	public function deactivate_product_from_bundle($product_bundle_item_id,$bundle_id)
	{
		$this->products_model->deactivate_product_from_bundle($product_bundle_item_id);
		$this->session->set_userdata('success_message', 'Product disabled from bundle successfully');
		redirect('vendor/add-product-bundle-items/'.$bundle_id);	
	}

	/*
	*
	*	Search a feature
	*	@param int $feature name 
	*
	*/
	public function search_product_bundles()
	{

		$product_bundle_name = $this->input->post('product_bundle_name');


		if(!empty($product_bundle_name))
		{
			$product_bundle_name = ' AND product_bundle.product_bundle_name LIKE \'%'.mysql_real_escape_string($product_bundle_name).'%\' ';
		}
		
		
		
		$search = $product_bundle_name;
		$this->session->set_userdata('product_bundle_search', $search);
		
		$this->all_product_bundles();
		
	}
	/*
	*
	*	Close feature search
	*	@param int $feature_id
	*
	*/
	public function close_product_bundles_search()
	{
		$this->session->unset_userdata('product_bundle_search');
		redirect('vendor/all-product-bundle');
	}
	public function product_review()
	{
		$where = 'product.product_id = product_review.product_id';
		$table = 'product_review, product';
		$product_review_search = $this->session->userdata('product_review_search');
		
		if(!empty($product_review_search))
		{
			$where .= $product_review_search;
		}
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'vendor/all-product-reviews';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = 2;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->products_model->get_all_product_review($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('products/product_review.php', $v_data, true);
		}
		
		else
		{
			$data['content'] = '';
		}
		$data['title'] = 'All reviews';
		
		$this->load->view('templates/general_page', $data);
	}
	/*
	*
	*	Activate product review
	*	@param int $order_id
	*
	*/
	public function activate_review($product_review_id)
	{
		$data = array(
					'product_review_status'=>1
				);
				
		$this->db->where('product_review_id = '.$product_review_id);
		$this->db->update('product_review', $data);
		
		redirect('vendor/all-product-reviews');
	}
	/*
	*
	*	Activate product review
	*	@param int $order_id
	*
	*/
	public function deactivate_review($product_review_id)
	{
		$data = array(
					'product_review_status'=>2
				);
				
		$this->db->where('product_review_id = '.$product_review_id);
		$this->db->update('product_review', $data);
		
		redirect('vendor/all-product-reviews');
	}
	
	public function activate_pick_up($product_id)
	{
		if($product_id > 0)
		{
			if($this->products_model->update_shipping_method($product_id, 3))
			{
				$this->session->set_userdata('success_message', 'Pick up added to product');
			}
			else
			{
				$this->session->set_userdata('error_message', 'Pick up could not be added to product');
			}
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Please add a product before updating it\'s shipping');
		}
		
		redirect('vendor/add-product/'.$product_id);
	}
	
	public function add_fixed_rate($product_id)
	{
		if($product_id > 0)
		{
			$this->form_validation->set_rules('product_fixed_rate', 'Rate', 'required|greater_than[0]|xss_clean');
			
			//if form has been submitted
			if ($this->form_validation->run())
			{
				$this->products_model->add_fixed_rate($product_id);
				$this->session->set_userdata('success_message', 'Fixed rate added to product');
				redirect('vendor/add-product/'.$product_id);
			}
			
			else
			{
				$this->add_product($product_id);
			}
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Please add a product before updating it\'s shipping');
			redirect('vendor/add-product/'.$product_id);
		}
	}
	
	public function add_product_shipping($product_id)
	{
		if($product_id > 0)
		{
			$this->form_validation->set_rules('product_width', 'Width', 'required|greater_than[0]|xss_clean');
			$this->form_validation->set_rules('product_height', 'Height', 'required|greater_than[0]|xss_clean');
			$this->form_validation->set_rules('product_length', 'Length', 'required|greater_than[0]|xss_clean');
			$this->form_validation->set_rules('product_weight', 'Weight', 'required|greater_than[0]|xss_clean');
			
			//if form has been submitted
			if ($this->form_validation->run())
			{
				$this->products_model->add_product_shipping($product_id);
				$this->session->set_userdata('success_message', 'Auspost added to product');
				redirect('vendor/add-product/'.$product_id);
			}
			
			else
			{
				$this->add_product($product_id);
			}
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Please add a product before updating it\'s shipping dimensions');
			redirect('vendor/add-product/'.$product_id);
		}
	}
}
?>