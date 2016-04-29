<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "site";
$route['404_override'] = '';

/*
*	Site Routes
*/
$route['home'] = 'site/home_page';
$route['about'] = 'site/about';
$route['services'] = 'site/services';
$route['services/(:any)/(:any)'] = 'site/view_service/$2';
$route['services/(:any)'] = 'site/services/$1';
$route['loans'] = 'site/loans';
$route['blog'] = 'site/blog';
$route['contact-us'] = 'site/contact';

/*
*	Auth Routes
*/
$route['login'] = 'auth/login_user';
$route['logout-admin'] = 'auth/logout';

/*
*	Admin Routes
*/
$route['dashboard'] = 'admin/dashboard';
$route['website/slideshow'] = 'admin/slideshow/index';
$route['website/gallery'] = 'admin/gallery/index';
$route['administration/all-slides'] = 'admin/slideshow/index';
$route['administration/all-slides/(:num)'] = 'admin/slideshow/index/$1';//with a page number
$route['administration/add-slide'] = 'admin/slideshow/add_slide';
$route['administration/edit-slide/(:num)/(:num)'] = 'admin/slideshow/edit_slide/$1/$2';
$route['administration/activate-slide/(:num)/(:num)'] = 'admin/slideshow/activate_slide/$1/$2';
$route['administration/deactivate-slide/(:num)/(:num)'] = 'admin/slideshow/deactivate_slide/$1/$2';
$route['administration/delete-slide/(:num)/(:num)'] = 'admin/slideshow/delete_slide/$1/$2';
$route['administration/all-gallery-images'] = 'admin/gallery/index';
$route['administration/all-gallery-images/(:num)'] = 'admin/gallery/index/$1';//with a page number
$route['administration/add-gallery'] = 'admin/gallery/add_gallery';
$route['administration/edit-gallery/(:num)/(:num)'] = 'admin/gallery/edit_gallery/$1/$2';
$route['administration/activate-gallery/(:num)/(:num)'] = 'admin/gallery/activate_gallery/$1/$2';
$route['administration/deactivate-gallery/(:num)/(:num)'] = 'admin/gallery/deactivate_gallery/$1/$2';
$route['administration/delete-gallery/(:num)/(:num)'] = 'admin/gallery/delete_gallery/$1/$2';

/*
*	administration Routes
*/
$route['administration/configuration'] = 'admin/configuration';
$route['administration/edit-configuration/(:num)'] = 'admin/edit_configuration/$1';
$route['administration/sections'] = 'admin/sections/index';
$route['administration/sections/(:any)/(:any)/(:num)'] = 'admin/sections/index/$1/$2/$3';
$route['administration/add-section'] = 'admin/sections/add_section';
$route['administration/edit-section/(:num)'] = 'admin/sections/edit_section/$1';

$route['administration/edit-section/(:num)/(:num)'] = 'admin/sections/edit_section/$1/$2';
$route['administration/delete-section/(:num)'] = 'admin/sections/delete_section/$1';
$route['administration/delete-section/(:num)/(:num)'] = 'admin/sections/delete_section/$1/$2';
$route['administration/activate-section/(:num)'] = 'admin/sections/activate_section/$1';
$route['administration/activate-section/(:num)/(:num)'] = 'admin/sections/activate_section/$1/$2';
$route['administration/deactivate-section/(:num)'] = 'admin/sections/deactivate_section/$1';
$route['administration/deactivate-section/(:num)/(:num)'] = 'admin/sections/deactivate_section/$1/$2';

$route['administration/company-profile'] = 'admin/contacts/show_contacts';

/*
*	events Routes
*/
$route['events'] = 'admin/events/index';
$route['events/(:num)'] = 'admin/events/index/event_start_time/DESC/$1';
$route['events/add-event'] = 'admin/events/add_event';
$route['events/edit-event/(:num)/(:num)'] = 'admin/events/edit_event/$1/$2';
$route['events/delete-event/(:num)/(:num)'] = 'admin/events/delete_event/$1/$2';
$route['events/activate-event/(:num)/(:num)'] = 'admin/events/events/activate_event/$1/$2';
$route['events/deactivate-event/(:num)/(:num)'] = 'admin/events/events/deactivate_event/$1/$2';

$route['events/(:any)/(:any)/(:num)'] = 'admin/events/index/$1/$2/$3';
$route['events/(:any)/(:any)'] = 'admin/events/index/$1/$2';

/*
*	Admin Blog Routes
*/
$route['blog/categories'] = 'admin/blog/categories';
$route['blog/posts/(:num)'] = 'admin/blog/index/$1';
$route['blog/posts'] = 'admin/blog/index';
$route['add-post'] = 'admin/blog/add_post';
$route['edit-post/(:num)'] = 'admin/blog/edit_post/$1';
$route['delete-post/(:num)'] = 'admin/blog/delete_post/$1';
$route['activate-post/(:num)'] = 'admin/blog/activate_post/$1';
$route['deactivate-post/(:num)'] = 'admin/blog/deactivate_post/$1';
$route['comments/(:num)'] = 'admin/blog/comments/$1';
$route['blog/comments/(:num)'] = 'admin/blog/comments/__/$1';
$route['blog/comments'] = 'admin/blog/comments';
$route['add-comment/(:num)'] = 'admin/blog/add_comment/$1';
$route['delete-comment/(:num)/(:num)'] = 'admin/blog/delete_comment/$1/$2';
$route['activate-comment/(:num)/(:num)'] = 'admin/blog/activate_comment/$1/$2';
$route['deactivate-comment/(:num)/(:num)'] = 'admin/blog/deactivate_comment/$1/$2';
$route['add-blog-category'] = 'admin/blog/add_blog_category';
$route['edit-blog-category/(:num)'] = 'admin/blog/edit_blog_category/$1';
$route['delete-blog-category/(:num)'] = 'admin/blog/delete_blog_category/$1';
$route['activate-blog-category/(:num)'] = 'admin/blog/activate_blog_category/$1';
$route['deactivate-blog-category/(:num)'] = 'admin/blog/deactivate_blog_category/$1';
$route['delete-comment/(:num)'] = 'admin/blog/delete_comment/$1';
$route['activate-comment/(:num)'] = 'admin/blog/activate_comment/$1';
$route['deactivate-comment/(:num)'] = 'admin/blog/deactivate_comment/$1';
$route['blog-categories'] = 'admin/blog/categories';


/*
*	Categories Routes
*/
$route['products/categories'] = 'admin/categories/index';
$route['products/categories/(:num)'] = 'admin/categories/index/$1';
$route['admin/add-category'] = 'admin/categories/add_category';
$route['admin/edit-category/(:num)'] = 'admin/categories/edit_category/$1';
$route['admin/edit-category/(:num)/(:num)'] = 'admin/categories/edit_category/$1/$2';
$route['admin/delete-category/(:num)'] = 'admin/categories/delete_category/$1';
$route['admin/delete-category/(:num)/(:num)'] = 'admin/categories/delete_category/$1/$2';
$route['admin/activate-category/(:num)'] = 'admin/categories/activate_category/$1';
$route['admin/activate-category/(:num)/(:num)'] = 'admin/categories/activate_category/$1/$2';
$route['admin/deactivate-category/(:num)'] = 'admin/categories/deactivate_category/$1';
$route['admin/deactivate-category/(:num)/(:num)'] = 'admin/categories/deactivate_category/$1/$2';

$route['products/categorie/(:any)/(:any)/(:num)'] = 'admin/categories/index/$1/$2/$3';
$route['products/categorie/(:any)/(:any)'] = 'admin/events/categories/$1/$2';

/*
*	Products Routes
*/
$route['products/products'] = 'admin/products/index';
$route['products/products/(:num)'] = 'admin/products/index/$1';
$route['products/search-products'] = 'admin/products/search_products';
$route['products/close-product-search'] = 'admin/products/close_product_search';
$route['products/add-product'] = 'admin/products/add_product';
$route['products/add-product/(:num)'] = 'admin/products/add_product/$1';
$route['products/export-product'] = 'admin/products/export_products';
$route['products/import-product'] = 'admin/products/import_products';
$route['products/import-template'] = 'admin/products/import_template';
$route['products/validate-import'] = 'admin/products/do_products_import';
$route['products/import-categories'] = 'admin/products/import_categories';
$route['products/edit-product/(:num)'] = 'admin/products/edit_product/$1';
$route['products/duplicate-product/(:num)'] = 'admin/products/duplicate_product/$1';
$route['products/delete-product/(:num)'] = 'admin/products/delete_product/$1';
$route['products/activate-product/(:num)'] = 'admin/products/activate_product/$1';
$route['products/deactivate-product/(:num)'] = 'admin/products/deactivate_product/$1';

/* End of file routes.php */
/* Location: ./system/application/config/routes.php */