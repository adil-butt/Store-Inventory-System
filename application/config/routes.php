<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// admin routes - start
$route['admin/sales'] = 'SaleProduct/salesTable';
$route['admin/sale_product'] = 'SaleProduct/saleProduct';

$route['site_setting'] = 'admin/siteSetting';
$route['admin/search'] = 'admin/search';
$route['admin/all_products'] = 'admin/billDetail';
$route['admin/bill_detail/(:any)'] = 'admin/billDetail/$1';
$route['admin/bills'] = 'admin/bills';
$route['admin/profile'] = 'admin/profile';
$route['admin'] = 'admin';
// admin routes - end

// public routes without login - start
$route['home'] = 'home';
$route['home/(:num)'] = 'home/index/$1';
$route['home/(:num)/(:num)'] = 'home/index/$1/$2';
$route['about'] = 'home/about';
$route['contact_us'] = 'home/contact';
$route['display_product/(:num)'] = 'home/productDisplay/$1';
$route['cart'] = 'home/cart';
$route['checkout'] = 'home/checkout';
// public routes without login - end

// user routes start
$route['profile'] = 'user/profile';
// user routes end

// authentication routes start
$route['reset_password/(:any)/(:any)'] = 'authentication/resetPassword/$1/$2';
$route['verify/(:any)/(:any)'] = 'authentication/verification/$1/$2';
$route['logout/(:any)'] = 'authentication/logout/$1';
$route['reg'] = 'authentication/registration';
$route['login'] = 'authentication/login';
$route['admin/login'] = 'authentication/adminLogin';
$route['forgot-password'] = 'authentication/forgotPassword';
// authentication routes end

$route['default_controller'] = 'home';
$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;


