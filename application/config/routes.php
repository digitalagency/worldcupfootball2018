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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//Ion Auth
$route['admin'] = 'admin/auth';
$route['core'] = 'admin/auth';
$route['core/login'] ='admin/auth/login';

$route['admin/login'] ='admin/auth/login';
$route['logout'] = 'admin/auth/logout';

$route['admin/Coupon/([0-9]+)'] = 'admin/Coupon';


// Frontend Section
//$route['facebook/'] = 'home/Facebook';
$route['facebook/(:any)'] = 'home/Facebook/$1';
$route['facebook/(:any)/(:any)'] = 'home/Facebook/$1/$2';
$route['facebook/(:any)/(:any)/(:any)'] = 'home/Facebook/$1/$2/$3';


$route['terms-and-condition'] = 'home/terms_and_condition';
$route['registration_process'] = 'home/registration_process';
$route['thank-you'] = 'home/thank_you';
$route['login-process'] = 'home/login_process';
$route['dashboard'] = 'home/dashboard';
$route['match-day-contest'] = 'home/match_day_contest';
$route['match-day-contest-question/(:any)'] = 'home/match_day_contest_question/$1';
$route['ecoupon-process/(:any)/(:any)'] = 'home/ecoupon_process/$1/$2';
$route['ultimate-contest-question'] = 'home/ultimate_contest_question';
$route['all-time-contest'] = 'home/all_time_contest';
$route['all-time-contest-question/(:any)'] = 'home/all_time_contest_question/$1';
$route['get-user'] = 'home/get_users';
$route['photo-gallery'] = 'home/photo_gallery';
$route['photo-gallery/(:any)'] = 'home/photo_gallery/$1';
$route['photo-gallery/(:any)/(:any)'] = 'home/photo_gallery/$1/$2';
$route['add-new-gift-coupons'] = 'home/add_new_gift_coupons';
$route['update-likes-with-cron/(:any)'] = 'home/update_likes_with_cron/$1';
